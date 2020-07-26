<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Taxonomy\Artist;
use Illuminate\Http\Request;

class ArtistsController extends Controller
{
    public function index(Request $request)
    {
        return Artist::searchByName($request->query('search'))->get();
    }
}
