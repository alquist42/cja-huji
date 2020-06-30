<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Services\Search;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    /**
     * Allowed Taxonomy filter
     *
     * @var array
     */
    protected $allowed_filters = [
        'subjects',
        'origins',
        'collections',
        'communities',
        'congregations',
        'historical_origins',
        'locations',
        'makers',
        'artists',
        'professions',
        'objects',
        'periods',
        'photographers',
        'schools',
    ];

    public function __construct(Search $search)
    {
        $this->search = $search;
    }

    public function index(Request $request)
    {
        $page = $request->get('page');

        $filters = collect($request->only($this->allowed_filters))->filter(function ($value) {
            return null !== $value;
        })->map(function ($value) {
            return is_array($value) ? $value : [$value];
        })->toArray();


        $data = $this->search->findByTaxonomy($filters);
        $items = $data['collection'];
        $pagination =  $data['pagination'];

        return response()->json([
            'data'=> $items,
            'meta' => $pagination
        ]);



//        return view('index', [
//            "items" => $items ,
//            'pagination' => $pagination,
//            'setsCount' => $data['setsCount'],
//            'itemsCount' => $data['itemsCount']
//        ]);
    }

    public function show(Item $item)
    {
        $item->load(Item::$relationships);
        $item->leaf = $item->leaf();
        $item->parent = $item->parent()->get();
        $item->parent->load(Item::$relationships);
        return response()->json($item);
    }

    public function store(Request $request) {
        $data = $request->get('item');
        unset($data['id']);

        $item = Item::create($data);
        $this->sync($request, $item);

        $item->load(Item::$relationships);
        return response()->json($item);
    }

    public function update(Request $request, Item $item) {
        $item->fill($request->all());
        $this->sync($request, $item);

        $item->load(Item::$relationships);
        return response()->json($item);
    }

    protected function sync(Request $request, Item $item) {
        $item->locations()->sync($request->get('item')->locations);
        $item->origins()->sync($request->get('item')->origins);
        $item->subjects()->sync($request->get('item')->subjects);
        $item->objects()->sync($request->get('item')->objects);
        $item->locations()->sync($request->get('item')->locations);
        $item->collections()->sync($request->get('item')->collections);
        $item->communities()->sync($request->get('item')->communities);
        $item->historic_origins()->sync($request->get('item')->historic_origins);
        $item->periods()->sync($request->get('item')->periods);
        $item->schools()->sync($request->get('item')->schools);
        $item->sites()->sync($request->get('item')->sites);
        $item->makers()->sync($request->get('item')->makers);

//        $item->location_details()->sync($request->get('location_details'));
//        $item->origin_details()->sync($request->get('origin_details'));
//        $item->subject_details()->sync($request->get('subject_details'));
//        $item->objects_details()->sync($request->get('objects_details'));
//        $item->location_details()->sync($request->get('location_details'));
//        $item->collection_details()->sync($request->get('collection_details'));
//        $item->community_details()->sync($request->get('community_details'));
//        $item->historic_origin_details()->sync($request->get('historic_origin_details'));
//        $item->period_details()->sync($request->get('period_details'));
//        $item->school_details()->sync($request->get('school_details'));
//        $item->site_details()->sync($request->get('site_details'));
//        $item->maker_details()->sync($request->get('maker_details'));

//        $item->properties()->sync($request->get('properties'));
//        $item->images()->sync($request->get('images'));
    }
}
