<?php

namespace App\Services\MediaManager;

use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use League\Flysystem\Util;

trait GetContent
{
    /**
     * get files in path.
     *
     * @param Request $request [description]
     *
     * @return [type] [description]
     */
    public function getFiles(Request $request)
    {
        $path = $request->path == '/' ? '' : $request->path;

        if ($path && !$this->storageDisk->exists($path)) {
            return response()->json([
                'error' => trans('MediaManager::messages.error.doesnt_exist', ['attr' => $path]),
            ]);
        }

        return response()->json(
            array_merge(
                $this->lockList(),
                [
                    'files'  => [
                        'path'  => $path,
                        'items' => $this->paginate($this->getData($path), $this->paginationAmount),
                    ],
                ]
            )
        );
    }

    public function getOrphanFiles()
    {
        $orphanImages = (new ImageService())->getOrphans();

        return response()->json(
            array_merge(
                $this->lockList(),
                [
                    'files'  => [
                        'path'  => 'ORPHANS (virtual folder)',
                        'items' => $this->paginate($this->getFilesMetadataForImages($orphanImages), $this->paginationAmount),
                    ],
                ]
            )
        );
    }

    public function getItemFiles(Request $request)
    {
        $itemImages = (new ImageService())->getItemImages($request->input('itemId'));

        return response()->json(
            array_merge(
                $this->lockList(),
                [
                    'files'  => [
                        'path'  => 'ITEM\'S (virtual folder)',
                        'items' => $this->paginate($this->getFilesMetadataForImages($itemImages), $this->paginationAmount),
                    ],
                ]
            )
        );
    }

    public function getTreeFiles(Request $request)
    {
        $treeImages = (new ImageService())->getWholeTree($request->input('itemId'));

        return response()->json(
            array_merge(
                $this->lockList(),
                [
                    'files'  => [
                        'path'  => 'WHOLE TREE (virtual folder)',
                        'items' => $this->paginate($this->getFilesMetadataForImages($treeImages), $this->paginationAmount),
                    ],
                ]
            )
        );
    }

    /**
     * Get file's metadata for each image's file
     *
     * @param array|Collection $images
     * @return array
     */
    protected function getFilesMetadataForImages($images)
    {
        $list = [];

        foreach ($images as $image) {
            if ($this->storageDisk->exists($image->def)) {
                $file = $this->storageDisk->getWithMetadata($image->def, ['mimetype', 'visibility', 'timestamp', 'size']);
            } else {
                $file = [
                    'path' => $image->def,
                    'timestamp' => -1,
                    'mimetype' => 'image/jpeg',
                    'size' => 0,
                    'visibility' => '',
                    'missing' => 'https://www.eglsf.info/wp-content/uploads/image-missing.png'
                ];
            }
            $path = $file['path'];
            $time = $file['timestamp'];

            $list[] = [
                'name'                   => Util::pathinfo($path)['basename'],
                'type'                   => $file['mimetype'],
                'path'                   => isset($file['missing']) ? $file['missing'] : $this->resolveUrl($path),
                'storage_path'           => $path,
                'size'                   => $file['size'],
                'visibility'             => $file['visibility'],
                'last_modified'          => $time,
                'last_modified_formated' => $this->getItemTime($time),
                'image'                  => $image,
            ];
        }

        return $list;
    }

    /**
     * get files list.
     *
     * @param mixed $dir
     */
    protected function getData($dir)
    {
        $list           = [];
        $dirList        = $this->getFolderContent($dir);
        $storageFolders = $this->getFolderListByType($dirList, 'dir');
        $storageFiles   = $this->getFolderListByType($dirList, 'file');
        $pattern        = $this->ignoreFiles;

        // folders
        foreach ($storageFolders as $folder) {
            $path = $folder['path'];
            $time = $folder['timestamp'];

            if ($this->GFI) {
                $info = $this->getFolderInfoFromList($this->getFolderContent($path, true));
            }

            $list[] = [
                'name'                   => $folder['basename'],
                'type'                   => 'folder',
                'path'                   => $this->resolveUrl($path),
                'storage_path'           => $path,
                'size'                   => isset($info) ? $info['size'] : 0,
                'count'                  => isset($info) ? $info['count'] : 0,
                'last_modified'          => $time,
                'last_modified_formated' => $this->getItemTime($time),
            ];
        }

        // files
        foreach ($storageFiles as $file) {
            $path = $file['path'];
            $time = $file['timestamp'];

            $list[] = [
                'name'                   => $file['basename'],
                'type'                   => $file['mimetype'],
                'path'                   => $this->resolveUrl($path),
                'storage_path'           => $path,
                'size'                   => $file['size'],
                'visibility'             => $file['visibility'],
                'last_modified'          => $time,
                'last_modified_formated' => $this->getItemTime($time),
                'image'                  => (new ImageService)->findByPath($path),
            ];
        }

        return $list;
    }

    /**
     * get directory data.
     *
     * @param mixed $folder
     * @param mixed $rec
     */
    protected function getFolderContent($folder, $rec = false)
    {
        $pattern = $this->ignoreFiles;
        return $this->storageDisk->listWith(['mimetype', 'visibility', 'timestamp', 'size'], $folder ?: '/', $rec);

//        return $this->storageDisk->createIterator(
//            [
//                'list-with' => ['mimetype', 'visibility', 'timestamp', 'size'],
//                'recursive' => $rec,
//                'filter'    => function ($item) use ($pattern) {
//                    return !preg_grep($pattern, [$item['basename']]);
//                },
//            ],
//            $folder ?: '/'
//        );
    }

    /**
     * filter directory data by type.
     *
     * @param [type] $list
     * @param [type] $type
     */
    protected function getFolderListByType($list, $type)
    {
        $list   = collect($list)->where('type', $type);
        $sortBy = $list->pluck('basename')->values()->all();
        $items  = $list->values()->all();

        array_multisort($sortBy, SORT_NATURAL, $items);

        return $items;
    }

    /**
     * get folder size.
     *
     * @param [type] $list
     */
    protected function getFolderInfoFromList($list)
    {
        $list = collect($list)->where('type', 'file');

        return [
            'count' => $list->count(),
            'size'  => $list->pluck('size')->sum(),
        ];
    }
}
