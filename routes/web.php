<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ManageUserAccController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Models\Product;

//Login Register Logout
Route::redirect('/', 'loginPage')->name('auth#/')->middleware('admin_auth');
//Laravel-9 Controller group
Route::controller(AuthController::class)
->group(function(){
    Route::get('loginPage','loginPage')->name('auth#loginPage')->middleware('admin_auth');
    Route::get('registerPage','registerPage')->name('auth#registerPage')->middleware(['admin_auth']);
    Route::get('log_out','log_out')->name('auth#logoutPage');
});
//Jetstream middleware
Route::middleware(['auth:sanctum','verified'])
->group(function(){
    // Dashboard to check admin and user
    Route::get('dashboard',[AuthController::class, 'dashboard'])->name('dashboard');

    // Admin Panel
    Route::middleware('admin_auth')->group(function(){
        Route::controller(AdminController::class)
        ->prefix('admin')
        ->group(function(){
            // password change
            Route::get('changePasswordPage','changePasswordPage')->name('admin#changePasswordPage');
            Route::post('changePassword/{id}','changePassword')->name('admin#changePassword');
            // account info
            Route::get('accountInfo','accountInfoPage')->name('admin#accountInfoPage');
            Route::get('acountInfo/edit/{id}','accountInfoEdit')->name('admin#accountInfoEdit');
            Route::post('accountInfo/update/{id}','accountInfoUpdated')->name('admin#accountInfoUpdate');
            // acc role
            Route::get('list','adminList')->name('admin#list');
            Route::get('delete/{id}','deleteAcc')->name('admin#delete');
            Route::get('edit/{id}','editAccRole')->name('admin#editRole');
            Route::post('update/{id}','updateAccRole')->name('admin#updateRole');
            Route::get('change/role','adminToUser')->name('admin#ajaxAdminToUser');
        });
        // User list
        Route::controller(ManageUserAccController::class)
        ->prefix('admin')
        ->group(function(){
            Route::get('user/list','userList')->name('admin#userList');
            Route::get('user/edit/{id}','userEdit')->name('admin#userEdit');
        });
        // Category
        Route::controller(CategoryController::class)
        ->prefix('category')
        ->group(function(){
            Route::get('list','list')->name('category#list');
            Route::get('create/page','createPage')->name('category#createPage');
            Route::post('create','create')->name('category#create');
            Route::get('show/{id}','show')->name('category#show');
            Route::get('edit/{id}','edit')->name('category#edit');
            Route::post('update/{id}','update')->name('category#update');
            Route::get('delete/{id}','delete')->name('category#delete');
        });
        // Product
        Route::controller(ProductController::class)
        ->prefix('product')
        ->group(function(){
            Route::get('list','list')->name('product#list');
            Route::get('create/page','createPage')->name('product#createPage');
            Route::post('create','create')->name('product#create');
            Route::get('show/{id}','show')->name('product#show');
            Route::get('edit/{id}','edit')->name('product#edit');
            Route::post('update/{id}','update')->name('product#update');
            Route::get('delete/{id}','delete')->name('product#delete');
        });
        // Order
        Route::controller(OrderController::class)
        ->prefix('order')
        ->group(function(){
            Route::get('list','orderList')->name('order#list');
            Route::get('orderInfo/{orderCode}','orderInfo')->name('admin#orderInfo');
            Route::get('status','updateStatus')->name('ajax#updateStatus');
        });
        // Contact
        Route::controller(ContactController::class)
        ->prefix('contact')
        ->group(function(){
            Route::get('list','contactList')->name('admin#contactList');
            Route::get('delete/{id}','delete')->name('admin#contactDelete');
        });
        // Reviews
        Route::controller(ReviewController::class)
        ->prefix('review')
        ->group(function(){
            Route::get('list','reviewList')->name('admin#reviewList');
            Route::get('delete/{id}','deleteReview')->name('admin#reviewDelete');
        });
    });

    // User Panel
    Route::middleware('user_auth')->group(function(){
        Route::controller(UserController::class)
        ->prefix('user')
        ->group(function(){
            // main page
            Route::get('home','home')->name('user#home');
            Route::get('home/filter/{id}','filter')->name('user#filter');
            Route::get('home/sorting','sorting')->name('user#sorting');
            // detail products
            Route::get('product/detail/{id}','productDetail')->name('user#productDetail');
            // Review section
            Route::post('review/send','userReview')->name('user#reviewSend');
            // shopping cart
            Route::get('cart','cartPage')->name('user#shoppingCartPage');
            // order history
            Route::get('order/history','orderHistory')->name('user#orderHistory');
            // contact page
            Route::get('contact/page','contactPage')->name('user#contactPage');
            Route::post('contact/message','message')->name('user#message');
            // account change password
            Route::get('changePasswordPage','changePasswordPage')->name('user#changePasswordPage');
            Route::post('changePassword/{id}','changePassword')->name('user#changePassword');
            // account info
            Route::get('accountInfo','accountInfoPage')->name('user#accountInfoPage');
            Route::get('accountInfoEdit/{id}','accountInfoEdit')->name('user#accountInfoEdit');
            Route::post('accountInfoUpdate/{id}','accountInfoUpdate')->name('user#accountInfoUpdate');
        });

        // for Ajax
        Route::controller(AjaxController::class)
        ->prefix('ajax')
        ->group(function(){
            Route::get('addToCart','addToCart')->name('ajax#addToCart');//add cart to detail page
            Route::get('order/process','orderProcess')->name('ajax#order');//add to order from cart
            Route::get('clearCart','clearCart')->name('ajax#clearCart');//remove all item from cart
            Route::get('qtyChange','qtyChange')->name('ajax#qtyChange');//cart each item qty change
            Route::get('remove','remove')->name('ajax#remove');//cart each row cancel
            Route::get('viewCount','viewCount')->name('ajax#viewCount');//view count ajax
            Route::get('sort/price','sortPrice')->name('ajax#sortPrice');//home page sorting with price
        });
    });

});


