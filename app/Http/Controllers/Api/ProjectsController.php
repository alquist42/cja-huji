<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tenant;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = [
            [
                'tag_slug' => 'PRLST',
                'title' => 'PRLST Catalogue',
                'url' => '',
                'disabled' => true,
            ],
            [
                'tag_slug' => 'PLN',
                'title' => 'PLN Catalogue',
                'url' => '',
                'disabled' => true,
            ],
        ];

        foreach ((new Tenant)->projects() as $slug => $project) {
            $projects[] = [
                'tag_slug' => strtoupper($slug),
                'title' => $project['title'],
                'url' => $project['url'],
            ];
        }

        return $projects;
    }
}
