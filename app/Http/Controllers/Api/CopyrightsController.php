<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Copyright;
use Illuminate\Http\Request;

class CopyrightsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        return Copyright::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%$search%");
        })
            ->get();
    }
}
