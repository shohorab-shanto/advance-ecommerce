<?php

use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\CartPageController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;

use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;

use App\Models\User;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// user all

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $id = Auth::user()->id;
    $user = User::find($id);
    return view('dashboard',compact('user'));
})->name('dashboard');

Route::get('/',[IndexController::class, 'index']);

Route::get('/user/logout',[IndexController::class, 'UserLogout'])->name('user.logout');

Route::get('/user/profile',[IndexController::class, 'UserProfile'])->name('user.profile');

Route::post('/user/profile/store',[IndexController::class, 'UserProfileStore'])->name('user.profile.store');

Route::get('/user/change/password',[IndexController::class, 'UserChangePassword'])->name('change.password');

Route::post('/user/password/update',[IndexController::class, 'UserPasswordUpdate'])->name('user.password.update');


Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']],function(){
    Route::get('/login',[AdminController::class, 'loginForm']);
    Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:admin'])->group(function(){

Route::middleware(['auth:sanctum,admin', 'verified'])->get('admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard');



// admin all route
Route::get('/admin/logout',[AdminController::class, 'destroy'])->name('admin.logout');

Route::get('/admin/profile',[AdminProfileController::class, 'AdminProfile'])->name('admin.profile');

Route::get('/admin/profile/edit',[AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');

Route::post('/admin/profile/store',[AdminProfileController::class, 'AdminProfileStore'])->name('admin.profile.store');

Route::get('/admin/change/password',[AdminProfileController::class, 'AdminChangePassword'])->name('admin.change.password');

Route::post('/update/change/password',[AdminProfileController::class, 'AdminUpdateChangePassword'])->name('update.change.password');



// admin brand all route

Route::prefix('brand')->group(function(){

Route::get('/view',[BrandController::class, 'BrandView'])->name('all.brand');

Route::post('/store',[BrandController::class, 'BrandStore'])->name('brand.store');

Route::get('/edit/{id}',[BrandController::class, 'BrandEdit'])->name('brand.edit');

Route::post('/update',[BrandController::class, 'BrandUpdate'])->name('brand.update'); //eikhne url e id nei nai karon form e hidden kor e id niea nici

Route::get('/delete/{id}',[BrandController::class, 'BrandDelete'])->name('brand.delete');

});

// admin category all route

Route::prefix('category')->group(function(){

    Route::get('/view',[CategoryController::class, 'CategoryView'])->name('all.category');

    Route::post('/store',[CategoryController::class, 'CategoryStore'])->name('category.store');

    Route::get('/edit/{id}',[CategoryController::class, 'CategoryEdit'])->name('category.edit');

    Route::post('/update',[CategoryController::class, 'CategoryUpdate'])->name('category.update'); //eikhne url e id nei nai karon form e hidden kor e id niea nici

    Route::get('/delete/{id}',[CategoryController::class, 'CategoryDelete'])->name('category.delete');

    //Admin sub category all route

    Route::get('/sub/view',[SubCategoryController::class, 'SubCategoryView'])->name('all.subcategory');

    Route::post('/sub/store',[SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');

    Route::get('/sub/edit/{id}',[SubCategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');

    Route::post('/sub/update',[SubCategoryController::class, 'SubCategoryUpdate'])->name('subcategory.update'); //eikhne url e id nei nai karon form e hidden kor e id niea nici

    Route::get('/sub/delete/{id}',[SubCategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');

    //Admin sub->sub category all route

    Route::get('/sub/sub/view',[SubCategoryController::class, 'SubSubCategoryView'])->name('all.subsubcategory');

    Route::get('/subcategory/ajax/{category_id}',[SubCategoryController::class, 'GetSubCategory']); //for sub cat

    Route::get('/sub-subcategory/ajax/{subcategory_id}',[SubCategoryController::class, 'GetSubSubCategory']); //for sub-sub cat

    Route::post('/sub/sub/store',[SubCategoryController::class, 'SubSubCategoryStore'])->name('subsubcategory.store');

    Route::get('/sub/sub/edit/{id}',[SubCategoryController::class, 'SubSubCategoryEdit'])->name('subsubcategory.edit');

    Route::post('/sub/sub/update',[SubCategoryController::class, 'SubSubCategoryUpdate'])->name('subsubcategory.update');

    Route::get('/sub/sub/delete/{id}',[SubCategoryController::class, 'SubSubCategoryDelete'])->name('subsubcategory.delete');
    });

// admin product all route

Route::prefix('product')->group(function(){

    Route::get('/add',[ProductController::class, 'AddProduct'])->name('add-product');

    Route::post('/store',[ProductController::class, 'StoreProduct'])->name('product-store');

    Route::get('/manage',[ProductController::class, 'ManageProduct'])->name('manage-product');

    Route::get('/edit/{id}',[ProductController::class, 'EditProduct'])->name('product.edit');

    Route::post('/data/update',[ProductController::class, 'ProductDataUpdate'])->name('product-update');

    Route::post('/image/update',[ProductController::class, 'MultiImageUpdate'])->name('update-product-image');

    Route::post('/thambnail/update',[ProductController::class, 'ThambnailImageUpdate'])->name('update-product-thambnail');

    //For Delete multiImg
    Route::get('/multiimg/delete/{id}',[ProductController::class, 'MultiImageDelete'])->name('product.multiimg.delete');

    //For inactive
    Route::get('/inactive/{id}',[ProductController::class, 'ProductInactive'])->name('product.inactive');

    //For active
    Route::get('/active/{id}',[ProductController::class, 'ProductActive'])->name('product.active');
    //For delete cat
    Route::get('/delete/{id}',[ProductController::class, 'ProductDelete'])->name('product.delete');

    });

    // admin slider all route

Route::prefix('slider')->group(function(){

    Route::get('/view',[SliderController::class, 'SliderView'])->name('manage-slider');

    Route::post('/store',[SliderController::class, 'SliderStore'])->name('slider.store');

    Route::get('/edit/{id}',[SliderController::class, 'SliderEdit'])->name('slider.edit');

    Route::post('/update',[SliderController::class, 'SliderUpdate'])->name('slider.update'); //eikhne url e id nei nai karon form e hidden kor e id niea nici

    Route::get('/delete/{id}',[SliderController::class, 'SliderDelete'])->name('slider.delete');

    //For inactive
    Route::get('/inactive/{id}',[SliderController::class, 'SliderInactive'])->name('slider.inactive');

    //For active
    Route::get('/active/{id}',[SliderController::class, 'SliderActive'])->name('slider.active');

    });


}); // end middleware admin

// frontend all routes
// multilanguage all route

Route::get('/language/hindi',[LanguageController::class, 'Hindi'])->name('hindi.language');

Route::get('/language/english',[LanguageController::class, 'English'])->name('english.language');

//product details url

Route::get('product/details/{id}/{slug}',[IndexController::class, 'ProductDetails']);

//frontend product tag
Route::get('product/tag/{tag}',[IndexController::class, 'TagWiseProduct']);
//Frontend subcat wise data
Route::get('subcategory/product/{subcat_id}/{slug}',[IndexController::class, 'SubCatWiseProduct']);
//Frontend subsubcat wise data
Route::get('subsubcategory/product/{subsubcat_id}/{slug}',[IndexController::class, 'SubSubCatWiseProduct']);

//Product View Modal With Ajax
Route::get('/product/view/modal/{id}',[IndexController::class, 'ProductViewAjax']);

//Add to Cart store data With Ajax
Route::post('/cart/data/store/{id}',[CartController::class, 'AddToCart']);

//get data from mini cart
Route::get('/product/mini/cart/',[CartController::class, 'AddMiniCart']);

//remove mini cart
Route::get('/minicart/product-remove/{rowId}',[CartController::class, 'RemoveMiniCart']);

//Add to wishList
Route::post('/add-to-wishlist/{product_id}',[CartController::class, 'AddToWishlist']);




//if user is log in then then can access those url and route
Route::group(['prefix'=>'user','middleware' => ['user','auth'],'namespace'=>'user'],function(){

//wishList page
Route::get('/wishlist',[WishlistController::class, 'ViewWishlist'])->name('wishlist');

//wishList data load in page
Route::get('/get-wishlist-product',[WishlistController::class, 'GetWishlistProduct']);

//wishList remove
Route::get('/wishlist-remove/{id}',[WishlistController::class, 'RemoveWishlistProduct']);


});

//mycart page
Route::get('/user/mycart',[CartPageController::class, 'MyCart'])->name('mycart');

//get cart product in mycart page
Route::get('/user/get-cart-product',[CartPageController::class, 'GetCartProduct']);

//cart remove
Route::get('/user/cart-remove/{rowId}',[CartPageController::class, 'RemoveCartProduct']);

//cart increment
Route::get('/cart-increment{rowId}',[CartPageController::class, 'CartIncrement']);

//cart increment
Route::get('/cart-decrement{rowId}',[CartPageController::class, 'CartDecrement']);


