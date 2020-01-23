<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

class MHSController extends Controller
{
	/**
	 * Show the application dashboard.
	 *
	 * @param $page
	 *
	 * @return mixed
	 */
	public function index($page = null)
	{
		if (!$page) return view('mhs.home');
		else if (view()->exists("mhs.$page")) {
			$header['title'] = Str::title($page);
			return view("mhs.$page", compact('header'));
		}
		else return abort(404);
	}
}
