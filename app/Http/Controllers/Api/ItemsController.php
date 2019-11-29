<?php

namespace App\Http\Controllers\Api;

use App\Services\Search;
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

    public function __construct(Search $search)
    {
        $this->search = $search;
    }

    public function index(Request $request)
    {

        $page = $request->get('page');

        $filters = collect($request->only($this->allowed_filters))->filter(function($value) {
            return null !== $value;
        })->map(function($value) {
            return is_array($value) ? $value : [$value];
        })->toArray();

        $items = $this->search->find($filters, null, null, null)
            ->with('images')
            ->paginate(20)
            ->appends($page);

        return response()->json($items);
    }

    public function show(Set $item)
    {
        $item->loadMissing(['children', 'parent']);
        return response()->json($item);
    }
}
