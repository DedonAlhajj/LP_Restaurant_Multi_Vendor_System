<?php

namespace App\Services;

use Cart;


class CartService
{
    protected $sessionId;

    public function __construct()
    {
<<<<<<< HEAD
        $this->sessionId = auth('customer')->check() ? auth('customer')->id() : session()->getId();
=======
        //$this->sessionId = auth('customer')->check() ? auth('customer')->id() : session()->getId();

>>>>>>> 0363600121bbff7310626e5fbb3ddbba2b3eb8a1
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
<<<<<<< HEAD
        \Cart::session($this->sessionId)->add([
=======

        \Cart::add([
>>>>>>> 0363600121bbff7310626e5fbb3ddbba2b3eb8a1
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
