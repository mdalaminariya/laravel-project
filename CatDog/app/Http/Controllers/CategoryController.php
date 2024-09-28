<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request){
        $categories = Category::all();
        return view('dashboard.category.index',compact('categories'));
    }

    public function store(Request $request){
        $manager = new ImageManager(new Driver());

       $request -> validate([
        'title' => 'required',
        'image' => 'required|image',
       ]);
       if($request->hasFile('image')){
        $new_name = auth()->user()->id .'-'. $request->title.'-'.rand(1111,9999).'.'. $request->file('image')->getClientOriginalExtension();
        $image = $manager->read($request->file('image'));
        $image->toPng()->save(base_path('public/upload/category/'.$new_name));

        if($request->slug){
        Category::insert([
            'title' => Str::ucfirst($request->title),
            'slug' => str::slug($request->slug,'-'),
            'image' => $new_name,
            'created_at' => now(),
        ]);
        return back()->with('category_success','Category Insert Successfully..!');
    }else{
        Category::insert([
            'title' => Str::ucfirst($request->title),
            'slug' => str::slug($request->title,'-'),
            'image' => $new_name,
            'created_at' => now(),
        ]);
        return back()->with('category_success','Category Insert Successfully..!');
    }
        }
    }

    public function edit($id){
        $category = Category::where('slug',$id)->first();

        return view('dashboard.category.edit',compact('category'));
    }
    public function update(Request $request , $slug){
        $manager = new ImageManager(new Driver());
        $category = Category::where('slug',$slug)->first();

        $request -> validate([
            'title' => 'required',
           ]);

           if($request->hasFile('image')){
            if($category->image){
                $old_path = base_path('public/upload/category/'.$category->image);
                if(file_exists($old_path)){
                    unlink($old_path);
                }
            }

            $new_name = auth()->user()->id .'-'. $request->title.'-'.rand(1111,9999).'.'. $request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/upload/category/'.$new_name));

            if($request->slug){
                Category::find($category->id)->update([
                    'title' =>$request->title,
                    'slug' =>Str::slug($request->slug,'-'),
                    'image' =>$new_name,
                    'updated_at' =>now(),
                ]);
        return redirect()->route('category.index')->with('category_success','Category Update Successfully..!');

            }else{
                Category::find($category->id)->update([
                    'title'=>$request->title,
                    'slug' =>Str::slug($request->title,'-'),
                    'updated_at'=>now(),
                ]);
        return redirect()->route('category.index')->with('category_success','Category Update Successfully..!');

            }

           }else{

            if($request->slug){
                Category::find($category->id)->update([
                    'title' =>$request->title,
                    'slug' =>Str::slug($request->slug,'-'),
                    'updated_at' =>now(),
                ]);
        return redirect()->route('category.index')->with('category_success','Category Update Successfully..!');

            }else{
                Category::find($category->id)->update([
                    'title'=>$request->title,
                    'slug' =>Str::slug($request->title,'-'),
                    'updated_at'=>now(),
                ]);
        return redirect()->route('category.index')->with('category_success','Category Update Successfully..!');

            }
           }
    }

    public function delete($slug){
        $category = Category::where('slug',$slug)->first();
        if($category->image){
            $old_path = base_path('public/upload/category/'.$category->image);
            if(file_exists($old_path)){
                unlink($old_path);
            }
        }
        Category::find($category->id)->delete();
        return redirect()->route('category.index')->with('category_success','Category Delete Successfully..!');

    }

  public function status($slug){
    $category = Category::where('slug',$slug)->first();

    if($category->status == 'active'){
        Category::find($category->id)->update([
            'status'=>'deactive',
            'updated_at'=>now(),
        ]);
        return redirect()->route('category.index')->with('category_success','Category Status Successfully Updated..!');

    }else{
        Category::find($category->id)->update([
            'status'=>'active',
            'updated_at'=>now(),
        ]);
        return redirect()->route('category.index')->with('category_success','Category Status Successfully Updated..!');

    }
  }
}
