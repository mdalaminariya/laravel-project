<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class ProfileController extends Controller
{
    public function index(){
        return view('dashboard.profile.index');
    }
    //name update
    public function name_update(Request $request){
        $old_name = Auth::user()->name;
        $request->validate([
            'name' => 'required|ascii',
        ]);

        User::find(auth()->user()->id)->update([
            'name' => $request->name,
            'updated_at' => now(),
        ]);
        return back()->with('name_update',"Name update successfully..! $old_name to $request->name");
    }
    // email update
    public function email_update(Request $request){
        $old_email = Auth::user()->email;
        $request->validate([
            'email' => 'required',
        ]);

        User::find(auth()->user()->id)->update([
            'email' => $request->email,
            'updated_at' => now(),
        ]);
        return back()->with('email_update',"email update successfully..! $old_email to $request->email");
    }
    //password update
    public function password_update(Request $request){
        // return $request->password;
        $request ->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        if(Hash::check($request->current_password,Auth::user()->password)){
            return back()->with('password_update',"password update successfully..!");
        }else{
            return back()->withErrors(['current_password' => "Current password does not Match..!"])->withInput();
        }
    }

    public function image_update(Request $request){
        if($request->hasFile('image')){
            if(Auth::user()->image){
                $old_path = base_path('public/upload/profile/'.Auth::user()->image);
                if(file_exists($old_path)){
                    unlink($old_path);
                }
            }
        $manager = new ImageManager(new Driver());
        $new_name = Auth::user()->id.'-'.now()->format('d m, y').'-'.rand(0,9999).'.'.$request->file('image')->getClientOriginalExtension();
        $image = $manager->read($request->file('image'));
        $image->toPng()->save(base_path('public/upload/profile/'.$new_name));
        User::find(auth()->user()->id)->update([
            'image' => $new_name,
            'updated_at' => now(),
        ]);
        return back()->with('image_update',"image update successfully..!");
    }
}
}
