<?php


namespace App\Http\Controllers\Api\MHS;


use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Services\MHS\MapService;
use Illuminate\Http\Request;

class MapController extends Controller
{
	public function options(MapService $service)
	{
		return response()->json($service->getOptions());
	}

	public function markers(Request $request, MapService $service)
	{
		return response()->json($service->getMarkers($request->all()));
	}
}