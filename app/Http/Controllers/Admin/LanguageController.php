<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Translate;
use Lang;
use File;

use Illuminate\Support\Facades\DB;


class LanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

     public function index()
    {
        $language = Language::get();
        return view('admin.language.index', compact('language'));
    }

    public function create()
    {
        return view('admin.language.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'language' => 'required',
            'slug' => 'required',
        ]);
        $destinationPath = '/img/profile'; 
        $file =  $request->file('flag'); 
        $file->storeAs($destinationPath,$file->getClientOriginalName()); 
        Language::create([
           'language' => $request['language'],
            'slug' => $request['slug'],
            'flag' => $file->getClientOriginalName(),
        ]);
        $translate = Translate::where('language','en')->get()->toArray();
        foreach ($translate as $key => $value) {
            $insert = Translate::insert([
                'key'=>$value['key'],
                'value'=>$value['value'],
                'language'=>$request['slug']
            ]);
        }
        return redirect()->route('languages')->with('success','Language added successfully.');
    }

    public function edit($id)
    { 
    	$language  = Language::findOrFail($id);
        return view('admin.language.edit',compact('language'));
    }

    public function update(Request $request, Language $language)
    { 
        $request->validate([
            'language' => 'required',
            'slug' => 'required',
        ]);

        $destinationPath = '/img/profile'; 
        $file =  $request->file('flag'); 
        if($file!='')
        { 
            $file->storeAs($destinationPath,$file->getClientOriginalName()); 
            $language->where('id', $request->id)->update(['flag'=>$file->getClientOriginalName() ]);
        } 

        $language->where('id', $request->id)->update([
            'language' => $request->language,
            'slug' => $request->slug,
       ]); 
    
        return redirect()->route('languages')->with('success','Language updated successfully');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $language = Language::findOrFail($id);  $path = base_path('resources/lang/'.$language->slug.'.json'); 
        $language->delete();
        $translate = Translate::where('language', $language->slug)->delete();
        File::delete($path);


        return redirect()->route('languages')
            ->with('success', Lang::get('Language deleted successfully.'));
    }
    public function translate($id){
        $language = Language::findOrFail($id);
        $translate = Translate::where('language',$language->slug)->get();
        return view('admin.language.show',compact('language','translate'));
    }

    public function updateTranslation(Request $request){
       $language = Language::find($request->id);
       foreach ($request->key as $index => $val) {
        Translate::where('key', $val)->where('language',$language->slug)->update([
            'value' => $request->value[$index],
       ]); 
       }

        $translate = Translate::select('key','value')->where('language',$language->slug)->get()->toArray();
        $keys = array_column($translate, 'key');
        $values = array_column($translate, 'value');

        $json = array_combine($keys, $values);

        $data = json_encode(($json),JSON_PRETTY_PRINT);
        file_put_contents(base_path('resources/lang/'.$language->slug.'.json'), stripslashes($data));

       return redirect()->route('languages')
            ->with('success', Lang::get('Translatation updated successfully.'));
    }

}
