<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;


Route::get('/',[HomeController::class,'home']);

Route::get('/dashboard',[HomeController::class,'login_home'])->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//Admin Route:
Route::get('/admin/dashboard',[HomeController::class,'index'])->middleware(['auth','admin']);

//Admin Category:
Route::get('/admin/category',[AdminController::class,'category'])->middleware(['auth','admin'])->name('category');

Route::post('/admin/add_category',[AdminController::class,'add_category'])->middleware(['auth','admin'])->name('add.category');

Route::get('/admin/delete_category/{id}',[AdminController::class,'delete_category'])->middleware(['auth','admin'])->name('delete.category');

Route::get('/admin/edit_category/{id}',[AdminController::class,'edit_category'])->middleware(['auth','admin'])->name('edit.category');

Route::post('/admin/update_category/{id}',[AdminController::class,'update_category'])->middleware(['auth','admin'])->name('update.category');

Route::get('/admin/add_product',[AdminController::class,'add_product'])->middleware(['auth','admin'])->name('add.product');

Route::post('/admin/upload_product',[AdminController::class,'upload_product'])->middleware(['auth','admin'])->name('upload.product');

Route::get('/admin/view_product',[AdminController::class,'view_product'])->middleware(['auth','admin'])->name('view.product');

//delete product
Route::get('/admin/delete_product/{id}',[AdminController::class,'delete_product'])->middleware(['auth','admin'])->name('delete.product');

//edit product
Route::get('/admin/edit_product/{slug}',[AdminController::class,'edit_product'])->middleware(['auth','admin'])->name('edit.product');

//update product
Route::post('/admin/update_product/{id}',[AdminController::class,'update_product'])->middleware(['auth','admin'])->name('update.product');

//product search
Route::get('/admin/search_product',[AdminController::class,'search_product'])->middleware(['auth','admin'])->name('search.product');

//client message:
Route::get('/admin/client_message',[AdminController::class,'client_message'])->middleware(['auth','admin'])->name('client.message');
//delete message
Route::get('/admin/delete_message/{id}',[AdminController::class,'delete_message'])->middleware(['auth','admin'])->name('delete.message');



//Client Side Routing----------------

Route::get('/product_details/{id}',[HomeController::class,'product_details'])->name('product.details');

Route::get('/add_cart/{id}',[HomeController::class,'add_cart'])->middleware(['auth', 'verified'])->name('add.cart');

Route::get('/remove_cart/{id}',[HomeController::class,'remove_cart'])->middleware(['auth', 'verified'])->name('remove.cart');

Route::get('/mycart',[HomeController::class,'mycart'])->middleware(['auth', 'verified'])->name('mycart');

Route::post('/confirm_order',[HomeController::class,'confirm_order'])->middleware(['auth', 'verified'])->name('confirm.order');

Route::get('/shop',[HomeController::class,'shop'])->name('shop');
Route::get('/why',[HomeController::class,'why'])->name('why');
Route::get('/testimonial',[HomeController::class,'testimonial'])->name('testimonial');
Route::get('/contact',[HomeController::class,'contact'])->name('contact');

Route::get('/search',[HomeController::class,'product_search'])->name('product.search');

Route::get('/view_all_products',[HomeController::class,'view_all_products'])->name('all.products');

//client message
Route::post('/user_message',[HomeController::class,'user_message'])->middleware(['auth', 'verified'])->name('user.message');



//View Order List in Admin Panel
Route::get('/admin/view_order',[AdminController::class,'view_order'])->middleware(['auth', 'admin'])->name('view.order');

Route::get('on_the_way/{id}',[AdminController::class,'on_the_way'])->middleware(['auth', 'admin']);

Route::get('delivered/{id}',[AdminController::class,'delivered'])->middleware(['auth', 'admin']);

Route::get('/admin/print_pdf/{id}',[AdminController::class,'print_pdf'])->middleware(['auth', 'admin'])->name('print.pdf');


//User Own Order:
Route::get('/my_order',[HomeController::class,'my_order'])->middleware(['auth', 'verified'])->name('myorder');


//payment method Route
Route::controller(HomeController::class)->group(function(){
    Route::get('stripe/{value}', 'stripe');
    Route::post('stripe/{value}', 'stripePost')->name('stripe.post');
});
