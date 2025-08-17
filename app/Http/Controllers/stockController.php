<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Foods;
use App\Models\Stocks;
use Illuminate\Http\Request;
use Carbon\Carbon;

class stockController extends Controller
{
    public function index()
    {
        $stocks = Stocks::with('food')->orderBy('id','desc')->paginate(6);
        return view('admin.stocks.index', compact('stocks'));
    }

    public function create()
    {
        $today = Carbon::today();
        // អោយបាន array នៃ food_id ដែលមាន stock ថ្ងៃនេះ
        $foodInStockToday = Stocks::whereDate('created_at', $today)->pluck('food_id')->toArray();
        // បង្ហាញតែ foods ដែលមិនមាន stock ថ្ងៃនេះ
        $foods = Foods::whereNotIn('id', $foodInStockToday)->get();
        return view('admin.stocks.create', compact('foods'));
    }

    public function store(Request $request)
    {
        $food = Foods::findOrFail($request->food_id);
        $request->validate([
            'food_id'     => 'required|exists:food,id',
            'quantity'    => 'required|numeric|min:0',
            'unit'        => 'required|string',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $stock = new Stocks();

        $stock->food_id     = $request->food_id; // store the foreign key
        $stock->food_name = Foods::find($request->food_id)->title; // get name from foods table
        $stock->quantity    = $request->quantity;
        $stock->unit        = $request->unit;
        $stock->description = $request->description;
        $stock->price       = $food->price; // យក price ពី Food
        $stock->save();

        return redirect()->route('stocks.index')->with('success', 'Stock added successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $stock = Stocks::findOrFail($id); // Get stock by ID
        $foods = Foods::all(); // Get all foods for select dropdown
        return view('admin.stocks.edit', compact('stock', 'foods'));
    }

    // Handle update
    public function update(Request $request, $id)
    {
        $stock = Stocks::findOrFail($id);

        $request->validate([
            'food_id'     => 'required|exists:food,id',
            'quantity'    => 'required|numeric|min:0',
            'unit'        => 'nullable|string|max:50',
            'description' => 'nullable|string',

        ]);

        // Update stock data
        $stock->food_id     = $request->food_id;
        $stock->quantity    = $request->quantity;
        $stock->unit        = $request->unit;
        $stock->description = $request->description;

        // Optionally, if you want to allow uploading a custom stock image:
        if ($request->hasFile('image')) {
            $image      = $request->file('image');
            $imageName  = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('foods/image'), $imageName);
            $stock->image = $imageName;
        }

        $stock->save();

        return redirect()->route('stocks.index')->with('success', 'Stock updated successfully.');
    }

    public function delete($id)
    {
        // Find the stock by ID
        $stock = Stocks::find($id);

        if (!$stock) {
            return redirect()->route('stocks.index')->with('error', 'Stock not found.');
        }

        if ($stock->image && file_exists(public_path('foods/image/' . $stock->image))) {
            unlink(public_path('foods/image/' . $stock->image));
        }

        // Delete the stock
        $stock->delete();
        return redirect()->route('stocks.index')->with('success', 'Stock deleted successfully.');
    }



}
