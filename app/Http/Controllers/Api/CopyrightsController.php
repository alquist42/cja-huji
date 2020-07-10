<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Copyright;
use Illuminate\Http\Request;

class CopyrightsController extends Controller
{
    public function index(Request $request)
    {
        return Copyright::searchByName($request->query('search'))->get();
    }
}
