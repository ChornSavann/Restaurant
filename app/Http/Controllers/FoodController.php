<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Foods;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Foods::with('category')->Orderby('id', 'desc')->paginate(10);
        return view('admin.Foods.index', compact('foods'));
    }


    public function create()
    {
        $categories = Category::all(); // Assuming your category model is named Category
        return view('admin.Foods.create', compact('categories'));
    }


    public function store(Request $request)
    {
        // Main validation
        $request->validate([
            'title'       => 'required|string',
            'price'       => 'required|numeric',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'desc'        => 'nullable|string',
        ]);

        // Create food item
        $foods = new Foods();
        $foods->title       = $request->title;
        $foods->price       = $request->price;
        $foods->desc        = $request->desc; // make sure column name is 'description'
        $foods->category_id = $request->category_id;
        $foods->save();

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $image     = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('foods/image'), $imageName);

            // Update image field after saving food
            $foods->image = $imageName;
            $foods->save();
        }

        return redirect()->route('food.index')->with('success', 'Food added successfully!');
    }

    public function edit($id)
    {
        $food = Foods::findOrFail($id);
        $categories = Category::all();
        return view('admin.Foods.edit', compact('food', 'categories'));
    }



    public function update(Request $request, $id)
    {
        $foods = Foods::findOrFail($id);

        $request->validate([
            'title' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'desc'  => 'nullable|string',
        ]);

        // Update basic fields
        $foods->title = $request->title;
        $foods->price = $request->price;
        $foods->desc  = $request->desc;
        $foods->category_id = $request->category_id;

        // Handle image upload if present
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($foods->image && File::exists(public_path('foods/image/' . $foods->image))) {
                File::delete(public_path('foods/image/' . $foods->image)); // fixed path
            }

            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('foods/image/'), $imagename);
            $foods->image = $imagename; // save only filename
        }

        $foods->save(); // save after setting all fields
        return redirect()->route('food.index')->with('success', 'Food updated successfully!');
    }

    public function destroy($id)
    {
        $food = Foods::findOrFail($id);

        // Delete image file if it exists
        if ($food->image && File::exists(public_path('foods/image/' . $food->image))) {
            File::delete(public_path('foods/image/' . $food->image));
        }

        // Delete the food record
        $food->delete();

        return redirect()->route('food.index')->with('success', 'Food deleted successfully!');
    }
}
