<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;

class VendorController extends Controller
{
    public function welcome($vendor_slug){
        dd($vendor_slug);

        return view('seller.test');
    }
    public function index($vendor_slug){
        dd('index');

        return view('seller.test');
    }


    public function showMenu($vendor_slug)
    {
        dd('showMenu');
       /* $vendor = Restaurant::where('slug', $vendor_slug)->firstOrFail();

        // جلب قائمة الطعام الخاصة بالبائع
        $foodItems = FoodItem::where('restaurant_id', $vendor->id)->get();

        return view('frontend.menu', compact('vendor', 'foodItems'));*/
    }
}
