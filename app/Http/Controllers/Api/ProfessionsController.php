<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Taxonomy\Profession;
use Illuminate\Http\Request;

class ProfessionsController extends Controller
{
    public function index(Request $request)
    {
        return Profession::searchByName($request->query('search'))->get();
    }
}
