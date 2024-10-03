<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\FoodItem;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return view('customer.welcome', ['vendor'=>$this->vendor]);
    }
    public function index($vendor_slug){
       /*
        $foodItems = FoodItem::select('food_items.id', 'food_items.subcategory_id', 'food_items.restaurant_id',
            'food_items.name', 'food_items.description', 'food_items.price', 'food_items.image',
            DB::raw('COALESCE(AVG(order_ratings_and_comments.rating), 0) as average_rating'))
            ->leftJoin('order_ratings_and_comments', 'food_items.id', '=', 'order_ratings_and_comments.food_item_id')
            ->groupBy('food_items.id', 'food_items.subcategory_id', 'food_items.restaurant_id', 'food_items.name', 'food_items.description', 'food_items.price', 'food_items.image') // تضمين جميع الأعمدة هنا
            ->orderByDesc('average_rating') // ترتيب تنازلي بناءً على متوسط التقييم
            ->take(2)
            ->get();*/

        return view('customer.index',['vendor'=>$this->vendor]);
    }


    public function showMenu($vendor_slug)
    {
        $foodItems = FoodItem::select('food_items.id', 'food_items.subcategory_id', 'food_items.restaurant_id',
            'food_items.name', 'food_items.description', 'food_items.price', 'food_items.image',
            DB::raw('COALESCE(AVG(order_ratings_and_comments.rating), 0) as average_rating'))
            ->leftJoin('order_ratings_and_comments', 'food_items.id', '=', 'order_ratings_and_comments.food_item_id')
            ->where('food_items.restaurant_id', $this->vendor->id) // إضافة شرط المطعم
            ->groupBy('food_items.id', 'food_items.subcategory_id', 'food_items.restaurant_id', 'food_items.name', 'food_items.description', 'food_items.price', 'food_items.image') // تضمين جميع الأعمدة هنا
            ->orderByDesc('average_rating') // ترتيب تنازلي بناءً على متوسط التقييم
            ->get();


        return view('customer.product', ['vendor'=>$this->vendor, 'foodItems'=>$foodItems,'slug'=>$vendor_slug]);
    }


    public function showFoodItem($vendor_slug, $food_item_id)

    {
        $foodItem=FoodItem::find($food_item_id);
        // dd($foodItem);
        return view('customer.product-detail', ['vendor'=>$this->vendor, 'product'=>$foodItem]);

    }


    public function showNotifications()
    {

        return view('customer.notification', ['vendor'=>$this->vendor]);
    }
}
