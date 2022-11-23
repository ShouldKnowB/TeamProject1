<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutusController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\ShopController;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/about_us', [App\Http\Controllers\AboutusController::class, 'index'])->name('about_us');
Route::get('/shop', [App\Http\Controllers\ShopController::class, 'index'])->name('shop');
Route::get('/contact_us', [App\Http\Controllers\ContactusController::class, 'index'])->name('contact_us');
Route::post('/contact_us', [App\Http\Controllers\ContactusController::class, 'store'])->name('contact_us');
Route::get('/product_page', [App\Http\Controllers\ProductPageController::class, 'index'])->name('product_page');
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');

Route::get('/faqs', [App\Http\Controllers\FAQsController::class, 'index'])->name('faqs');
Route::get('/terms_and_conditions', [App\Http\Controllers\TermsandconditionsController::class, 'index'])->name('terms_and_conditions');
Route::get('/privacy_policy', [App\Http\Controllers\PrivacypolicyController::class, 'index'])->name('privacy_policy');
Route::get('/refund_policy', [App\Http\Controllers\RefundpolicyController::class, 'index'])->name('refund_policy');
Route::get('/terms_of_use', [App\Http\Controllers\TermsofuseController::class, 'index'])->name('terms_of_use');

/*Admin Dashboard Routes*/
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function() {
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
     //Product Routes
    Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function () {
       Route::get('/products', 'index');
       Route::get('/products/create', 'create');
       Route::post('/products', 'store');
       Route::get('/products/{product}/edit', 'edit');
       Route::put('/products/{product}', 'update');
       Route::get('product-image/{product_image_id}/delete','destroyImage');
       Route::get('products/{product_id}/delete','destroy');

    });
    Route::controller(App\Http\Controllers\Admin\FlavoursController::class)->group(function () {
        Route::get('/flavours', 'index');
        Route::get('/flavours/create', 'create');
        Route::post('/flavours/create', 'store');
        Route::get('/flavours/{flavours}/edit','edit');
        Route::put('/flavours/{flavours_id}','update');
        Route::get('/flavours/{flavours_id}/delete','destroy');
    });
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/{category}/edit', 'edit');
        Route::put('/category/{category}', 'update');

     });
    });


     //Customer Routes
     Route::controller(App\Http\Controllers\Admin\UserController::class)->group(function () {
        Route::get('/customer', 'index');

     });










