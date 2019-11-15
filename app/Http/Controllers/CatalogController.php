<?php

namespace App\Http\Controllers;

use App\Models\Set;
use App\Models\Origin;
use App\Models\Category;
use Illuminate\Http\Request;

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

    public function index(Request $request, $project )
    {
        $categories_data = Category::select("slug", "name")->get();

        $page = $request->get('page');
        $search = $request->get('search');
        $categories = $request->get('categories');

        if(!empty($categories)){
            foreach ($categories_data as $category_data){
                if(in_array($category_data->slug, $categories)){
                    $category_data->selected = true;
                }
            }
        }


        $filters = collect($request->only($this->allowed_filters))->filter(function($value) {
            return null !== $value;
        })->map(function($value) {
            return is_array($value) ? $value : [$value];
        })->toArray();

        $query = Set::select("sets.id","sets.name", "images.def")->where('sets.publish_state','>',0);

        foreach ($filters as $type => $values) {
            $query->whereHas($type, function($q) use ($type, $values) {
                $q->whereIn($type . '.id', $values);
            });
        }


        if (!empty($search)) {
            $query->where('name', 'LIKE', "%$search%");
        }

        if (!empty($categories)) {
            $query->where(function ($query) use ($categories) {
                $query->where('category', array_shift($categories));
                foreach ($categories as $category){
                    $query->orWhere('category', $category);
                }
            });
        }

        /* PRIORITY FOR SETS WITH IMAGES */

        $query->leftJoin('entity_images', function ($join) {
            $join->on('entity_images.entity_id', '=', 'sets.id')->where(
                'entity_images.entity_type', '=', 'set');
        });
        $query->leftJoin('images', function ($join) {
            $join->on('images.id', '=', 'entity_images.image_id');
        });
        $query->orderByRaw(
            "CASE WHEN (images.medium is null AND images.def is null AND images.batch_url is null) THEN 1 ELSE 2 END DESC"
        );


        $query->orderBy('sets.id', 'DESC');
        $query->with('images');
        $items = $query->paginate(50)->appends($page);

        $selected = [];
        foreach ($filters as $type => $values) {
            $model = '\\App\\Models\\Taxonomy\\' . ucfirst(str_singular($type));
            $selected[$type] = $model::select("id", "name")->find($values);
        }

        return view('index', [ "items" => $items , "filters" => $selected, "categories" => $categories_data ]);
    }

    public function show($project, $id)
    {
        $item = Set::findOrFail($id);
        $item->load(Set::$relationships);

        return view('item', compact('item'));
    }
}
