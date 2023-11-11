<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BreakingNews;
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
        $categories = Category::all();
        return view("admin.category", compact('categories'));
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
        $slug =strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', '-', $request->input("category"))));
        if ($validator->fails()) {
            Alert::error('Oops!', 'Unsuccessful Submission')->persistent('Close');
            return redirect()->back();
        }
        Alert::success('Success!','Category submitted successfully')->persistent('Close');
        $category->slug = $slug;
        $category->save();
        return redirect()->back();
    }
    public function editCategory($id){
        $category = Category::find($id);
        return response()->json([
            'status' => 200,
            'category' => $category,
        ]);
    }
    public function updateCategory(Request $request){
        $category_id = $request->input('category_id');
        $category = Category::find($category_id);
        $category->category = $request->input('category');
        $validator = Validator::make($request->all(), [
            'category' => 'required|string|unique:categories',
            
        ]);
        $slug =strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', '-', $request->input("category"))));
        if ($validator->fails()) {
            Alert::error('Oops!', 'Failed to update category')->persistent('Close');
            return redirect()->back();
        }
        Alert::success('Success!','Category updated successfully')->persistent('Close');
        $category->slug = $slug;
        $category->update();
        return redirect()->back();
    }
    public function deleteCategory(Request $request){
        $category_id = $request->input('delete_id');
        $category = Category::find( $category_id );
        $category->delete();
        $validator = Validator::make($request->all(), [
            'category' => '',
        ]);
        if ($validator->fails()) {
            Alert::error('Oops!', 'Failed to delete category')->persistent('Close');
            return redirect()->back();
        }
        Alert::success('Success!','Category deleted successfully')->persistent('Close');
        return redirect()->back();
    }
    public function addBN(Request $request){

        $BN = new BreakingNews();
        $BN->title = $request->input("breaking_news");
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|unique:breaking_news',
            
        ]);
        if ($validator->fails()) {
            Alert::error('Oops!', 'Unsuccessful Submission')->persistent('Close');
            return redirect()->back();
        }
        Alert::success('Success!','Breaking News submitted successfully')->persistent('Close');
        $BN->save();
        return redirect()->back();
    }
}
