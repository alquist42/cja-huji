<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostItem;
use App\Models\Item;
use App\Services\ItemService;
use App\Services\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    /**
     * @var Search
     */
    private $search;

    public function __construct(Search $search)
    {
        $this->search = $search;
    }

    public function index(Request $request)
    {
//        $page = $request->get('page');

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
        $item->load(array_diff(Item::$relationships, ['ancestors']));
        $item->leaf = $item->leaf();
        $item->load(['ancestors' => function ($query) {
            $query->with([
                'locations',
                'origins',
                'schools',
                'subjects',
                'objects',
                'historical_origins',
                'periods',
                'collections',
                'communities',
                'sites',
            ]);
        }]);

        return response()->json($item);
    }

    public function store(PostItem $request) {
        $item = null;
        DB::transaction(function () use (&$item, $request) {
            $item = Item::create($request->input('item'));
            $item = (new ItemService($item))->saveItem($request->all());
        });

        return $item->load(Item::$relationships);
    }

    public function update(Request $request, Item $item) {
        $item = (new ItemService($item))->saveItem($request->all());
        $item->leaf = $item->leaf();
        $item->load(['ancestors' => function ($query) {
            $query->with([
                'locations',
                'origins',
                'schools',
                'subjects',
                'objects',
                'historical_origins',
                'periods',
                'collections',
                'communities',
                'sites',
            ]);
        }]);

        return $item;
    }

    public function destroy(Item $item) {
        $item->delete();

        return response('', 204);
    }

    public function destroy(Item $item) {
        $item->delete();

        return response('', 204);
    }

    /**
     * Copy attributes from other item.
     *
     * @param Item $item
     * @param Item $source
     * @return Item
     */
    public function copy(Item $item, Item $source)
    {
        return (new ItemService($item))->copyFrom($source);
    }

    public function search(Request $request)
    {
        return Item::searchByName($request->query('search'))->get();
    }
}
