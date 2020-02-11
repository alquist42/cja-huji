<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Tenant;

class CurrentProject
{

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        $project = null;
		$tenant = app()->make(Tenant::class);

        if (!empty($request->route('project'))) {
            $project = $request->route('project');
			$tenant->setProjectByURL($project);
		}
        else {
            $project = $request->get('project');
            $tenant->setProject($project);
        }

        return $next($request);
    }
}

