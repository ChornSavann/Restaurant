<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Chef;
use Illuminate\Support\Facades\Auth;
use App\Models\Foods;
use App\Models\Reservation;
use Illuminate\Http\Request;

class Homecontroller extends Controller
{
    // HomeController.php or FrontendController.php

    public function login()
    {
        return view('users.login'); // រូបរាង login.blade.php
    }

    public function index()
    {
        $foods = Foods::all();
        $chefs=Chef::all();
        $category=Category::all();
        return view('master.Home', compact('foods','chefs','category'));
    }


}
