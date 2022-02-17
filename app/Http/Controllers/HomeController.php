<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['home']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function home()
    { 
        return view('welcome');
    }
     public function deleteProfile()
    {  
        $id = Auth::user()->id;
        $user = User::findOrFail($id); 
        $user->delete(); 
    }

    public function showProfile()
    {
        $users = auth()->user();
        return view('showProfile', compact('users'));
    }
    
     public function updateProfile(Request $request, user $user)
    {  
        $request->validate([
            'name' => 'required',
            'email'=>'required',
        ]);
        $id = auth()->user()->id;
        $destinationPath = '/img/profile'; 
        $file =  $request->file('image');
        if($file!=''){
            $file->storeAs($destinationPath,$file->getClientOriginalName()); 
            $user->where('id', $id)->update(['image'=>$file->getClientOriginalName() ]);
        }
        $user->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Hash::make($request['password']),
       ]);  
     return redirect()->route('home');
    }
}
