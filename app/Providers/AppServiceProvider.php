<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Relations\Relation;

use App\Models\Taxonomy\Collection;
use App\Models\Taxonomy\Community;
use App\Models\Taxonomy\Congregation;
use App\Models\Taxonomy\HistoricOrigin;
use App\Models\Taxonomy\Location;
use App\Models\Taxonomy\Maker;
use App\Models\Taxonomy\Object;
use App\Models\Taxonomy\Origin;
use App\Models\Taxonomy\Period;
use App\Models\Taxonomy\School;
use App\Models\Taxonomy\Site;
use App\Models\Taxonomy\Subject;

use App\Models\Set;
use App\Models\Item;
use App\Models\Image;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        $this->commands([
            \App\Console\Commands\ImportItems::class
        ]);



        Relation::morphMap([
            'subject' => Subject::class,
            'collection' => Collection::class,
            'community' => Community::class,
            'historical_origin' => HistoricOrigin::class,
            'location' => Location::class,
            'object' => Object::class,
            'origin' => Origin::class,
            'period' => Period::class,
            'school' => School::class,
            'site' => Site::class,
            'set' => Set::class,
            'item' => Item::class,
            'image' => Image::class,
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
