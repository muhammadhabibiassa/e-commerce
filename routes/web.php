<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ChangePassword;
use App\Models\User;
use App\Models\Multipic;
use Illuminate\Support\Facades\DB;

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

Route::group(['middleware' => 'prevent-back-history'],function(){
	// Auth::routes();
    // Route::get('/home', 'HomeController@index');



Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $abouts = DB::table('home_abouts')->first();
    $images = Multipic::all();
    return view('home', compact('brands', 'abouts', 'images'));
});

Route::get('/home', function () {
    echo "This is home page";
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// Category Controller
Route::get('/category/all', [CategoryController::class, 'AllCategory'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCategory'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'EditCategory']);
Route::post('/category/update/{id}', [CategoryController::class, 'UpdateCategory']);
Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);
Route::get('/category/delete/{id}', [CategoryController::class, 'Delete']);

// Brand Controller
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'StoreBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'EditBrand']);
Route::post('/brand/update/{id}', [BrandController::class, 'UpdateBrand']);
Route::get('/brand/delete/{id}', [BrandController::class, 'DeleteBrand']);

// Multi Image Controller
Route::get('/multipics/all', [BrandController::class, 'AllMultipics'])->name('all.multipics');
Route::post('/multipics/add', [BrandController::class, 'StoreMultipics'])->name('store.multipics');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    
    // $users = User::all();

    // $users = DB::table('users')->get();
    return view('admin.index');
})->name('dashboard');

Route::get('/user/logout', [BrandController::class, 'Logout'])->name('user.logout');

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

// Admin ALL Route
Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');
Route::get('/add/slider', [HomeController::class, 'AddSlider'])->name('add.slider');
Route::post('/store/slider', [HomeController::class, 'StoreSlider'])->name('store.slider');
Route::get('/edit/slider/{id}', [HomeController::class, 'EditSlider']);
Route::post('/update/slider/{id}', [HomeController::class, 'UpdateSlider']);
Route::get('/delete/slider/{id}', [HomeController::class, 'DeleteSlider']);

// Home About ALL Route
Route::get('/home/about', [AboutController::class, 'HomeAbout'])->name('home.about');
Route::get('/add/about', [AboutController::class, 'AddAbout'])->name('add.about');
Route::post('/store/about', [AboutController::class, 'StoreAbout'])->name('store.about');
Route::get('/edit/about/{id}', [AboutController::class, 'EditAbout']);
Route::post('/update/about/{id}', [AboutController::class, 'UpdateAbout']);
Route::get('/delete/about/{id}', [AboutController::class, 'DeleteAbout']);

// Portfolio Route
Route::get('/portfolio', [AboutController::class, 'Portfolio'])->name('portfolio');

// Admin Contact Route
Route::get('/admin/contact', [ContactController::class, 'AdminContact'])->name('admin.contact');
Route::get('/admin/add/contact', [ContactController::class, 'AdminAddContact'])->name('add.contact');
Route::post('/admin/store/contact', [ContactController::class, 'AdminStoreContact'])->name('store.contact');

// Admin Message Route
Route::get('/admin/message', [ContactController::class, 'AdminMessage'])->name('admin.message');

// Home Contact Page Route
Route::get('/contact', [ContactController::class, 'Contact'])->name('contact');
Route::post('/contact/form', [ContactController::class, 'ContactForm'])->name('contact.form');

// Change Password & User Profile Route
Route::get('/user/password', [ChangePassword::class, 'ChangePassword'])->name('change.password')->middleware('auth');
Route::post('/password/update', [ChangePassword::class, 'UpdatePassword'])->name('password.update');

// User Profile
Route::get('/user/profile', [ChangePassword::class, 'UpdateProfile'])->name('profile.update');
Route::post('/user/profile/update', [ChangePassword::class, 'UpdateUserProfile'])->name('update.user.profile');

}); // Prevent Back Middleware/