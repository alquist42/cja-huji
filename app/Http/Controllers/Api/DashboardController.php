<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\Property;
use App\Models\Taxonomy\Collection;
use App\Models\Tenant;

class DashboardController extends Controller
{
    public function index()
    {
        $sets = Item::with(Item::$relationships)->paginate(3);


//        $locations = Location::get()->sortBy('name')->values()->toTree();
//        $origins = Origin::get()->sortBy('name')->values()->toTree();
//        $schools = School::get()->sortBy('name')->values()->toTree();
        $properties = Property::get()->sortBy('name')->values();
//        $subjects = Subject::get()->sortBy('name')->values()->toTree();
//        $historical_origins = HistoricalOrigin::get()->sortBy('name')->values()->toTree();
//        $periods = Period::get()->sortBy('name')->values()->toTree();
//        $collections = Collection::get()->sortBy('name')->values()->toTree();
//        $communities =  Community::get()->sortBy('name')->values()->toTree();
//        $professions =  Profession::get()->sortBy('name')->values();
//        $artists =  Artist::get()->sortBy('name')->values()->toTree();
//        $makers = Maker::with(['artist', 'profession'])->get()->sortBy('name')->values();
//
        $item = Item::with(Item::$relationships)->findOrFail(2);

        $projects = array_values(app()->make(Tenant::class)->projects());
        $categories = Category::get();


        $options = Collection::get()->sortBy('name')->values()->toTree();

        return [
            'collection' => $sets,
            'options' => $options,
            //'locations' => $locations,
//            'origins' => $origins,
//            'schools' => $schools,
            'properties' =>  $properties,
//            'subjects' => $subjects,
//            'historical_origins' => $historical_origins,
//            'periods' => $periods,
            //'collections' => $collections,
            //'communities' => $communities,
//            'makers' => $makers,
//            'professions' => $professions,
//            'artists' => $artists,
            'item' => $item,
            'projects' => $projects,
            'categories' => $categories,
        ];
    }
}