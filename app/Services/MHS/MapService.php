<?php


namespace App\Services\MHS;


use App\Models\Location;
use App\Models\Taxonomy\Community;

class MapService
{
	public function getOptions()
	{
		$locations = $this->getLocations();
		$communities = $this->getCommunities();
		$subjects = $this->getCommunities();
		$materials = $this->getCommunities();
		$ratings = $this->getCommunities();
		$conditions = $this->getCommunities();

		return get_defined_vars();
	}

	public function getMarkers($options)
	{
		if (!count($options)) {
			return [
				[
					'position' => [
						'lat' => 50,
						'lng' => 14,
					],
					'title' => "First"
				],
				[
					'position' => [
						'lat' => 51,
						'lng' => 12,
					],
					'title' => "Second"
				],
				[
					'position' => [
						'lat' => 55,
						'lng' => 5,
					],
					'title' => "Third"
				],
			];
		} else return [
			[
				'position' => [
					'lat' => 50,
					'lng' => 14,
				],
				'title' => "First again"
			]
		];
	}

	public function getLocations()
	{
	  return Location::select('locations.id', 'locations.name')
		  ->join('projects', function ($join) {
			  $join->on('projects.taggable_id', 'locations.id')
				  ->where([
					  ['tag_slug', 'like', '%MHS%'],
					  ['taggable_type', '=', 'location'],
				  ]);
		  })
		  ->whereNull('parent_id')
		  // Building does not exist
		  ->where('locations.id', '!=', 758)
		  ->get();
	}

	public function getCommunities()
	{
		return Community::select('communities.id', 'communities.name')
			->join('projects', function ($join) {
				$join->on('projects.taggable_id', 'communities.id')
					->where([
						['tag_slug', 'like', '%MHS%'],
						['taggable_type', '=', 'community'],
					]);
			})
			->whereNull('parent_id')->get();
	}
}