<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Models\Foods;

class Usercontroller extends Controller
{

    public function login()
    {
        return view('users.login');
    }

    public function signup()
    {
        return view('users.registion');
    }

    public function home()
    {
        $foods = Foods::paginate(6);
        return view('master.home', compact('foods'));
    }


    public function logincheck(Request $request)
    {
        // $user=User::all();
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials))
        {
            $user = Auth::user();
            if ($user->usertype === 'admin')
            {
                return redirect()->route('admin.dashboard');
            }
            elseif ($user->usertype === 'user')
            {
                return redirect()->route('home.index');
            }
        }

        return back()->with('error', 'Incorrect email or password.');
    }

    public function registercheck(Request $request)
    {
        $validation = $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',

        ]);

        // Hash password
        $validation['password'] = Hash::make($validation['password']);
        $user = User::create($validation);
        Auth::login($user);

        return redirect()->route('user.login');
    }

    // public function godashboard()
    // {

    //     if (!Auth::check())
    //     {
    //         return redirect()->route('login')->with('error', 'Please login first.');
    //     }

    //     $user = Auth::user();

    //     if ($user->usertype === 'admin')
    //     {
    //         return view('admin.Dashboard.index');
    //     }
    //     elseif ($user->usertype === 'user')
    //     {
    //         return view('master.Home');
    //     }
    //     else
    //     {
    //         Auth::logout(); // optional: logout unknown roles
    //         return redirect()->route('login')->with('error', 'Access denied.');
    //     }
    // }



    public function index()
    {
        $users = User::all(); // Get all users
        return view('users.index', compact('users')); // Pass users to the view
    }


    public function create()
    {
        return view('users.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'phone'        =>'required|numeric',
            'password'     => 'required|min:6|same:com_password',
            'com_password' => 'required|min:6',
            'usertype'     => 'required|in:user,admin',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Hash the password
        $validated['password'] = Hash::make($validated['password']);

        // Create new user
        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone=$validated['phone'];
        $user->password = $validated['password'];
        $user->usertype = $validated['usertype'];

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/users'), $imagename);
            $user->image = $imagename;
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }



    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email,' . $id,
            'phone'        =>'required|numeric',
            'password'     => 'nullable|min:6|same:com_password',
            'com_password' => 'nullable|min:6',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'usertype'     => 'required|in:admin,user',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone=$validated['phone'];
        $user->usertype = $validated['usertype'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image && File::exists(public_path('images/users/' . $user->image)))
            {
                File::delete(public_path('images/users/' . $user->image));
            }

            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/users'), $imagename);
            $user->image = $imagename;  // Save only filename
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $imagePath = public_path('images/users/' . $user->image);

        if ($user->image && File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // correct method
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.login'); // redirect to login or home
    }


}
