<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Admin;
use App\Models\Translate;
use App\Models\User;
use App\Models\Page;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $users = User::count(); 
        $pages = Page::count();
        return view('admin.dashboard',compact('users','pages'));
    }
    
    public function setting()
    {
        $setting = Setting::find(1);
        return view('admin.pages.setting',compact('setting'));
    }
    
    public function updateSetting(Request $request, Setting $setting) {
        $setting_data = DB::select('select * from setting');
        if(!empty($setting_data))
        {
            foreach($setting_data as $data)
            {
                $id = $data->id;
            }

            // $id = $request->id;
            $destinationPath = '/img/profile'; 
            $logo =  $request->file('logo');
            if($logo!='')
            {
                $logo->storeAs($destinationPath,$logo->getClientOriginalName()); 
                $setting->where('id', $id)->update(['image'=>$logo->getClientOriginalName() ]);
            }
            $favicon = $request->file('favicon');
            if($favicon!='')
            {
                $favicon->storeAs($destinationPath,$favicon->getClientOriginalName()); 
                $setting->where('id', $id)->update(['favicon'=>$favicon->getClientOriginalName() ]);
            }

            setting::where('id', $id)->update([
            'sitename' => $request->sitename,
            ]); 
            return back()->with("success", "Setting Upadted");
        }
    }
    public function showProfile(){
        $admin = auth()->user();
        return view('admin.adminProfile', compact('admin'));
    }

    public function updateProfile(Request $request, Admin $user)
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
        return redirect()->route('dashboard');
    }
}