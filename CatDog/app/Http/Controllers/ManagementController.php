<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ManagementController extends Controller
{
    public function index(){
        $managers = User::where('role','manager')->get();
        return view('dashboard.management.auth.register', compact('managers'));
    }

    public function store_register(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => 'required|in:manager,blogger,user',
        ]);

        if(!$request->role == ""){

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => $request->role,
            ]);
            return back()->with('register_complete','Registration Successfully Completed.!');
        }else{
            return back()->withErrors(['role'=>'please select role first.!'])->withInput();
        }

    }

    public function manager_down($id){
        $manager = User::where('id',$id)->first();

            if($manager->role == 'manager'){
                User::find($manager->id)->update([
                    'role'=>'user',
                    'updated_at'=>now(),
                ]);
                return back()->with('register_complete','Manager Demotion Successfully.!');
            }
    }

    //role manage

    public function role_index(){
        $bloggers = User::where('role','blogger')->get();
        $users = User::where('role','user')->where('block',false)->get();
        return view('dashboard.management.role.role',[
            'users' => $users,
            'bloggers' =>$bloggers,
            ]);
    }

    public function role_assign(Request $request){
        $request->validate([
            'role' => 'required|in:manager,blogger,user',
        ]);

        $user = User::where('id',$request->user_id)->first();

        User::find($user->id)->update([
            'role' => $request->role,
            'update_at' => now(),
        ]);

        Session::flash('AssignRoll_complete','Role Promotion Successfully..!');

        return back();
    }

    public function blogger_grade_down($id){
        $user = User::where('id',$id)->first();

        User::find($user->id)->update([
            'role' => 'user',
            'update_at' => now(),
        ]);

        Session::flash('AssignRoll_complete','Role Demotion Successfully..!');

        return back();
    }


    public function user_grade_down($id){
        $user = User::where('id',$id)->first();

        if($user->role == 'user'){
            User::find($user->id)->update([
                'block' =>true,
                'updated_at'=>now(),
            ]);
            Session::flash('AssignRoll_complete','User Block Successfully..!');

            return back();
        }
    }


    public function user_delete($id){
        $user = User::where('id',$id)->first();

        User::find($user->id)->delete();


        Session::flash('AssignRoll_complete','User Delete Successfully..!');

            return back();
    }

    public function blogger_delete($id){
        $blogger = User::where('id',$id)->first();

        User::find($blogger->id)->delete();

        Session::flash('AssignRoll_complete','Blogger Delete Successfully..!');

        return back();
    }

}
