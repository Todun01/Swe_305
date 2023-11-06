<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        return view("admin.home");
    }

    public function category(){
        return view("admin.category");
    }
    public function blogspot(){
        return view("admin.posts");
    }
    public function bn(){
        return view("admin.bn");
    }
    public function newsletter(){
        return view("admin.newsletter");
    }
    public function userrs(){
        return view("admin.users");
    }
}
