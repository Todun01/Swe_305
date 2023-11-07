<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
Use Alert;
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
    public function users(){
        return view("admin.users");
    }
    
    public function addCategory(Request $request){

        $category = new Category();
        $category->category = $request->input("category");
        $validator = Validator::make($request->all(), [
            'category' => 'required|string|unique:categories',
            
        ]);
        if ($validator->fails()) {
            Alert::error('Oops!', 'Unsuccessful Submission')->persistent('Close');
            return redirect()->back();
        }
        Alert::success('Success!','Category submitted successfully')->persistent('Close');
        $category->save();
        return redirect()->back();
    }
}
