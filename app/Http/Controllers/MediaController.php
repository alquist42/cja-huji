<?php

namespace App\Http\Controllers;

use App\Services\MediaManager\GetContent;
use ctf0\MediaManager\App\Controllers\Modules\Lock;
use ctf0\MediaManager\App\Controllers\Modules\Move;
use ctf0\MediaManager\App\Controllers\Modules\Utils;
use ctf0\MediaManager\App\Controllers\Modules\Delete;
use ctf0\MediaManager\App\Controllers\Modules\Rename;
use ctf0\MediaManager\App\Controllers\Modules\Download;
use ctf0\MediaManager\App\Controllers\Modules\NewFolder;
use App\MediaManager\Modules\Upload;
use ctf0\MediaManager\App\Controllers\Modules\Visibility;
use ctf0\MediaManager\App\Controllers\Modules\GlobalSearch;
use League\Flysystem\Plugin\GetWithMetadata;
use League\Flysystem\Plugin\ListWith;

class MediaController extends Controller
{
    use Utils,
        GetContent,
        Delete,
        Download,
        Lock,
        Move,
        Rename,
        Upload,
        NewFolder,
        Visibility,
        GlobalSearch;

    protected $baseUrl;
    protected $db;
    protected $fileChars;
    protected $fileSystem;
    protected $folderChars;
    protected $ignoreFiles;
    protected $LMF;
    protected $GFI;
    protected $sanitizedText;
    protected $storageDisk;
    protected $storageDiskInfo;
    protected $unallowedMimes;

    public function __construct()
    {
        $config = app('config')->get('mediaManager');

        $this->fileSystem           = $config['storage_disk'];
        $this->ignoreFiles          = $config['ignore_files'];
        $this->fileChars            = $config['allowed_fileNames_chars'];
        $this->folderChars          = $config['allowed_folderNames_chars'];
        $this->sanitizedText        = $config['sanitized_text'];
        $this->unallowedMimes       = $config['unallowed_mimes'];
        $this->LMF                  = $config['last_modified_format'];
        $this->GFI                  = $config['get_folder_info'];
        $this->paginationAmount     = $config['pagination_amount'];

        $this->storageDisk     = app('filesystem')->disk($this->fileSystem);
        $this->storageDiskInfo = app('config')->get("filesystems.disks.{$this->fileSystem}");
        $this->baseUrl         = $this->storageDisk->url('/');
        $this->db              = app('db')
                                    ->connection($config['database_connection'])
                                    ->table($config['table_locked']);

        $this->storageDisk->addPlugin(new ListWith);
        $this->storageDisk->addPlugin(new GetWithMetadata);
    }

    /**
     * main view.
     *
     * @return [type] [description]
     */
    public function index()
    {
        return view('MediaManager::media');
    }
}
