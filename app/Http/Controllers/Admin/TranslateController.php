<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Translate;
use App\Models\Language;
use Lang;

class TranslateController extends Controller
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
        $language = Language::all();
        $translate = Translate::get();
        return view('admin.translate.index', compact('translate','language'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = Language::get();
        return view('admin.translate.create',compact('language'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $data = Translate::where('key', $request->key)->where('language',$request->language)->first();
        $request->validate([
            'key' => 'required',
            'value'=>'required',
            'language' => 'required'
        ]);
        if($data){ 
           return redirect()->route('translate.create')->withErrors(['msg' => 'The text is already added']);
        }
        else{
        Translate::create([
            'key' => $request->key,
            'value' => $request->value,
            'language' => $request->language,
        ]);

        $translate = Translate::select('key','value')->where('language',$request->language)->get()->toArray();
        $keys = array_column($translate, 'key');
        $values = array_column($translate, 'value');

        $json = array_combine($keys, $values);

        $data = json_encode(($json),JSON_PRETTY_PRINT);
        file_put_contents(base_path('resources/lang/'.$request->language.'.json'), stripslashes($data));

        return redirect()->route('translation')
            ->with('success',Lang::get('translation added successfully.'));
        }
    }

    public function edit($id)
    {   $language = Language::get();
        $translate  = Translate::findOrFail($id);
        return view('admin.translate.edit', compact('translate','language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\training  $training
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Translate $translate)
    {
        $request->validate([
            'key' => 'required',
            'value' => 'required',
            'language' => 'required',
        ]);
        $id = $request->id;
        $translate->where('id', $id)->update([
            'key' => $request->key,
            'value' => $request->value,
            'language' =>$request->language,
       ]);  

        $translate = Translate::select('key','value')->where('language',$request->language)->get()->toArray();
        $keys = array_column($translate, 'key');
        $values = array_column($translate, 'value');

        $json = array_combine($keys, $values);

        $data = json_encode(($json),JSON_PRETTY_PRINT);
        file_put_contents(base_path('resources/lang/'.$request->language.'.json'), stripslashes($data));


        return redirect()->route('translation')
            ->with('success', Lang::get('Translation updated successfully.'));
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
        $data = Translate::findOrFail($id); 
        $language = $data->language;
        $data->delete();

        $translate = Translate::select('key','value')->where('language',$language)->get()->toArray();
        $keys = array_column($translate, 'key');
        $values = array_column($translate, 'value');

        $json = array_combine($keys, $values);

        $data = json_encode(($json),JSON_PRETTY_PRINT);
        file_put_contents(base_path('resources/lang/'.$language.'.json'), stripslashes($data));

        // return redirect()->route('translation')
        //     ->with('success', Lang::get('Translation deleted successfully.'));
    }

   
    
   }