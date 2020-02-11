<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class BrowseController extends Controller
{
	public function index()
	{
		$tenant = resolve(Tenant::class);

		$header = [
			'title' => $tenant->getProjectData()['title'],
		];

		return view('browse', ['header' => $header, 'project' => $tenant->project]);
    }
}
