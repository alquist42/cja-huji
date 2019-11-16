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

        if (!empty($request->route('project'))) {
            $project = $request->route('project');
        }
        else {
            $project = $request->get('project');
        }


        $tenant = app()->make(Tenant::class);
        $tenant->setProject($project);

        return $next($request);
    }
}

