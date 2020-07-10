<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Date;
use Illuminate\Http\Request;

class DatesController extends Controller
{
    public function index(Request $request)
    {
        return Date::searchByName($request->query('search'))->get();
    }
}
