<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Profilecontroller extends Controller
{
     // Profile
     public function profile()
     {
         $user = Auth::user();
         return view('users.profile', compact('user'));
     }

     public function editProfile()
     {
         $user = Auth::user();
         return view('admin.user.edit', compact('user'));
     }

     public function updateProfile(Request $request)
     {
         $user = Auth::user();


         $validated = $request->validate([
             'name'         => 'required|string|max:255',
             'email'        => 'required|email|unique:users,email,' . $user->id,
             'password'     => 'nullable|min:6|same:com_password',
             'com_password' => 'nullable|min:6|same:password',
             'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
         ]);

         // 2. Update name and email
         $user->name = $validated['name'];
         $user->email = $validated['email'];

         // 3. Update password if provided
         if ($request->filled('password')) {
             $user->password = Hash::make($validated['password']);
         }

         // 4. Handle image upload
         if ($request->hasFile('image'))
         {
             $image = $request->file('image');
             $imagename = time() . '.' . $image->getClientOriginalExtension();
             $path = public_path('images/users');

             // Ensure folder exists
             if (!file_exists($path))
             {
                 mkdir($path, 0755, true);
             }

             // Check folder permissions
             if (!is_writable($path))
             {
                 return back()->with('error', 'Upload folder is not writable: ' . $path);
             }

             // Delete old image if exists
             if ($user->image && File::exists($path . '/' . $user->image)) {
                 File::delete($path . '/' . $user->image);
             }

             // Move new image
             $image->move($path, $imagename);
             $user->image = $imagename;
         }

         // 5. Save user with try-catch for debugging
         try
         {
             $user->save();
         } catch (\Exception $e) {
             return back()->with('error', 'Failed to save profile: ' . $e->getMessage());
         }

         return redirect()->route('user.index')->with('success', 'Profile updated successfully.');
     }



     public function myprofile()
     {
         $user = Auth::user();
         return view('users.profile.myprofile',compact('user'));
     }

      // Update profile info

      public function updatemyProfile(Request $request)
      {
          $user = Auth::user();

          // Validate the form input
          $validated = $request->validate([
              'name'  => 'required|string|max:255',
              'email' => 'required|email|unique:users,email,' . $user->id,
              'phone' => 'nullable|string|max:20',
              'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
          ]);

          // Update basic fields
          $user->name = $validated['name'];
          $user->email = $validated['email'];
          $user->phone = $validated['phone'] ?? null;

          // Handle image upload
          if ($request->hasFile('image')) {
              $image = $request->file('image');
              $imagename = time() . '.' . $image->getClientOriginalExtension();
              $path = public_path('images/users');

              // Create folder if it doesn't exist
              if (!file_exists($path)) {
                  mkdir($path, 0755, true);
              }

              // Delete old image if exists
              if ($user->image && File::exists($path . '/' . $user->image)) {
                  File::delete($path . '/' . $user->image);
              }

              // Move new image
              $image->move($path, $imagename);
              $user->image = $imagename;
          }

          // Save updated user
          $user->save();

          return redirect()->route('user.myprofile')->with('success', 'Profile updated successfully.');
      }


      // Update password
      public function updatePassword(Request $request)
      {
          $user = Auth::user();

          $validated = $request->validate([
              'password' => 'required|string|min:6|confirmed',
          ]);

          $user->password = Hash::make($validated['password']);
          $user->save();

          return redirect()->route('user.myprofile')->with('success', 'Password updated successfully.');
      }
}
