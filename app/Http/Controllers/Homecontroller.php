<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Chef;
use App\Models\Discount;
use Illuminate\Support\Facades\Auth;
use App\Models\Foods;
use App\Models\Reservation;
use Illuminate\Http\Request;

class Homecontroller extends Controller
{

    public function login()
    {
        return view('users.login'); // រូបរាង login.blade.php
    }

    public function index()
    {
        $discounts = Discount::with(['stock', 'food.category'])->latest()->paginate(10);
        $foods = Foods::whereHas('stocks', function ($q) {
            $q->where('quantity', '>', 0);
        })->with('stocks')->get();
        $chefs=Chef::all();
        $category=Category::all();
        $discount = Discount::with('food')->first(); // single model
        return view('master.Home', compact('foods','chefs','category','discounts','discount'));
    }


}
