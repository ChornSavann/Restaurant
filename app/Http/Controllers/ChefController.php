<?php

namespace App\Http\Controllers;

use App\Models\Chef;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Livewire\Attributes\Validate;

class ChefController extends Controller
{
    public function index()
    {
        $chefs = Chef::all();
        return view('admin.chefs.index', compact('chefs'));
    }

    public function create()
    {
        return view('admin.chefs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'speciality' => 'required|string|max:255',
            'image'      => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $chef = new Chef();
        $chef->name = $request->name;
        $chef->speciality = $request->speciality;
        $chef->save();
        if ($request->hasFile('image')) {
            $image     = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalExtension();
            $image->move(public_path('chef/images'), $imageName);
            $chef->image = $imageName;
            $chef->save();
        }
        return redirect()->route('chefs.index')->with('success', 'Chef added successfully.');
    }

    public function edit($id)
    {
        $chef = Chef::findOrFail($id);
        return view('admin.chefs.edite', compact('chef'));
    }

    public function update(Request $request, $id)
    {
        $chef = Chef::findOrFail($id);

        $request->validate([
            'name'       => 'required|string|max:255',
            'speciality' => 'required|string|max:255',
            'image'      => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $chef->name = $request->name;
        $chef->speciality = $request->speciality;

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            $oldImagePath = public_path('chef/images/' . $chef->image);
            if (!empty($chef->image) && File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('chef/images'), $imageName);

            $chef->image = $imageName;
        }
        $chef->save();

        return redirect()->route('chefs.index')->with('success', 'Chef updated successfully.');
    }

    public function destroy($id)
    {
        $chef = Chef::findOrFail($id);
        $imagePath = public_path('chef/images/' . $chef->image);

        if (!empty($chef->image) && File::exists($imagePath)) {
            File::delete($imagePath);
        }
        $chef->delete();

        return redirect()->route('chefs.index')->with('success', 'Chef deleted successfully.');
    }
}
