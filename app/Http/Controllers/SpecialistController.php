<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Specialist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SpecialistController extends Controller
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
                'title' => 'Tambah Spesialis | UMKMPlus',
            ];

        return view('specialists.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules =
            [
                'name' => 'required|unique:specialists,name',
                'description' => 'required'
            ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return ResponseFormatter::error([
                'error' => $validator->errors()
            ], 'Harap isi form dengan benar', 400);
        }

        $specialist = Specialist::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($specialist) {
            return ResponseFormatter::success([
                'redirect' => redirect()->route('specialist.index')->getTargetUrl()
            ], 'Spesialis berhasil ditambahkan');
        }
        return ResponseFormatter::error([
            'error' => 'Spesialis gagal ditambahkan'
        ], 'Spesialis gagal ditambahkan', 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Specialist $specialist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specialist $specialist)
    {
        $data =
            [
                'title' => 'Edit Spesialis | UMKMPlus',
                'specialist' => $specialist
            ];

        return view('specialists.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Specialist $specialist)
    {

        $rules =
            [
                'name' => 'required|unique:specialists,name',
                'description' => 'required'
            ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return ResponseFormatter::error([
                'error' => $validator->errors()
            ], 'Harap isi form dengan benar', 400);
        }

        $specialist->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($specialist) {
            return ResponseFormatter::success([
                'redirect' => redirect()->route('specialist.index')->getTargetUrl()
            ], 'Spesialis berhasil diubah');
        }
        return ResponseFormatter::error([
            'error' => 'Spesialis gagal diubah'
        ], 'Spesialis gagal diubah', 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialist $specialist)
    {
        $specialist->delete();
        if ($specialist) {
            return ResponseFormatter::success([
                'redirect' => redirect()->route('specialist.index')->getTargetUrl()
            ], 'Spesialis berhasil dihapus');
        }

        return ResponseFormatter::error([
            'error' => 'Spesialis gagal dihapus'
        ], 'Spesialis gagal dihapus', 400);
    }
}
