<?php

namespace App\Providers;

use App\Models\Image;
use App\Models\Item;
use App\Models\Taxonomy\Collection;
use App\Models\Taxonomy\Community;
use App\Models\Taxonomy\HistoricalOrigin;
use App\Models\Taxonomy\Location;
use App\Models\Taxonomy\Maker;
use App\Models\Taxonomy\Bibliography;
use App\Models\Taxonomy\Object as TaxonomyObject;
use App\Models\Taxonomy\Origin;
use App\Models\Taxonomy\Period;
use App\Models\Taxonomy\School;
use App\Models\Taxonomy\Site;
use App\Models\Taxonomy\Subject;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Factory as ViewFactory;

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
            \App\Console\Commands\ImportItems::class,
            \App\Console\Commands\fixTree::class
        ]);

        $this->app->instance(Tenant::class, new Tenant());

        //		View::share('menu', config('menu.general'));
        View::share([
            'projects' => $this->app->make(Tenant::class)->projects(),
            'menu' => config('menu')
        ]);

        Relation::morphMap([
            'subject' => Subject::class,
            'collection' => Collection::class,
            'community' => Community::class,
            'historical_origin' => HistoricalOrigin::class,
            'location' => Location::class,
            'object' => TaxonomyObject::class,
            'origin' => Origin::class,
            'period' => Period::class,
            'school' => School::class,
            'site' => Site::class,
            'set' => Item::class,
            'item' => Item::class,
            'image' => Image::class,
            'maker' => Maker::class,
            'bibliography' => Bibliography::class,
        ]);
//
//        ViewFactory::macro('component', function ($name, $viewData = [], $componentData = []) {
//            return View::make('app', ['name' => $name, 'data' => $componentData] + $viewData);
//        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        if ($this->app->environment() !== 'production') {
//            $this->app->register(\Way\Generators\GeneratorsServiceProvider::class);
//            $this->app->register(\Xethron\MigrationsGenerator\MigrationsGeneratorServiceProvider::class);
//        }
    }
}
