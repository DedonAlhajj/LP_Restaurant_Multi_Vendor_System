<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $cartService;
    protected $vendor;
    protected $slug;

    public function __construct(Request $request,CartService $cartService)
    {
        $this->cartService = $cartService;
        $this->slug = $request->route('vendor_slug');
        $this->vendor = Restaurant::where('slug', $this->slug)->firstOrFail();
    }

    // صفحة تأكيد الطلب
    public function confirmation(Request $request, $vendor_slug)
    {
        $cartItems = $this->cartService->getCartContent();
        if ($cartItems->isEmpty()) {
            return redirect()->route('vendor.menu', ['vendor_slug' => $vendor_slug])->with('error', 'Cart is empty.');
        }
     
        // dd(auth('customer')->check());
        // if (!auth('customer')->check()) {

            // return redirect()->route('customer.login',['vendor_slug' => $this->vendor->slug])->with('url.intended', $request->url());
            // return redirect()->route('customer.login',['vendor_slug' => $this->vendor->slug])
            // ->with(['info'=> 'Please log in to complete your order.' ]);
        // }

        return view('customer.payment', compact('cartItems', 'vendor_slug'));
    }

    // إتمام الطلب
    public function completeOrder(Request $request,$vendor_slug)
    {
        // التحقق من صحة البيانات
        $validated = $request->validate(rules: ['order_type' => 'required',]);

        // جلب عناصر السلة
        $cartItems = $this->cartService->getCartContent();

        if ($cartItems->isEmpty()) {
            return redirect()->route('vendor.menu', ['vendor_slug' => $vendor_slug])
                ->with('error', 'Cart is empty.');
        }

        // حساب إجمالي السعر بناءً على السلة
        $totalPrice = $this->cartService->calculateTotalPrice($cartItems);

        // حفظ الطلب في قاعدة البيانات
        try {
            // استخدام المعاملات
            Db::beginTransaction();
                // حفظ الطلب في قاعدة البيانات
                $order = Order::create([
                    'customer_id' => auth('customer')->id(),
                    'restaurant_id' => $this->vendor->id,
                    'order_types' => $validated['order_type'],
                    'total_price' => $totalPrice,
                    'payment_status' => 'Unpaid',
                    'payment_method' => 'cash',
                ]);

                // إضافة العناصر الخاصة بالطلب إلى جدول order_items
                foreach ($cartItems as $cartItem) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'food_item_id' => $cartItem->id,
                        'quantity' => $cartItem->quantity,
                        'price' => $cartItem->price,
                    ]);
                }

                // تفريغ السلة بعد إتمام الطلب
                
                db::commit();
                $this->cartService->clearCart();
                return view('customer.payment-confirm',['vendor_slug' => $this->vendor->slug , 'order' => $order ] );    
        } catch (\Exception $e) {
            db::rollBack();
            return redirect()->back()->with(['error'=>$e->getMessage()]);
                // ->with('error', 'An error occurred while completing the request. Please try again later.');
        }
    }


    public function history($vendor_slug)
    {
        return view('customer.payment-confirm', compact('vendor_slug'));
    }


    public function customerOrder()
    {
        return view('customer.order-list');
    }

}
