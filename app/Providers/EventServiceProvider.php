<?php

namespace App\Providers;

use App\Models\Image;
use App\Models\Item;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Event::listen('MMFileUploaded', function ($file_path, $mime_type, $options, $attach_to_item) {
            $image = Image::create([
                'def' => $file_path,
                'rights' => '111',
            ]);

            if ($attach_to_item) {
                $item = Item::findOrFail($attach_to_item);
                $item->images()->attach($image);
            }
        });

        Event::listen(['MMFileRenamed', 'MMFileMoved'], function ($old_path, $new_path) {
            // Laravel Media Manager adds '/' at the beginning og the $new_path only when moving a file,
            // but not when renaming it
            if (Str::startsWith($new_path, '/')) {
                $new_path = Str::substr($new_path, 1);
            }

            Image::where('def', $old_path)
                ->update(['def' => $new_path]);
        });

        Event::listen('MMFileDeleted', function ($file_path, $is_folder) {
            // If $is_folder then also remove all nested images
            $imagesIds = Image::where('def', 'like', "$file_path%")
                ->pluck('id');

            DB::table('entity_images')
                ->whereIn('image_id', $imagesIds)
                ->delete();

            Image::whereIn('id', $imagesIds)
                ->delete();
        });
    }

    /**
     * "ctf0/package-changelog".
     */
    public static function postAutoloadDump(\Composer\Script\Event $event)
    {
        if (class_exists('ctf0\PackageChangeLog\Ops')) {
            return \ctf0\PackageChangeLog\Ops::postAutoloadDump($event);
        }
    }
}
