<?php

namespace App\Http\Controllers;

use App\Models\Set;
use App\Models\Item;
use App\Models\Origin;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\Search;
use App\Services\Pagination;
use Illuminate\Support\Facades\Gate;

class CatalogController extends Controller
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

    public function index(Request $request, $project)
    {
        $all_categories = Category::select("slug", "name")->where("in_search","=",1)->get();

        $page = $request->get('page');
        $search = $request->get('search');
        $text = $request->get('text');
        $categories = $request->get('categories');


        if(!empty($categories)){
            foreach ($all_categories as $category){
                if(in_array($category->slug, $categories)){
                    $category->selected = true;
                }
            }
        } else {
            $all_categories = $all_categories->map(function ($category) {
                $category->selected = true;
                return $category;
            });

        }

        $filters = collect($request->only($this->allowed_filters))->filter(function($value) {
            return null !== $value;
        })->map(function($value) {
            return is_array($value) ? $value : [$value];
        })->toArray();
       // dd($page);
        if (Gate::allows('has-account')) {
        //    dd('yes');
        } else {
         //   dd('no');
        }

        $selected = [];
        foreach ($filters as $type => $values) {
            $model = '\\App\\Models\\Taxonomy\\' . ucfirst(str_singular($type));
            $selected[$type] = $model::select("id", "name")->find($values);
        }
        if(is_array($categories) && count($all_categories) == count($categories)){
			 $categories = null;
        }
        $data = $this->search->find($selected, $search, $text, $categories);
        $items = $data['collection'];
        $pagination =  $data['pagination'];
           // ->paginate(50);
          //  ->appends($page);
   //     $links = Pagination::makeLengthAware($items, 158, 50,$_GET);


        return view('index', [
            "items" => $items ,
            "filters" => $selected,
            "categories" => $all_categories,/*"links"=>$links ,*/
            'pagination' => $pagination,
            'setsCount' => $data['setsCount'],
            'itemsCount' => $data['itemsCount']
        ]);
    }

    public function show($project, $id)
    {
        $item = Set::findOrFail($id);
        $item->load(Set::$relationships);

        return view('item', compact('item'));
    }

    public function showItem($project, $id)
    {
        $item = Item::findOrFail($id);
        $item->load(Item::$relationships);

        return view('img', compact('item'));
    }
}
