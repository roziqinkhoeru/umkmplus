<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $data =
        [
            'title' => 'Blog | UMKMPlus',
        ];

        return view('user.blog.index', $data);
    }

    public function getBlog(Request $request)
    {
        $blog  = Blog::with('user.customer')
        ->where('status', 'tampilkan')
        ->when($request->search, function ($query) use ($request) {
            $query->where('title', 'LIKE', '%' . $request->search . '%');
        })
        ->get();

        $blogCount = $blog->count();

        if ($blog) {
            return ResponseFormatter::success(
                [
                   'blogs' => $blog,
                    'blogCount' => $blogCount,
                ],
                'Data blog berhasil diambil'
            );
        }

        return ResponseFormatter::error(
            null,
            'Data blog tidak ada',
            404
        );
    }

    public function show($slug)
    {
        $blog = Blog::with('user.customer')
        ->where('slug', $slug)
        ->first();

        if ($blog) {
            $data =
            [
                'title' => $blog->title . ' | UMKMPlus',
                'blog' => $blog,
            ];

            return view('user.blog.detail', $data);
        }

        return abort(404);
    }
}
