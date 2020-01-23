<?php

namespace App\Http\Controllers;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('home');
    }
}
