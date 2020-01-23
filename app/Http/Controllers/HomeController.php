<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Location;

class HomeController extends Controller
{
	/**
	 * Call another function by project
	 *
	 * @param $project
	 *
	 * @return mixed
	 */
	public function index($project)
	{
		if (method_exists($this, $project)) return $this->$project();
		else abort(404);
	}

	/**
	 * Show the catalogue main page.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	private function catalogue()
	{
		/*$imagesAndObjects = Search::selectRaw('type, category, count(*) as total')
			->groupBy(['type', 'category'])
			->get();*/

		$categories = Category::select("slug", "name")
			->where("in_search", 1)
			->get();

		$header = [
			'title' => 'Catalogue',
			'h1' => 'Catalogue'
		];

		return view('catalogue.home', get_defined_vars());
	}

	/**
	 * Show the MHS main page.
	 *
	 * @param $page
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	private function mhs($page = null)
	{
		return $page && view()->exists("mhs.$page") ? view("mhs.$page") : view('mhs.home');
	}

	/**
	 * Show the WPC main page.
	 *
	 * @param $page
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	private function wpc()
	{
		$header = [
			'title' => 'WPC',
			'h1' => 'A Catalogue of Wall Paintings in Central and East European Synagogues'
		];

		$countries = Location::select('locations.id', 'locations.name')
			->join('projects', function ($join) {
				$join->on('projects.taggable_id', 'locations.id')
					->where([
						['tag_slug', 'like', '%WPC%'],
						['taggable_type', '=', 'location'],
					]);
			})
			->whereNull('parent_id')
			// Building does not exist
			->where('locations.id', '!=', 758)
			->get();

		return view('wpc.home', get_defined_vars());
	}

	/**
	 * Show the SCH main page.
	 *
	 * @param $page
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	private function sch()
	{
		$header = [
			'title' => 'SCH',
			'h1' => 'Ursula and Kurt Schubert Archives'
		];

		$categories = [
			[
				'title' => 'All the Archives',
				'search' => ''
			],
			[
				'title' => 'Bible',
				'search' => 'bible'
			],
			[
				'title' => 'Biblical Paraphrase',
				'search' => 'biblical paraphrase'
			],
			[
				'title' => 'Haggadah',
				'search' => 'haggadah'
			],
			[
				'title' => 'Evronot',
				'search' => 'evronot'
			],
			[
				'title' => 'Esther scroll',
				'search' => 'esther'
			],
			[
				'title' => 'Halakhic Literature',
				'search' => 'halakhic'
			],
			[
				'title' => 'Siddut',
				'search' => 'siddur'
			],
			[
				'title' => 'Medical Literature',
				'search' => 'siddur'
			],
			[
				'title' => 'Miscellany',
				'search' => 'miscellany'
			],
		];

		return view('sch.home', get_defined_vars());
	}
}
