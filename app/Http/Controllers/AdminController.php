<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;



class AdminController extends Controller
{
    public function viewLinks($name) {
        if (empty($name)) {
            $name = 'index';
        }

        if(View::exists('admin/' . $name)){
            return view('admin/' . $name);
        }
        else{
            return view('admin/' . '404');
        }
    }
}
