<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Item;
use App\Models\Tenant;
use OwenIt\Auditing\Models\Audit;

class DashboardController extends Controller
{
    public function index()
    {
        $itemsRoot = Item::whereNull('parent_id')->count();
        $items = Item::selectRaw('publish_state, count(*) as count')
            ->groupBy('publish_state')
            ->get();
        $itemsNotPublished = $items->where('publish_state', Item::PUBLISH_STATE_NOT_PUBLISHED)
            ->first()
            ->count;
        $itemsPrepared = $items->where('publish_state', Item::PUBLISH_STATE_PREPARED_FOR_PUBLISHING)
            ->first()
            ->count;
        $itemsPublished = $items->where('publish_state', Item::PUBLISH_STATE_PUBLISHED)
            ->first()
            ->count;
        $lastItemsAudits = Audit::selectRaw('auditable_id, auditable_type, max(created_at) as created_at')
            ->where('auditable_type', 'set')
            ->with('auditable.creation_date')
            ->groupBy('auditable_id')
            ->latest()
            ->take(10)
            ->get();
        $itemsLastModified = $lastItemsAudits->map(function ($audit) {
            return $audit->auditable;
        });

        $imagesNotAttached = Image::select('images.id')
            ->leftJoin('entity_images', 'images.id', '=', 'entity_images.image_id')
            ->whereNull('entity_id')
            ->count();

        return [
            'totals' => [
                'items' => [
                    'all' => $itemsNotPublished + $itemsPrepared + $itemsPublished,
                    'root' => $itemsRoot,
                    'not_published' => $itemsNotPublished + $itemsPrepared,
                ],
                'images' => [
                    'all' => Image::count(),
                    'not_attached' => $imagesNotAttached,
                ],
                'projects' => count((new Tenant)->projects()),
                'categories' => Category::where('in_search', true)->count(),
            ],
            'items' => $itemsLastModified,
        ];

//        $sets = Item::with(Item::$relationships)->paginate(3);
//
//
////        $locations = Location::get()->sortBy('name')->values()->toTree();
////        $origins = Origin::get()->sortBy('name')->values()->toTree();
////        $schools = School::get()->sortBy('name')->values()->toTree();
//        $properties = Property::get()->sortBy('name')->values();
////        $subjects = Subject::get()->sortBy('name')->values()->toTree();
////        $historical_origins = HistoricalOrigin::get()->sortBy('name')->values()->toTree();
////        $periods = Period::get()->sortBy('name')->values()->toTree();
////        $collections = Collection::get()->sortBy('name')->values()->toTree();
////        $communities =  Community::get()->sortBy('name')->values()->toTree();
////        $professions =  Profession::get()->sortBy('name')->values();
////        $artists =  Artist::get()->sortBy('name')->values()->toTree();
////        $makers = Maker::with(['artist', 'profession'])->get()->sortBy('name')->values();
////
//        $item = Item::with(Item::$relationships)->findOrFail(2);
//
//        $projects = array_values(app()->make(Tenant::class)->projects());
//        $categories = Category::get();
//
//
//        $options = Collection::get()->sortBy('name')->values()->toTree();
//
//        return [
//            'collection' => $sets,
//            'options' => $options,
//            //'locations' => $locations,
////            'origins' => $origins,
////            'schools' => $schools,
//            'properties' =>  $properties,
////            'subjects' => $subjects,
////            'historical_origins' => $historical_origins,
////            'periods' => $periods,
//            //'collections' => $collections,
//            //'communities' => $communities,
////            'makers' => $makers,
////            'professions' => $professions,
////            'artists' => $artists,
//            'item' => $item,
//            'projects' => $projects,
//            'categories' => $categories,
//        ];
    }
}
