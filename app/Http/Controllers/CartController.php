<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Cart;
use App\Models\carts;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the cart.
     */
    public function getCart()
    {
        $carts = Cart::with('course')->where('student_id', auth()->user()->customer_id)->get();
        $countCart = Cart::countCart();

        if ($carts) {
            return ResponseFormatter::success([
                'carts' => $carts,
                'countCart' => $countCart
            ], 'Berhasil mendapatkan data keranjang');
        }

        return ResponseFormatter::error([
            'carts' => null,
            'countCart' => null
        ], 'Gagal mendapatkan data keranjang', 500);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cart = Cart::create([
            'student_id' => auth()->user()->customer_id,
            'course_id' => $request->course_id,
        ]);

        if ($cart) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menambahkan ke keranjang',
                'data' => $cart
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan ke keranjang',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $carts)
    {
        $cart = Cart::destroy($carts->id);

        return $cart ? response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus dari keranjang',
        ], 200) : response()->json([
            'success' => false,
            'message' => 'Gagal menghapus dari keranjang',
        ], 500);
    }
}
