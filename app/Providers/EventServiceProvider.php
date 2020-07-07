<?php

namespace App\Providers;

use App\Models\Image;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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

        Event::listen('MMFileUploaded', function ($file_path, $mime_type, $options) {
            Image::create([
                'def' => 'images_db/'.$file_path,
                'rights' => '111',
            ]);
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
