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

    public function index(Request $request, $project )
    {
        $categories_data = Category::select("slug", "name")->where("in_search","=",1)->get();

        $page = $request->get('page');
        $search = $request->get('search');
        $text = $request->get('text');
        $categories = $request->get('categories');

        if(!empty($categories)){
            foreach ($categories_data as $category_data){
                if(in_array($category_data->slug, $categories)){
                    $category_data->selected = true;
                }
            }
        } else {
            $categories_data = $categories_data->map(function ($category_data) {
                $category_data->selected = true;
                return $category_data;
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
      //  $res = $query->get();
        $data = $this->search->find($filters, $search, $text, $categories);
        $items = $data['collection'];
        $pagination =  $data['pagination'];
           // ->paginate(50);
          //  ->appends($page);
   //     $links = Pagination::makeLengthAware($items, 158, 50,$_GET);
        $selected = [];
        foreach ($filters as $type => $values) {
            $model = '\\App\\Models\\Taxonomy\\' . ucfirst(str_singular($type));
            $selected[$type] = $model::select("id", "name")->find($values);
        }

        return view('index', [
            "items" => $items ,
            "filters" => $selected,
            "categories" => $categories_data,/*"links"=>$links ,*/
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
}
