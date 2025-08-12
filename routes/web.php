<?php

use App\Http\Controllers\Categorycontroller;
use App\Http\Controllers\ChefController;
use App\Http\Controllers\DashboardControler;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\Homecontroller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Reservationcontroller;
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


//front
Route::get('/', [HomeController::class, 'login'])
    ->middleware('auth')
    ->name('home.index');

//usercontroller
// Route::get('/home',[Usercontroller::class,'home'])->name('master.home');
Route::get('/login', [UserController::class, 'login'])->name('user.login');
Route::get('/sigup', [Usercontroller::class, 'signup'])->name('user.signup');
Route::post('/signup/login', [Usercontroller::class, 'logincheck'])->name('user.logincheck');
Route::post('/signup', [Usercontroller::class, 'registercheck'])->name('user.registercheck');

Route::get('/dashboard', [Usercontroller::class, 'godashboard'])->name('dashboard');
Route::get('/logout', [Usercontroller::class, 'logout'])->name('logout');

 //Ordre
 Route::get('/orders/index', [OrderController::class, 'index'])->name('orders.index');
 Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
 Route::get('/orders-today', [DashboardControler::class, 'todayOrders'])->name('orders.today');

//  Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/orders/items', [OrderController::class, 'item'])->name('orders.items');

Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/menu', [OrderController::class, 'showMenu'])->name('menu');






 //reservation
 Route::post('/register', [Reservationcontroller::class, 'store'])->name('register.store');
 Route::get('/reversation', [Reservationcontroller::class, 'index'])->name('reservation.index');



// Route::get('/', [HomeController::class, 'index'])->name('home.index');

// Admin Dashboard
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardControler::class, 'index'])->name('admin.dashboard');
    //Dashboard
    Route::get('/dashboard', [DashboardControler::class, 'index'])->name('dashboard.index');

    //user
    Route::get('/user/index', [Usercontroller::class, 'index'])->name('user.index');
    Route::get('/user/create', [Usercontroller::class, 'create'])->name('user.create');
    Route::get('/user/edit/{id}', [Usercontroller::class, 'edit'])->name('user.edit');
    Route::post('/user/create', [Usercontroller::class, 'store'])->name('user.store');
    Route::post('/user/update{id}', [Usercontroller::class, 'update'])->name('user.update');
    Route::delete('/user/delete{id}', [Usercontroller::class, 'destroy'])->name('user.delete');

    //category
    Route::get('/category/index', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [Categorycontroller::class, 'create'])->name('category.create');
    Route::post('/category/store', [Categorycontroller::class, 'store'])->name('category.store');
    Route::get('/category/edit/{id}', [Categorycontroller::class, 'edit'])->name('category.edit');
    Route::post('/category/update/{id}', [Categorycontroller::class, 'update'])->name('category.update');
    Route::delete('/category/Delete/{id}', [Categorycontroller::class, 'destroy'])->name('category.delete');
    //foods
    Route::get('/food', [FoodController::class, 'index'])->name('food.index');
    Route::get('/food/create', [FoodController::class, 'create'])->name('food.create');
    Route::post('/food/store', [FoodController::class, 'store'])->name('food.store');
    Route::get('/food/edit{id}', [FoodController::class, 'edit'])->name('food.edit');
    Route::post('/food/update{id}', [FoodController::class, 'update'])->name('food.update');
    Route::delete('/food/delete{id}', [FoodController::class, 'destroy'])->name('food.delete');


    //chefs
    Route::get('/chefs', [ChefController::class, 'index'])->name('chefs.index');
    Route::get('/create', [ChefController::class, 'create'])->name('chefs.create');
    Route::post('/store', [ChefController::class, 'store'])->name('chefs.store');
    Route::get('/edit/{id}', [ChefController::class, 'edit'])->name('chefs.edit');
    Route::post('/update/{id}', [ChefController::class, 'update'])->name('chefs.update');
    Route::delete('/delete/{id}', [ChefController::class, 'destroy'])->name('chefs.delete');


});

// User Dashboard (Home page)
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');

});

//dashboaard
// Route::get('/dashboard',[DashboardControler::class,'index'])->name('dashboard.index');
