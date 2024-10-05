<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{
    public function loginForm() {
        return view('customer.auth.login');
    }

    public function login(Request $request) {
        // تعديل بيانات الاعتماد لتكون متوافقة مع الجدول
        $credentials = $request->only('phone', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect()->intended(route('order.confirmation'));
        }

        return back()->withErrors(['phone' => 'Invalid credentials']);
    }

    public function registerForm() {
        return view('customer.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:customers',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'phone' => $request->phone, // استخدام رقم الهاتف بدلاً من البريد الإلكتروني
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('customer')->login($customer);

        return redirect()->route('order.confirmation');
    }
}

