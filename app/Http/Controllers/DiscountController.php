<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data =
            [
                'title' => 'Tambah Diskon | UMKM Plus',
            ];

        return view('discounts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules =
        [
            'code' => 'required|unique:discounts,code',
            'discount' => 'required|numeric',
            'status' => 'required|in:true,false',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return ResponseFormatter::error([
                'error' => $validator->errors()
            ], 'Harap isi form dengan benar', 400);
        }

        $discount = Discount::create([
            'mentor_id' => auth()->user()->customer->id,
            'code' => $request->code,
            'discount' => $request->discount,
            'status' => $request->status,
        ]);

        if ($discount) {
            return ResponseFormatter::success([
                'redirect' => redirect()->route('discount.index')->getTargetUrl()
            ], 'Discount berhasil ditambahkan');
        }

        return ResponseFormatter::error([
            'error' => 'Discount gagal ditambahkan'
        ], 'Discount gagal ditambahkan', 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discount $discount)
    {
        $data =
        [
            'title' => 'Edit Diskon | UMKM Plus',
            'discount' => $discount
        ];

        return view('discounts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discount $discount)
    {
        $rules =
        [
            'code' => 'required|unique:discounts,code,' . $discount->id,
            'discount' => 'required|numeric',
            'status' => 'required|in:true,false',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return ResponseFormatter::error([
                'error' => $validator->errors()
            ], 'Harap isi form dengan benar', 400);
        }

        $discount->update([
            'code' => $request->code,
            'discount' => $request->discount,
            'status' => $request->status,
        ]);

        if ($discount) {
            return ResponseFormatter::success([
                'redirect' => redirect()->route('discount.index')->getTargetUrl()
            ], 'Discount berhasil diubah');
        }

        return ResponseFormatter::error([
            'error' => $validator->errors()
        ], 'Discount gagal diubah', 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();

        if ($discount) {
            return ResponseFormatter::success([
                'redirect' => redirect()->route('discount.index')->getTargetUrl()
            ], 'Discount berhasil dihapus');
        }

        return ResponseFormatter::error([
            'error' => "Discount gagal dihapus"
        ], 'Discount gagal dihapus', 400);
    }
}
