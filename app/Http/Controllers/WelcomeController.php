<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Tenant;

class WelcomeController extends Controller
{
    /**
     * @var Tenant|null
     */
    protected $tenant = null;

    /**
     * WelcomeController constructor.
     * @param Tenant $tenant
     */
    public function __construct(Tenant $tenant)
    {
        //$this->middleware('auth');
        $this->tenant = $tenant;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = $this->tenant->projects();

        return view('home', compact('projects'));
    }
}
