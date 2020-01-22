<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MHSController extends Controller
{
	/**
	 * Show the application dashboard.
	 *
	 * @param $page
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index($page = null)
	{
		return $page && view()->exists("mhs.$page") ? view("mhs.$page") : view('mhs.home');
	}
}
