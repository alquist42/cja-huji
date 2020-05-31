<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;



class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function viewLinks($name = "index") {
        $name = str_replace('/', '.', $name);
        if(View::exists('admin.' . $name)){
            return view('admin.' . $name);
        }
        else{
            return view('admin.examples.' . '404');
        }
    }
}
