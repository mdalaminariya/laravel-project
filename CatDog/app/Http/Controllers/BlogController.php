<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use function Pest\Laravel\delete;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(3);
        return view('dashboard.blog.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status',"active")->latest()->get();
        return view('dashboard.blog.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $manager = new ImageManager(new Driver());

        $request->validate([
            'category_id' => 'required',
            'thumbnail' => 'required',
            'title' => 'required',
            'short_description' => 'required',
            'description' => 'required',
        ]);


        if($request->hasFile('thumbnail')){

            $newname = Auth::user()->id .'-'.Str::random(4).'.'.$request->file('thumbnail')->getClientOriginalExtension();
            $image = $manager->read($request->file('thumbnail'));
            $image->toPng()->save(base_path('public/upload/blog/'.$newname));

            if($request->slug){
                Blog::create([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'thumbnail' => $newname,
                    'title' => $request->title,
                    'slug' => Str::slug($request->slug,'-'),
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                ]);
                return redirect()->route('blog.index')->with('Blog_success','Blog Created Successfully..!');
            }else{
                Blog::create([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'thumbnail' => $newname,
                    'title' => $request->title,
                    'slug' => Str::slug($request->title,'-'),
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                ]);
                return redirect()->route('blog.index')->with('Blog_success','Blog Created Successfullly..!');
            }
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $categories = Category::where('status','active')->latest()->get();
        return view('dashboard.blog.edit',compact('blog','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $manager = new ImageManager(new Driver());

        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'short_description' => 'required',
            'description' => 'required',
        ]);


        if($request->hasFile('thumbnail')){
            $old_path = base_path('public/upload/blog/'.$blog->thumbnail);
                if(file_exists($old_path)){
                    unlink($old_path);
                }
            $newname = Auth::user()->id .'-'.Str::random(4).'.'.$request->file('thumbnail')->getClientOriginalExtension();
            $image = $manager->read($request->file('thumbnail'));
            $image->toPng()->save(base_path('public/upload/blog/'.$newname));

            if($request->slug){
                Blog::find($blog->id)->update([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'thumbnail' => $newname,
                    'title' => $request->title,
                    'slug' => Str::slug($request->slug,'-'),
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                ]);
                return redirect()->route('blog.index')->with('Blog_success','Blog Updated Successfully..!');
            }else{
                Blog::find($blog->id)->update([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'thumbnail' => $newname,
                    'title' => $request->title,
                    'slug' => Str::slug($request->title,'-'),
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                ]);
                return redirect()->route('blog.index')->with('Blog_success','Blog Updated Successfully..!');
            }
        }else{
            if($request->slug){
                Blog::find($blog->id)->update([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'title' => $request->title,
                    'slug' => Str::slug($request->slug,'-'),
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                ]);
                return redirect()->route('blog.index')->with('Blog_success','Blog Updated Successfully..!');
            }else{
                Blog::find($blog->id)->update([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'title' => $request->title,
                    'slug' => Str::slug($request->title,'-'),
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                ]);
                return redirect()->route('blog.index')->with('Blog_success','Blog Updated Successfully..!');
            }
        }


    }

    public function status($id){
        $blog = Blog::where('id',$id)->first();

        if($blog->status == 'active'){
            Blog::find($blog->id)->update([
                'status'=>'deactive',
                'updated_at'=>now(),
            ]);
            return redirect()->route('blog.index')->with('Blog_success','Blog Status Successfully Updated..!');

        }else{
            Blog::find($blog->id)->update([
                'status'=>'active',
                'updated_at'=>now(),
            ]);
            return redirect()->route('blog.index')->with('Blog_success','Blog Status Successfully Updated..!');

        }
      }



    /**
     * Remove the specified resource from storage.
     */

     public function destroy(Blog $blog)
     {
        $old_path = base_path('public/upload/blog/'.$blog->thumbnail);
            if(file_exists($old_path)){
                unlink($old_path);
            }
         Blog::find($blog->id)->delete();
         return redirect()->route('blog.index')->with('Blog_success','Blog Deleted Successfull..!');
     }
 }
