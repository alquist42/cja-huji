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

        $item = Item::create();
        $item->locations()->sync($request->get('taxonomy')['locations']);

        $item->load(Item::$relationships);
        return response()->json($item);
    }

    public function update(Request $request, Item $item) {

    }
}
