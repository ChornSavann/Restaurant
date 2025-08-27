<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Foods;
use App\Models\Stocks;
use Illuminate\Http\Request;

class DiscountController extends Controller
{


    public function index()
    {
        $stocks = Stocks::paginate(6);
        $category = Category::all();
        $discounts = Discount::with(['stock', 'food.category'])->latest()->paginate(10);
        $foods = Foods::all();

        return view('admin.stocks.discount', compact('discounts', 'foods', 'stocks', 'category'));
    }



    public function store(Request $request, $food_id)
    {
        // Validate inputs
        $request->validate([
            'discount_percent' => 'required|numeric|min:0|max:100',
            'start_date'       => 'required|date',
            'end_date'         => 'required|date|after_or_equal:start_date',
        ]);

        // Make sure the food/stock exists
        $food = Foods::findOrFail($food_id); // will throw 404 if not found

        // Create discount
        Discount::create([
            'food_id'          => $food->id,
            'discount_percent' => $request->discount_percent,
            'start_date'       => $request->start_date,
            'end_date'         => $request->end_date,
        ]);

        return redirect()->back()->with('success', 'Discount applied successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $discount = Discount::with('food')->findOrFail($id);
        return view('admin.stocks.editDiscount', compact('discount'));
    }

    // Update the discount
    public function update(Request $request, $id)
    {
        $discount = Discount::findOrFail($id);

        // Validate input
        $request->validate([
            'discount_percent' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Update the discount
        $discount->update([
            'discount_percent' => $request->discount_percent,
            'start_date' => \Carbon\Carbon::parse($request->start_date)->format('Y-m-d'),
            'end_date' => \Carbon\Carbon::parse($request->end_date)->format('Y-m-d'),
        ]);

        return redirect()->route('discount.index')->with('success', 'Discount updated successfully!');
    }


    public function destroy($id)
    {
        $discount = Discount::findOrFail($id);
        $discount->delete();

        return redirect()->back()->with('success', 'Discount deleted successfully!');
    }
}
