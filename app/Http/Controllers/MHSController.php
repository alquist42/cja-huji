<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Support\Str;

class MHSController extends Controller
{
	/**
	 * Show MHS project specific pages.
	 *
	 * @param $page
	 *
	 * @return mixed
	 */
	public function __invoke($page = null)
	{
		$prefix = (new Tenant)->projects()['mhs']['url'];

		if (!$page) {
			$header = [
				'prefix' => $prefix
			];

			return view('mhs.home', compact('header'));
		}
		else if (view()->exists("mhs.$page")) {
			$header = [
				'title' => Str::title($page),
				'prefix' => $prefix
			];

			return view("mhs.$page", compact('header'));
		}
		else return abort(404);
	}
}
