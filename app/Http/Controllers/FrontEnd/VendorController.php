<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;

class VendorController extends Controller
{
    public function showMenu($vendor_slug)
    {
        $vendor = Restaurant::where('slug', $vendor_slug)->firstOrFail();

        // جلب قائمة الطعام الخاصة بالبائع
        $foodItems = FoodItem::where('restaurant_id', $vendor->id)->get();

        return view('frontend.menu', compact('vendor', 'foodItems'));
    }
}
