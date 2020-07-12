<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Photographer;
use Illuminate\Http\Request;

class PhotographersController extends Controller
{
    public function index(Request $request)
    {
        return Photographer::searchByName($request->query('search'))->get();
    }
}
