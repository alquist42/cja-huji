<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;

class PropertiesController extends Controller
{
    public function index()
    {
        return Property::get()->sortBy('name')->values();
    }
}
