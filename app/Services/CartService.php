<?php

namespace App\Services;

use Cart;


class CartService
{
    protected $sessionId;

    public function __construct()
    {
        $this->sessionId = auth('customer')->check() ? auth('customer')->id() : session()->getId();

    }

    public function getCartContent()
    {
        return \Cart::session($this->sessionId)->getContent();
    }

    public function addItem($data)
    {
        if ($this->itemExists($data['id'])) {
            return false; // العنصر موجود بالفعل
        }

        \Cart::session($this->sessionId)->add([
            'id' => $data['id'],
            'name' => $data['name'],
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'attributes' => $data['attributes'] ?? [],
        ]);

        return true;
    }

    public function updateItemQuantity($id, $quantity)
    {
        \Cart::session($this->sessionId)->update($id, [
            'quantity' => [
                'relative' => false,
                'value' => $quantity
            ]
        ]);
    }

    public function removeItem($id)
    {
        \Cart::session($this->sessionId)->remove($id);
    }

    public function clearCart()
    {
        \Cart::session($this->sessionId)->clear();
    }

    protected function itemExists($id)
    {
        return \Cart::session($this->sessionId)->get($id) !== null;
    }

    public function calculateTotalPrice($cartItems)
    {
        return $cartItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });
    }

}
