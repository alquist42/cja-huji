<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;

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
        } else {
            $project = $request->get('project');
        }
        $tenant->setProjectByURL($project);
        return $next($request);
    }
}
