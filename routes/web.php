<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\TranslateController;
use App\Models\Page;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('lang/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

Auth::routes();
Route::get('/',[LoginController::class,'showLoginForm'])->name('welcome');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/changeStatus', [UsersController::class,'changeStatus']);
Route::get('profile/',[HomeController::class,'showProfile'])->name('users.profile');
Route::post('profile/',[HomeController::class,'updateProfile'])->name('users.profile_update');
Route::post('/profile_delete',[HomeController::class,'deleteProfile'])->name('users.profile_delete');



Route::group(['prefix' => 'admin'], function () {
	
	//Admin Dashboard
	Route::get('/',[AdminAuthController::class, 'getLogin'])->name('adminLogin');
	Route::get('/login',[AdminAuthController::class, 'getLogin'])->name('adminLogin');
	Route::post('login',[AdminAuthController::class, 'postLogin'])->name('adminLoginPost');
	Route::any('logout',[AdminAuthController::class,'logout'])->name('adminLogout');
	Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
	Route::get('/setting', [AdminController::class, 'setting'])->name('setting');
	Route::post('/setting', [AdminController::class, "updateSetting"])->name('update_setting');
	Route::get('/profile', [AdminController::class, "showProfile"])->name('admin.profile');
	Route::post('/profile', [AdminController::class, "updateProfile"])->name('admin.profile_update');
	Route::get('lang/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
	});

	//Languages
	Route::get('languages',[LanguageController::class,'index'])->name('languages');
	Route::get('languages/create',[LanguageController::class,'create'])->name('language.create');
	Route::post('languages/store',[LanguageController::class,'store'])->name('language.store');
	Route::get('languages/edit/{id}',[LanguageController::class,'edit'])->name('language.edit');
	Route::patch('languages/{id}',[LanguageController::class,'update'])->name('language.update');
	Route::patch('updatetranslation/{id}',[LanguageController::class,'updateTranslation'])->name('language.updatetranslation');
	Route::post('languages/{id}',[LanguageController::class,'destroy'])->name('language.destroy');
	Route::get('languages/{id}',[LanguageController::class,'translate'])->name('language.show');

	//translation
	Route::get('translation',[TranslateController::class,'index'])->name('translation');
	Route::post('filter_lang',[TranslateController::class,'filter_language'])->name('filter_lang');
	Route::get('translation/create',[TranslateController::class,'create'])->name('translate.create');
	Route::post('translation/store',[TranslateController::class,'store'])->name('translate.store');
	Route::get('translation/edit/{id}',[TranslateController::class,'edit'])->name('translate.edit');
	Route::patch('translation/{id}',[TranslateController::class,'update'])->name('translate.update');
	Route::delete('translation/{id}',[TranslateController::class,'destroy'])->name('translate.destroy');
	Route::get('translation/{id}',[TranslateController::class,'show'])->name('translate.show');

	//Users
	Route::get('users',[UsersController::class,'index'])->name('users');
	Route::get('users/create',[UsersController::class,'create'])->name('users.create');
	Route::post('users/store',[UsersController::class,'store'])->name('users.store');
	Route::get('users/edit/{id}',[UsersController::class,'edit'])->name('users.edit');
	Route::patch('users/{id}',[UsersController::class,'update'])->name('users.update');
	Route::delete('users/{id}',[UsersController::class,'destroy'])->name('users.destroy');
	Route::get('users/{id}',[UsersController::class,'show'])->name('users.show');
	
    Route::resource('pages', PagesController::class);


});

Route::any('/{page:slug}', [PagesController::class,'show']);