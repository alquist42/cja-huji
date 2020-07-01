<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Date;
use Illuminate\Http\Request;

class DatesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        return Date::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%$search%");
        })
            ->get();
    }
}
