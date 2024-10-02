<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Exception;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    // عرض محتويات السلة
    public function index($vendor_slug)
    {
        try {
            $cartItems = $this->cartService->getCartContent();
            return view('customer.cart', compact('cartItems', 'vendor_slug'));
        } catch (Exception $e) {
            return redirect()->route('vendor.menu', ['vendor_slug' => $vendor_slug])
                ->with('error', 'An error occurred while loading the contents of the cart.');
        }
    }

    // إضافة عنصر إلى السلة
    public function add(Request $request, $vendor_slug)
    {
        // dd($request->all());
        $validated = $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            $added = $this->cartService->addItem($validated);
            if (!$added) {
                return redirect()->route('vendor.menu', ['vendor_slug' => $vendor_slug])
                    ->with(['error'=> 'The item is already in the cart.']);
            }

            return redirect()->route('vendor.menu', ['vendor_slug' => $vendor_slug])
                ->with(['success'=> $validated['name'] . 'It has been added successfully.']);
        } catch (Exception $e) {
            return redirect()->route('vendor.menu', ['vendor_slug' => $vendor_slug])
                ->with(['error'=> 'An error occurred while adding the item to the cart.']);
        }
    }

    // تحديث كمية عنصر في السلة
    public function update(Request $request, $vendor_slug)
    {
        $validated = $request->validate([
            'id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            $this->cartService->updateItemQuantity($validated['id'], $validated['quantity']);
            return redirect()->route('cart.index', ['vendor_slug' => $vendor_slug])
                ->with('success', 'Quantity updated successfully.');
        } catch (Exception $e) {
            return redirect()->route('cart.index', ['vendor_slug' => $vendor_slug])
                ->with('error', 'An error occurred while updating the quantity.');
        }
    }

    // إزالة عنصر من السلة
    public function remove(Request $request, $vendor_slug)
    {
        $validated = $request->validate(['id' => 'required|integer']);

        try {
            $this->cartService->removeItem($validated['id']);
            return redirect()->route('cart.index', ['vendor_slug' => $vendor_slug])
                ->with('success', 'The item was removed successfully.');
        } catch (Exception $e) {
            return redirect()->route('cart.index', ['vendor_slug' => $vendor_slug])
                ->with('error', 'An error occurred while removing the item from the cart.');
        }
    }

    // تفريغ السلة بالكامل
    public function clear($vendor_slug)
    {
        try {
            $this->cartService->clearCart();
            return redirect()->route('cart.index', ['vendor_slug' => $vendor_slug])
                ->with('success', 'The basket has been emptied.');
        } catch (Exception $e) {
            return redirect()->route('cart.index', ['vendor_slug' => $vendor_slug])
                ->with('error', 'An error occurred while emptying the basket.');
        }
    }
}

