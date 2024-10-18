<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RequestController extends Controller
{

    public function index(){

        $requests = ModelsRequest::latest()->get();
        return view('dashboard.request.index',compact('requests'));
    }

    public function accept($id){

        $request = ModelsRequest::where('id',$id)->first();

        User::find($request->user_id)->update([
            'role' => 'blogger',
            'update_at' => now(),
        ]);

        ModelsRequest::find($id)->delete();

        return redirect()->route('request.show')->with('accept_success','Request Accept Successfully..!');


    }

    public function reject($id){

        $request = ModelsRequest::where('id',$id)->first();

        ModelsRequest::find($id)->delete();

        return redirect()->route('request.show')->with('accept_success','Request Remove Successfully..!');


    }



    public function send_request(Request $request,$id){
        $request->validate([
            'feedback' => 'required',
        ]);

        ModelsRequest::create([
            'user_id' => $id,
            'feedback' => $request->feedback,
            'created_at' => now(),
        ]);
        return redirect()->route('home')->with('Success','Request Sent Successfully..!');
    }
}
