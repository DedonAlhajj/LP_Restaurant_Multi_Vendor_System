<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout()
    {
        // جلب session id
        $sessionId = session()->getId();

        // جلب عناصر السلة
        $cartItems = Cart::where('session_id', $sessionId)->get();

        // التحقق إذا كان المستخدم مسجل دخولاً
        if (Auth::guard('customer')->check()) {
            // عرض صفحة تأكيد الطلب
            return view('order.confirmation', compact('cartItems'));
        } else {
            // إذا كان ضيفاً، عرض صفحة تسجيل الدخول أو التسجيل
            return view('auth.login_or_register', compact('cartItems'));
        }
    }
    public function completeOrder(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'order_type' => 'required|in:table,delivery', // التحقق من أن نوع الطلب صحيح
        ]);

        // جلب session id
        $sessionId = session()->getId();

        // جلب العناصر من السلة
        $cartItems = Cart::where('session_id', $sessionId)->get();

        // حساب إجمالي السعر بناءً على السلة
        $totalPrice = $cartItems->sum(function($item) {
            return $item->quantity * $item->item->price;
        });

        // حفظ الطلب في قاعدة البيانات
        $order = Order::create([
            'customer_id' => auth()->guard('customer')->id(),
            'restaurant_id' => 1, // هذا مجرد مثال، اجلب الـ restaurant_id من السلة أو الطلب
            'order_type' => $request->order_type,
            'status' => 'Pending', // تعيين الحالة مبدئياً كـ 'Pending'
            'total_price' => $totalPrice,
            'payment_status' => 'Unpaid', // تعيين حالة الدفع مبدئياً كـ 'Unpaid'
            'payment_method' => 'cash', // يمكنك تعديله بناءً على نموذج الطلب
        ]);

        // إضافة العناصر الخاصة بالطلب إلى جدول order_items
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id, // ربط العنصر بالطلب
                'food_item_id' => $cartItem->item->id, // ربط العنصر بالمنتج (صنف الطعام)
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->item->price, // حفظ السعر لكل عنصر
            ]);
        }

        // يمكنك الآن إزالة العناصر من السلة أو تحديث حالة السلة بناءً على متطلبات التطبيق

        return redirect()->route('order.success')->with('message', 'تم إرسال طلبك بنجاح.');
    }

}
