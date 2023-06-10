<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Cart;
use App\Models\carts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the cart.
     */
    public function index()
    {
        $data = [
            'title' => 'Cart | UMKMPlus'
        ];

        return view('user.cart.index', $data);
    }
    public function getCart()
    {
        $carts = Cart::select('carts.id', 'courses.title', 'courses.slug', 'courses.price', 'courses.discount', 'courses.thumbnail', 'categories.name as category_name', 'customers.name as mentor_name')
            ->leftJoin('courses', 'carts.course_id', '=', 'courses.id')
            ->leftJoin('categories', 'courses.category_id', '=', 'categories.id')
            ->leftJoin('customers', 'courses.mentor_id', '=', 'customers.id')
            ->where('courses.status', 'aktif')
            ->where('student_id', auth()->user()->customer_id)
            ->get();
        $countCart = $carts->count();

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
        if (Auth::check()) {
            $cart = Cart::create([
                'student_id' => auth()->user()->customer_id,
                'course_id' => $request->course_id,
            ]);
        } else {
            return ResponseFormatter::error([
                'redirect' => redirect('/login')->getTargetUrl(),
            ], 'Gagal menambahkan ke keranjang', 500);
        }

        if ($cart) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menambahkan ke keranjang',
                'data' => $cart->id
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
    public function destroy(Cart $cart)
    {
        $cart = Cart::destroy($cart->id);

        return $cart ? ResponseFormatter::success($cart, 'Berhasil menghapus kelas dari keranjang')
            : ResponseFormatter::error(null, 'Gagal menghapus kelas dari keranjang', 500);
    }
}
