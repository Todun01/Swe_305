<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BreakingNews;
use App\Models\Category;
use App\Models\Posts;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
Use Alert;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function home(){
        return view("admin.home");
    }

    public function category(){
        $categories = Category::all();
        return view("admin.category", compact('categories'));
    }
    public function addCategory(Request $request){
        $category = new Category();
        $category->category = $request->input("category");
        $validator = Validator::make($request->all(), [
            'category' => 'required|string|unique:categories',
            
        ]);
        $slug =strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', '-', $request->input("title"))));
        if ($validator->fails()) {
            Alert::error('Oops!', 'Unsuccessful Submission')->persistent('Close');
            return redirect()->back();
        }

        $category->slug = $slug;
        if($category->save()){
            Alert::success('Success!','Category submitted successfully')->persistent('Close');
            return redirect()->back();
        };
        Alert::error('Oops!', 'Unsuccessful Submission')->persistent('Close');
    }
    public function updateCategory(Request $request){
        $category = Category::find($request->input('category_id'));
        $category->category = $request->input('category');
        $validator = Validator::make($request->all(), [
            'category' => 'required|string|unique:categories',
            'category_id' => 'required',
            
        ]);
        if ($validator->fails()) {
            Alert::error('Oops!', 'Failed to update category')->persistent('Close');
            return redirect()->back();
        }
        if(!$category = Category::find($request->input('category_id'))){
            Alert::error('Oops!', 'Category not found')->persistent('Close');
            return redirect()->back();
        }
        if($request->input('category') != $category->category){
            $slug =strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', '-', $request->input("category"))));
            $category->slug = $slug;
            $category->category = $request->input("category");
        }
        if($category->save()){
            Alert::success('Success!','Category updated successfully')->persistent('Close');
            return redirect()->back();
        }
    }
    public function deleteCategory(Request $request){
        $category = Category::find($request->input('category_id'));
        $category->category = $request->input('category');
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            
        ]);
        if ($validator->fails()) {
            Alert::error('Oops!', 'Failed to delete category')->persistent('Close');
            return redirect()->back();
        }
        if(!$category = Category::find($request->input('category_id'))){
            Alert::error('Oops!', 'Category not found')->persistent('Close');
            return redirect()->back();
        }
        if($request->input('category') != $category->category){
            $slug =strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', '-', $request->input("category"))));
            $category->slug = $slug;
            $category->category = $request->input("category");
        }
        if($category->forceDelete()){
            Alert::success('Success!','Category deleted successfully')->persistent('Close');
            return redirect()->back();
        }
    }
    public function posts(){
        $posts = Post::with('category')->get();
        $categories = Category::all();
        return (view ("admin.posts" , [
            "categories"=> $categories,
            "posts"=> $posts,
        ]));
    }
    public function addPost(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required',
            'post_body' => 'required',
            'category_id' => 'required',
            'image' => 'mimes:jpeg,jpg,png|required|max:10000'
        ]);
        
        if ($validator->fails()) {
            Alert::error('Error!', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }
        $admin = Auth::guard('admin')->user();
        $admin_id = $admin->id;
        $title = $request->title;
        $description = $request->description;
        $post_body = $request->post_body;
        $category_id = $request->category_id;
        $slug =strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', '-', $request->title)));
        $imageUrl = 'uploads/posts/'. $slug.'.'.$request->file('image')->getClientOriginalExtension();
        $image = $request->file('image')->move('uploads/posts',$imageUrl);
        $newPost =([
            'title' => $title,
            'description'=> $description,
            'category_id'=> $category_id,
            'admin_id' => $admin_id,
            'post_body' => $post_body,
            'image' => $imageUrl,
            'slug'=> $slug

        ]);
        if($createPost = Post::create($newPost)){
            Alert::success('Success!','Post submitted successfully')->persistent('Close');
            return redirect()->back();
        };
        Alert::error('Oops!', 'Unsuccessful Submission')->persistent('Close');


        
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
