<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function addToCart(Request $request)
    {
        $userId = auth()->user()->id; // or any string represents user identifier
        Cart::session($userId)->add(array(
            'id' => 456, // inique row ID
            'name' => 'Sample Item',
            'price' => 67.99,
            'quantity' => 4,
            'attributes' => array(),
           // 'associatedModel' => $Product
        ));


        return redirect()->back()->with('success', 'تم إضافة العنصر للسلة');
    }

    public function viewCart()
    {


        return view('cart.index', compact('cartItems'));
    }

}
