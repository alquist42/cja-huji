<?php

namespace App\Http\Controllers;

use App\Models\Set;
use App\Models\Origin;
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

        $page = $request->get('page');
        $search = $request->get('search');

        $filters = collect($request->only($this->allowed_filters))->filter(function($value) {
            return null !== $value;
        })->map(function($value) {
            return is_array($value) ? $value : [$value];
        })->toArray();

        $query = Set::query();

        foreach ($filters as $type => $values) {
            $query->whereHas($type, function($q) use ($type, $values) {
                $q->whereIn($type . '.id', $values);
            });
        }

        if (!empty($search)) {
            $query->where('name', 'LIKE', "%$search%");
        }

        $items = $query->paginate(20)->appends($page);

        $selected = [];
        foreach ($filters as $type => $values) {
            $model = '\\App\\Models\\Taxonomy\\' . ucfirst(str_singular($type));
            $selected[$type] = $model::select("id", "name")->find($values);
        }

        return view('index', [ "items" => $items , "filters" => $selected ]);
    }

    public function show($project, $id)
    {
        $item = Set::findOrFail($id);
        $item->load(Set::$relationships);

        return view('item', compact('item'));
    }
}
