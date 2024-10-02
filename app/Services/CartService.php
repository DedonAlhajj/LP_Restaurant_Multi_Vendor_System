<?php

namespace App\Services;

use Cart;


class CartService
{
    protected $sessionId='cart';

    public function __construct()
    {
        // $this->sessionId = auth('customer')->check() ? auth('customer')->id() : session()->getId();

    }

    public function getCartContent()
    {
        return \Cart::getContent();
    }

    public function addItem($data)
    {
       
        if ($this->itemExists($data['id'])) {
            return false; // العنصر موجود بالفعل
        }


       $cart= \Cart::add([
            'id' => $data['id'],
            'name' => $data['name'],
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'attributes' => $data['attributes'] ?? [],
        ]);

        dd($cart);
        return true;
    }

    public function updateItemQuantity($id, $quantity)
    {
        \Cart::update($id, [
            'quantity' => [
                'relative' => false,
                'value' => $quantity
            ]
        ]);
    }

    public function removeItem($id)
    {
        \Cart::remove($id);
    }

    public function clearCart()
    {
        \Cart::clear();
    }

    protected function itemExists($id)
    {
        return \Cart::get($id) !== null;
    }

    public function calculateTotalPrice($cartItems)
    {
        return $cartItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });
    }

}
