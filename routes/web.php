<?php

use App\Http\Controllers\Categorycontroller;
use App\Http\Controllers\ChefController;
use App\Http\Controllers\DashboardControler;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\Homecontroller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Profilecontroller;
use App\Http\Controllers\Reportcontroller;
use App\Http\Controllers\Reservationcontroller;
use App\Http\Controllers\stockController;
use App\Http\Controllers\Usercontroller;
use Illuminate\Support\Facades\Route;

use App\Models\Chef;

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



//usercontroller
// Route::get('/home',[Usercontroller::class,'home'])->name('master.home');
Route::get('/', [UserController::class, 'login'])->name('user.login');
Route::get('/sigup', [Usercontroller::class, 'signup'])->name('user.signup');
Route::post('/signup/login', [Usercontroller::class, 'logincheck'])->name('user.logincheck');
Route::post('/signup', [Usercontroller::class, 'registercheck'])->name('user.registercheck');

Route::get('/dashboard', [Usercontroller::class, 'godashboard'])->name('dashboard');
Route::get('/logout', [Usercontroller::class, 'logout'])->name('logout');
// Route::post('/logout', [Usercontroller::class, 'logout'])->name('logout');



//Ordre
Route::get('/orders/index', [OrderController::class, 'index'])->name('orders.index');
Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');
Route::post('/orders/store/home', [OrderController::class, 'storeHome'])->name('orders.storeHome');
Route::patch('/admin/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

// Optional: view single order details (if needed separate from modal)
Route::get('/admin/orders/', [OrderController::class, 'show'])->name('orders.show');
Route::get('/invoice/orders/{id}/print', [OrderController::class, 'print'])->name('orders.print');


//dashboard
Route::get('/orders-today', [DashboardControler::class, 'todayOrders'])->name('orders.today');
Route::get('/sales-data', [DashboardControler::class, 'salesData'])->name('sales.data');
//reservation
Route::post('/register', [Reservationcontroller::class, 'store'])->name('register.store');
Route::get('/reversation', [Reservationcontroller::class, 'index'])->name('reservation.index');

//Discount
Route::post('/Discount-stock',[OrderController::class,'storediscount'])->name('discount.storediscount');




// Admin Dashboard
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardControler::class, 'index'])->name('admin.dashboard');
    //Dashboard
    Route::get('/dashboard', [DashboardControler::class, 'index'])->name('dashboard.index');
    Route::get('/admin/reports/sale',[DashboardControler::class, 'salesReport'])
    ->name('admin.reports.monthly');


    //user
    Route::get('/user/index', [Usercontroller::class, 'index'])->name('user.index');
    Route::get('/user/create', [Usercontroller::class, 'create'])->name('user.create');
    Route::get('/user/edit/{id}', [Usercontroller::class, 'edit'])->name('user.edit');
    Route::post('/user/create', [Usercontroller::class, 'store'])->name('user.store');
    Route::post('/user/update{id}', [Usercontroller::class, 'update'])->name('user.update');
    Route::delete('/user/delete{id}', [Usercontroller::class, 'destroy'])->name('user.delete');

    //profile

    Route::get('/profile', [Profilecontroller::class, 'profile'])->name('user.profile');
    Route::get('/profile/edit', [Profilecontroller::class, 'editProfile'])->name('user.profile.edit');
    Route::put('/profile/update', [Profilecontroller::class, 'updateProfile'])->name('user.profile.update');

    Route::get('/myprofile', [Profilecontroller::class, 'myprofile'])->name('user.myprofile');
    Route::put('/myprofile/update', [Profilecontroller::class, 'updatemyProfile'])->name('user.updateProfile');
    Route::put('/profile/password', [Profilecontroller::class, 'updatePassword'])->name('user.updatePassword');

    //stock
    Route::get('/stock', [stockController::class, 'index'])->name('stocks.index');
    Route::get('/stock/create', [stockController::class, 'create'])->name('stocks.create');
    Route::post('/stock/store', [stockController::class, 'store'])->name('stocks.store');
    Route::get('/stocks/{id}/edit', [StockController::class, 'edit'])->name('stocks.edit');
    Route::put('/stocks/{id}', [StockController::class, 'update'])->name('stocks.update');
    Route::delete('/stocks/{id}/delete', [StockController::class, 'delete'])->name('stocks.delete');

    //category
    Route::get('/category/index', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [Categorycontroller::class, 'create'])->name('category.create');
    Route::post('/category/store', [Categorycontroller::class, 'store'])->name('category.store');
    Route::get('/category/edit/{id}', [Categorycontroller::class, 'edit'])->name('category.edit');
    Route::post('/category/update/{id}', [Categorycontroller::class, 'update'])->name('category.update');
    Route::delete('/category/Delete/{id}', [Categorycontroller::class, 'destroy'])->name('category.delete');
    //foods
    Route::get('/food', [FoodController::class, 'index'])->name('food.index');
    Route::get('/list-food', [FoodController::class, 'list'])->name('food.list');
    Route::get('/food/create', [FoodController::class, 'create'])->name('food.create');
    Route::post('/food/store', [FoodController::class, 'store'])->name('food.store');
    Route::get('/food/edit{id}', [FoodController::class, 'edit'])->name('food.edit');
    Route::post('/food/update{id}', [FoodController::class, 'update'])->name('food.update');
    Route::delete('/food/delete{id}', [FoodController::class, 'destroy'])->name('food.delete');
    //discoun stocks
    Route::get('/stocks/discount', [DiscountController::class, 'index'])->name('discount.index');
    Route::post('/discount/store/{food}', [DiscountController::class, 'store'])->name('discount.store');
    // Show the edit form
    Route::get('/admin/discounts/{id}/edit', [DiscountController::class, 'edit'])->name('discount.edit');
    // Update the discount
    Route::put('/admin/discounts/{id}', [DiscountController::class, 'update'])->name('discount.update');
    Route::delete('/discount/{id}', [DiscountController::class, 'destroy'])->name('discount.destroy');



    //chefs
    Route::get('/chefs', [ChefController::class, 'index'])->name('chefs.index');
    Route::get('/create', [ChefController::class, 'create'])->name('chefs.create');
    Route::post('/store', [ChefController::class, 'store'])->name('chefs.store');
    Route::get('/edit/{id}', [ChefController::class, 'edit'])->name('chefs.edit');
    Route::post('/update/{id}', [ChefController::class, 'update'])->name('chefs.update');
    Route::delete('/delete/{id}', [ChefController::class, 'destroy'])->name('chefs.delete');

    //item
    Route::get('/orders/items', [OrderController::class, 'item'])->name('orders.items');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/menu', [OrderController::class, 'showMenu'])->name('menu');
    Route::get('/showitem', [OrderController::class, 'show'])->name('orders.show');

    //Order
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');

    //report
    Route::get('/report/sales', [Reportcontroller::class, 'salesReport'])->name('sale.report');
    Route::get('/report/food', [Reportcontroller::class, 'foods'])->name('report.food');
    Route::get('/report/customer', [Reportcontroller::class, 'customer'])->name('report.customer');
    Route::get('/report/stock', [Reportcontroller::class, 'stock'])->name('report.stock');



    //Delivery
    Route::get('/delivery', [DeliveryController::class, 'index'])->name('delivery.index');
    Route::get('/delivery/create', [DeliveryController::class, 'create'])->name('delivery.create');

    Route::get('/customer/{customer}/orders', [DeliveryController::class, 'getCustomerOrders']);

    Route::post('/delivery/tore', [DeliveryController::class, 'store'])->name('delivery.store');
    Route::get('/delivery/edit{id}', [DeliveryController::class, 'edit'])->name('delivery.edit');
    Route::post('/delivery/update{id}', [DeliveryController::class, 'update'])->name('delivery.update');
    Route::delete('/delivery/delete{id}', [DeliveryController::class, 'destroy'])->name('delivery.delete');
});

// User Dashboard (Home page)
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
    // Route::get('/orders/index', [OrderController::class, 'index'])->name('orders.index');
    // Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');


});
