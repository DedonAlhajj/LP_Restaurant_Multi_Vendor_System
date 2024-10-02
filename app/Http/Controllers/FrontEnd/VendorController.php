<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\FoodItem;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class VendorController extends Controller
{   


    protected $slug;
    protected $vendor;

    public function __construct(Request $request)
    {
        /* اخترت انى اعمل constructor لانى بستخدمvendor فى عمل اى عملية بالتالى بستدعية مرة واحدة */
        $this->slug = $request->route('vendor_slug');
        $this->vendor = Restaurant::where('slug', $this->slug)->firstOrFail();
    }

    public function welcome(){
        // dd($vendor_slug);

        return view('customer.welcome', ['restaurant'=>$this->vendor]);
    }
    public function index($vendor_slug){
        // dd('index');

        return view('customer.index',['restaurant'=>$this->vendor]);
    }


    public function showMenu()
    {
        // dd('showMenu');


        // dd($vendor);
        // جلب قائمة الطعام الخاصة بالبائع
        $foodItems = FoodItem::where('restaurant_id', $this->vendor->id)->get();
        // dd($foodItems);


        return view('customer.product', ['vendor'=>$this->vendor, 'foodItems'=>$foodItems]);
    }


    public function showFoodItem( $food_item_id)

    {
        $foodItem=FoodItem::find($food_item_id);
        return view('customer.product-detail', ['vendor'=>$this->vendor, 'foodItem']);

    }
}
