<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Set;

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

    public function index(Request $request)
    {

        $page = $request->get('page');
        $search = $request->get('search');
        $filters = collect($request->only($this->allowed_filters))->filter(function($value) {
            return null !== $value;
        })->map(function($value) {
            return is_array($value) ? $value : [$value];
        })->toArray();

        $query = Set::with('images');

        foreach ($filters as $type => $values) {
            $query->whereHas($type, function($q) use ($type, $values) {
                $q->whereIn($type . '.id', $values);
            });
        }

        if (!empty($search)) {
            $query->where('name', 'LIKE', "%$search%");
        }

        $items = $query->paginate(20)->appends($page);

        return response()->json($items);
    }

    public function show(Set $item)
    {
        $item->loadMissing(['children', 'parent']);
        return response()->json($item);
    }
}
