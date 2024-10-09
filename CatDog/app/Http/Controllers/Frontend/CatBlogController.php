<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class CatBlogController extends Controller
{
    public function Show_details($slug){
        $category = Category::where('slug',$slug)->first();
        $blogs = Blog::where('category_id',$category->id)->latest()->paginate(1);
        return view('frontend.cateblog.index',compact('category','blogs'));
    }
}
