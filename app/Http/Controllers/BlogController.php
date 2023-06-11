<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

    public function adminBlog()
    {
        $blogs = Blog::with('user.customer')->where('user_id', Auth::user()->id)->orderBy("created_at", "desc")->get();
        $data = [
            'title' => 'Blog | Admin UMKMPlus',
            'active' => 'blog',
            'blogs' => $blogs
        ];
        return view('admin.blog.index', $data);
    }

    public function adminBlogShow(Blog $blog)
    {
        $statuses = ['tampilkan', 'sembunyikan'];
        $data = [
            'title' => 'Blog ' . $blog->title . '  | Admin UMKMPlus',
            'active' => 'blog',
            'blog' => $blog,
            'statuses' => $statuses
        ];
        return view('admin.blog.show', $data);
    }

    public function adminBlogCreate()
    {
        $status = ['tampilkan', 'sembunyikan'];
        $data = [
            'title' => 'Tambah Blog | Admin UMKMPlus',
            'active' => 'blog',
            'statuses' => $status
        ];
        return view('admin.blog.create', $data);
    }

    public function mentorBlog()
    {
        $user = Auth::user()->id;
        $blogs = Blog::with('user.customer:id,name')->where('user_id', $user)->orderBy("created_at", "desc")->get();
        $data = [
            'title' => 'Blog | Mentor UMKMPlus',
            'active' => 'blog',
            'blogs' => $blogs
        ];
        return view('mentor.blog.index', $data);
    }

    public function mentorBlogShow(Blog $blog)
    {
        $statuses = ['tampilkan', 'sembunyikan'];
        $data = [
            'title' => 'Blog ' . $blog->title . '  | Mentor UMKMPlus',
            'active' => 'blog',
            'blog' => $blog,
            'statuses' => $statuses
        ];
        return view('mentor.blog.show', $data);
    }

    public function mentorBlogCreate()
    {
        $status = ['tampilkan', 'sembunyikan'];
        $data = [
            'title' => 'Tambah Blog | Mentor UMKMPlus',
            'active' => 'blog',
            'statuses' => $status
        ];
        return view('mentor.blog.create', $data);
    }

    public function blogStore(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'headline' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|string|in:tampilkan,sembunyikan',
            'thumbnail' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $request->ajax() ? ResponseFormatter::error(
                [
                    'error' => $validator->errors()->first(),
                ],
                'Gagal menambahkan blog',
                400
            ) : back()->with('error', $validator->errors()->first());
        }

        $thumbnail = $request->file('thumbnail');
        $thumbnailUrl = $thumbnail->store('blogs', 'public');

        $user = Auth::user();

        $createBlog = Blog::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'headline' => $request->headline,
            'content' => $request->content,
            'thumbnail' => $thumbnailUrl,
            'status' => $request->status
        ]);

        if ($createBlog) {
            // check if admin or mentor
            if ($user->roles()->first()->pivot->role_id == 1) {
                return redirect()->route('admin.blog')->with('success', 'Blog berhasil ditambahkan');
            } else if ($user->roles()->first()->pivot->role_id == 2) {
                return redirect()->route('mentor.blog')->with('success', 'Blog berhasil ditambahkan');
            }
        } else {
            return $request->ajax() ? ResponseFormatter::error(
                null,
                'Blog gagal ditambahkan',
                500
            ) : back()->with('error', 'Blog gagal ditambahkan');
        }
    }

    public function blogUpdate(Request $request, Blog $blog)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'headline' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|string|in:tampilkan,sembunyikan',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $request->ajax() ? ResponseFormatter::error(
                [
                    'error' => $validator->errors()->first(),
                ],
                'Gagal memperbarui blog',
                400
            ) : back()->with('error', $validator->errors()->first());
        }

        if ($request->hasfile('thumbnail')) {
            $rules = [
                'thumbnail' => 'image|mimes:jpg,png,jpeg|max:2048',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $request->ajax() ? ResponseFormatter::error(
                    [
                        'error' => $validator->errors()->first(),
                    ],
                    'Gagal memperbarui blog',
                    400
                ) : back()->with('error', $validator->errors()->first());
            }
            if ($blog->thumbnail != 'storage/blogs/blog-1.png') {
                // Delete file thumbnail before
                $exists = Storage::disk('public')->exists('blogs/' . $blog->thumbnail);
                if ($exists) {
                    Storage::disk('public')->delete('blogs/' . $blog->thumbnail);
                }
            }

            $thumbnail = $request->file('thumbnail');
            $thumbnailUrl = $thumbnail->store('blogs', 'public');

            $updateBlog = $blog->update([
                'thumbnail' => $thumbnailUrl
            ]);
        }

        $updateBlog = $blog->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'headline' => $request->headline,
            'content' => $request->content,
            'status' => $request->status
        ]);

        if ($updateBlog) {
            return $request->ajax() ? ResponseFormatter::success(
                [
                    'redirect' => route('admin.blog'),
                ],
                'Blog berhasil diperbarui'
            ) : redirect()->route('admin.blog')->with('success', 'Blog berhasil diperbarui');
        } else {
            return $request->ajax() ? ResponseFormatter::error(
                null,
                'Blog gagal diperbarui',
                500
            ) : back()->with('error', 'Blog gagal diperbarui');
        }
    }

    public function blogDestroy(Blog $blog)
    {
        $delete = $blog->delete();

        if ($delete) {
            return ResponseFormatter::success(
                null,
                'Blog berhasil dihapus'
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Blog gagal dihapus',
                500
            );
        }
    }

    public function blogUpdateStatus(Blog $blog)
    {
        $rules = [
            'status' => 'required|string|in:tampilkan,sembunyikan',
        ];
        $validator = Validator::make(request()->all(), $rules);

        if ($validator->fails()) {
            return ResponseFormatter::error(
                [
                    'error' => $validator->errors()->first(),
                ],
                'Gagal memperbarui status blog',
                400
            );
        }

        $updateStatus = $blog->update([
            'status' => request()->status
        ]);

        if ($updateStatus) {
            return ResponseFormatter::success(
                null,
                'Status blog berhasil diperbarui'
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Status blog gagal diperbarui',
                500
            );
        }
    }
}
