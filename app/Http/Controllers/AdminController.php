<?php


namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Property;
use App\Models\Item;
use App\Models\Taxonomy\Artist;
use App\Models\Taxonomy\Collection;
use App\Models\Taxonomy\Community;
use App\Models\Taxonomy\Details;
use App\Models\Taxonomy\HistoricalOrigin;
use App\Models\Taxonomy\Location;
use App\Models\Taxonomy\Maker;
use App\Models\Taxonomy\Origin;
use App\Models\Taxonomy\Period;
use App\Models\Taxonomy\Profession;
use App\Models\Taxonomy\School;
use App\Models\Taxonomy\Subject;
use App\Models\Tenant;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    public function viewLinks($name = "index")
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
        return view('admin', ['name' => 'Dash', 'data' => [
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
        ]]);
    }

    public function items() {
        $collection = Item::with(Item::$relationships)->paginate(20, ['*'], 'page', 30);

        return view('admin', [
            'name' => 'Items',
            'data' => [
                'collection' => $collection
            ]
        ]);
    }

    public function item($item) {
//        $item = Item::with(Item::$relationships)->findOrFail($item);
        $properties = Property::get()->sortBy('name')->values();
        return view('admin', [
            'name' => 'Item',
            'data' => [
                'id' => $item,
                'properties' =>  $properties,
            ]
        ]);
    }
}
