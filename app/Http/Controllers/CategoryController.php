<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data =
            [
                'title' => 'Kategori | UMKM Plus',
                'categories' => Category::all()
            ];

        return view('categories.index', $data);
    }

    public function dashboardCategory()
    {
        $categories = Category::all();
        $data =
            [
                'title' => 'Kategori Kelas | UMKMPlus',
                'categories' => $categories
            ];

        return view('user.courses.category', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data =
            [
                'title' => 'Tambah Kategori | UMKM Plus',
            ];

        return view('categories.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules =
            [
                'name' => 'required|unique:categories,name',
                'description' => 'required'
            ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Form salah diisi
            return $request->ajax()
                ? ResponseFormatter::error(
                    [
                        'error' => $validator->errors(),
                    ],
                    'Harap isi form dengan benar',
                    400,
                )
                : back()->with(['error' => $validator->errors()]);
        }

        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => str_replace(' ', '-', $request->slug)
        ]);

        if ($category) {
            return $request->ajax() ? ResponseFormatter::success(
                [
                    'redirect' => redirect('/admin/category/index')->getTargetUrl(),
                ],
                'Berhasil menambahkan kategori',
            ) : redirect('//admin/category/index')->with('success', 'Berhasil menambahkan kategori');
        } else {
            return $request->ajax() ? ResponseFormatter::error(
                [
                    'error' => $validator->errors(),
                ],
                'Gagal menambahkan kategori',
                400,
            ) : back()->with('error', 'Gagal menambahkan kategori');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $data =
            [
                'title' => 'Kategori | UMKM Plus',
                'category' => $category
            ];

        return view('categories.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $data =
            [
                'title' => 'Edit Kategori | UMKM Plus',
                'category' => $category
            ];

        return view('categories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Category::destroy($category->id);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus');
    }
}
