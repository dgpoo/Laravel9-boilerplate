<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Lang;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = User::all();
        $users = User::get();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email'=>'required',
        ]);
        $destinationPath = '/img/profile'; 
        $file =  $request->file('image'); 
        $file->storeAs($destinationPath,$file->getClientOriginalName()); 

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'image' => $file->getClientOriginalName(),
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->route('users')
            ->with('success',Lang::get('User created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\training  $training
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user  = User::findOrFail($id);
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\training  $training
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user  = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\training  $training
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $id = $request->id;
        $destinationPath = '/img/profile'; 
        $file =  $request->file('image');
        if($file!='')
        {
            $file->storeAs($destinationPath,$file->getClientOriginalName()); 
            $user->where('id', $id)->update(['image'=>$file->getClientOriginalName() ]);
        }
        $user->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Hash::make($request['password']),
       ]);  
        return redirect()->route('users')
            ->with('success', Lang::get('User updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\training  $training
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $user = User::findOrFail($id);
        $user->delete();

        // return redirect()->route('users')
        //     ->with('success', Lang::get('User deleted successfully.'));
    }
    
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        $user = User::find($request->id);
        $user->status = $request->status;
        $user->save();
  
        return response()->json(['success'=>Lang::get('Status change successfully.')]);
    }

}
