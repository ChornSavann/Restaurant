<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class Categorycontroller extends Controller
{
    public function index()
    {
        $categories = Category::paginate(8);
        return view('admin.category.index', compact('categories'));
    }
    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = new Category();
        $category->name = $validated['name'];
        $category->description = $validated['description'] ?? null;
        if ($request->hasFile('image')) {
            $image     = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('category/images'), $imageName);

            // Update image field after saving food
            $category->image = $imageName;
            $category->save();
        }

        $category->save();

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->description = $request->description;

        // Handle image upload if present
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if (  $category->image && File::exists(public_path('category/images/' . $category->image))) {
                File::delete(public_path('category/images/' .   $category->image)); // fixed path
            }

            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('category/images/'), $imagename);
            $category->image = $imagename; // save only filename
        }
        $category->save();
        return redirect()->route('category.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
         // Delete image file if it exists
         if ( $category->image && File::exists(public_path('category/images/' .  $category->image)))
         {
            File::delete(public_path('category/images/' .  $category->image));
        }
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Category Delete successfully!');
    }
}
