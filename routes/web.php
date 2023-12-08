<?php

use App\Http\Controllers\Brand;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Subcategory;
use App\Http\Controllers\SubcategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/ddddd', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::post('/photo/update',[HomeController::class,'Photo_update'])->name('photo.update');
Route::get('/user/list',[HomeController::class,'User_list'])->name('user.list');
Route::get('/user/remove/{id}',[HomeController::class,'User_remove'])->name('user.remove');
Route::get('/category',[CategoryController::class,'Category'])->name('category');
Route::post('/category',[CategoryController::class,'Category_store'])->name('category.store');
Route::get('/category/{id}',[CategoryController::class,'Category_edit'])->name('category.edit');
Route::post('/category/edit/post',[CategoryController::class,'category_edit_store'])->name('category_edit.store');
Route::get('/subcategory',[SubcategoryController::class,'Subcategory'])->name('subcategory');
Route::post('/subcategory/store',[SubcategoryController::class,'Subcategory_store'])->name('subcategory.store');
Route::get('/subcategory/edit/{id}',[SubcategoryController::class,'Subcategory_edit'])->name('subcategory.edit');
Route::post('/subcategory/store/edit/{id}',[SubcategoryController::class,'Subcategory_edit_store'])->name('subcategory_edit.store');
Route::get('/subcategory/delete/{id}',[SubcategoryController::class,'Subcategory_delete'])->name('subcategory.delete');
Route::get('/brand',[Brand::class,'brands'])->name('brand');
Route::post('/brand',[Brand::class,'brands_store'])->name('brand.store');
Route::get('/brand/edit/{id}',[Brand::class,'brands_edit'])->name('brand.edit');
Route::post('/brand/edit/store/{id}',[Brand::class,'brands_edit_store'])->name('brand_edit_store');
Route::get('/brand/delete/{id}',[Brand::class,'brands_delete'])->name('brand.delete');
Route::get('/product',[ProductController::class,'products_index'])->name('product.index');
Route::post('/getsubcategory',[ProductController::class,'getsubcategory']);
Route::post('/product/store',[ProductController::class,'product_store'])->name('product.store');
Route::get('/product/list',[ProductController::class,'product_list'])->name('product.list');
Route::get('/product/list/remove/{id}',[ProductController::class,'product_remove'])->name('product.remove');
Route::get('/product/show/{id}',[ProductController::class,'product_show'])->name('product.show');
Route::get('/variation',[InventoryController::class,'varition'])->name('varition');
Route::post('/variation/post',[InventoryController::class,'varition_post'])->name('varition.post');
Route::post('/size/post',[InventoryController::class,'size_post'])->name('size.post');
Route::get('/inventory/{id}',[InventoryController::class,'inventory'])->name('inventory');
Route::post('/inventory/store/{id}',[InventoryController::class,'inventory_store'])->name('inventory.store');
Route::get('/',[FrontendController::class,'index'])->name('index');
Route::post('/changeStatus',[ProductController::class,'changestatus']);
Route::get('/product/category/{id}',[FrontendController::class,'product_category'])->name('product.category');
Route::get('/product/subcategory/{id}',[FrontendController::class,'product_subcategory'])->name('subcategory_product');
Route::get('/product/details/{slug}',[FrontendController::class,'product_details'])->name('product_details');
//customer auth controller
Route::get('/customer/auth',[CustomerAuthController::class,'customer_register'])->name('customer.register');
Route::get('/customer/auth/login',[CustomerAuthController::class,'customer_login'])->name('customer.login');
Route::post('/customer/auth/store',[CustomerAuthController::class,'customer_store'])->name('customer.store');
Route::post('/customer/login/store',[CustomerAuthController::class,'customer_login_store'])->name('customer_login.store');
Route::get('/customer/profile',[CustomerAuthController::class,'customer_profile'])->name('customer.profile');
Route::post('/customer/profile/update',[CustomerAuthController::class,'customer_update'])->name('customer.update');
Route::get('/customer/logout',[CustomerAuthController::class,'customer_logout'])->name('customer.logout');
Route::post('/card/store',[CardController::class,'card_store'])->name('card.store');
Route::get('/card/show/',[CardController::class,'card_show'])->name('card.shop');
Route::get('/card/remove/{id}',[CardController::class,'card_remove'])->name('card.remove');
Route::post('/card/update',[CardController::class,'card_update'])->name('card.update');
Route::get('/coupon',[CouponController::class,'coupon'])->name('coupon');
Route::post('/coupon/store',[CouponController::class,'coupon_store'])->name('coupon.store');
Route::post('/ChangeCoupon',[CouponController::class,'ChangeCoupon'])->name('ChangeCoupon');
Route::get('/coupon/{id}',[CouponController::class,'coupon_remove'])->name('coupon.remove');
Route::get('/checkout',[CheckoutController::class,'checkout'])->name('checkout');
Route::post('/getsCity',[CheckoutController::class,'getsCity']);
Route::post('/order/store',[CheckoutController::class,'order_store'])->name('order.store');
Route::get('/success',[CheckoutController::class,'order_success'])->name('order.success');
Route::get('/order/list',[CustomerAuthController::class,'orderList'])->name('order.listed');
Route::get('/order/list/download/{id}',[CustomerAuthController::class,'orderDownload'])->name('order.download');
Route::get('/order/admin',[OrderController::class,'orders'])->name('order.admin');
Route::post('/order/active',[OrderController::class,'order_active'])->name('order.active');

require __DIR__.'/auth.php';
