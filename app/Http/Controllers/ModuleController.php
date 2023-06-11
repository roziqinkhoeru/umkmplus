<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function mentorModule(Course $course)
    {
        $data =
            [
                'title' => 'Media Modul | Mentor UMKMPlus',
                'active' => 'course',
                'course' => $course,
            ];

        return view('mentor.courses.modules.index', $data);
    }

    public function getMentorModule(Course $course)
    {
        $modules = $course->modules()->orderBy('no_module', 'asc')->get();
        if ($modules) {
            return ResponseFormatter::success(
                [
                    'modules' => $modules,
                ],
                'Berhasil mengambil modul'
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Gagal mengambil modul',
                500
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function mentorModuleCreate(Course $course)
    {
        $data =
            [
                'title' => 'Tambah Modul | Mentor UMKMPlus',
                'active' => 'course',
                'course' => $course,
            ];
        return view('mentor.courses.modules.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function mentorModuleStore(Request $request, Course $course)
    {
        $rules =
            [
                'title' => 'required|string|max:100',
                'file' => 'required|mimes:pdf|max:3072',
            ];

        $validator = validator()->make($request->all(), $rules);

        if ($validator->fails()) {
            return ResponseFormatter::error(
                [
                    'message' => 'Gagal membuat modul',
                    'error' => $validator->errors()->first(),
                ],
                'Gagal membuat modul',
                422
            );
        }

        $no_module = $course->modules->count() + 1;

        $module = Module::create(
            [
                'course_id' => $course->id,
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'file' => $request->file('file')->store('courses/modules', 'public'),
                'no_module' => $course->modules->count() + 1,
            ]
        );

        if ($module) {
            return ResponseFormatter::success(
                [
                    'redirect' => route('mentor.media.module.create', $module->slug),
                ],
                'Berhasil membuat modul'
            );
        } else {
            return ResponseFormatter::error(
                [
                    'message' => 'Gagal membuat modul',
                ],
                'Gagal membuat modul',
                500
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function mentorModuleEdit(Course $course, Module $module)
    {
        $data =
            [
                'title' => 'Edit Modul | Mentor UMKMPlus',
                'active' => 'course',
                'course' => $course,
                'module' => $module,
            ];

        return view('mentor.courses.modules.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function mentorModuleUpdate(Request $request, Course $course, Module $module)
    {
        if ($request->file) {
            $rules =
                [
                    'title' => 'required|string|max:100',
                    'file' => 'required|mimes:pdf|max:3072',
                    'no_module' => 'required|integer',
                ];
        } else {
            $rules =
                [
                    'title' => 'required|string|max:100',
                    'no_module' => 'required|integer',
                ];
        }

        $validator = validator()->make($request->all(), $rules);

        if ($validator->fails()) {
            return ResponseFormatter::error(
                [
                    'message' => 'Gagal mengubah modul',
                    'error' => $validator->errors()->first(),
                ],
                'Gagal mengubah modul',
                422
            );
        }

        if ($request->no_module != $module->no_module) {
            $dataModules = Module::where('course_id', $course->id)->orderBy('no_module', 'asc')->get();
            foreach ($dataModules as $dataModule) {
                if ($request->no_module > $module->no_module) {
                    if ($dataModule->no_module > $module->no_module && $dataModule->no_module <= $request->no_module) {
                        $dataModule->update(
                            [
                                'no_module' => $dataModule->no_module - 1,
                            ]
                        );
                    }
                } else {
                    if ($dataModule->no_module < $module->no_module && $dataModule->no_module >= $request->no_module) {
                        $dataModule->update(
                            [
                                'no_module' => $dataModule->no_module + 1,
                            ]
                        );
                    }
                }
            }
        }

        if ($request->hasFile('file')) {
            // Delete file before
            $exists = Storage::disk('public')->exists($module->file);
            if ($exists) {
                Storage::disk('public')->delete($module->file);
            }

            $updateModule = $module->update(
                [
                    'title' => $request->title,
                    'slug' => Str::slug($request->title),
                    'file' => $request->file('file')->store('courses/modules', 'public'),
                    'no_module' => $request->no_module,
                ]
            );
        } else {
            $updateModule = $module->update(
                [
                    'title' => $request->title,
                    'slug' => Str::slug($request->title),
                    'no_module' => $request->no_module,
                ]
            );
        }

        if ($module) {
            return ResponseFormatter::success(
                [
                    'redirect' => route('mentor.module', $course->slug),
                ],
                'Berhasil mengubah modul'
            );
        } else {
            return ResponseFormatter::error(
                [
                    'message' => 'Gagal mengubah modul',
                ],
                'Gagal mengubah modul',
                500
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function mentorModuleDestroy(Course $course, Module $module)
    {
        try {
            DB::beginTransaction();
            // update no_module other media
            $modules = Module::where('course_id', $course->id)->orderBy('no_module', 'asc')->get();
            foreach ($modules as $dataModule) {
                if ($dataModule->no_module > $module->no_module) {
                    $updateNoModule = $dataModule->update(
                        [
                            'no_module' => $dataModule->no_module - 1,
                        ]
                    );
                    if (!$updateNoModule) {
                        throw new Exception("Gagal mengubah nomer urut modul");
                    }
                }
            }

            // Delete file before
            $exists = Storage::disk('public')->exists($module->file);
            if ($exists) {
                Storage::disk('public')->delete($module->file);
            }

            $delete = $module->delete();

            if ($delete) {
                DB::commit();
                return ResponseFormatter::success(
                    null,
                    'Modul berhasil dihapus'
                );
            }

            throw new Exception("Gagal menghapus modul");
        } catch (\Exception $error) {
            DB::rollBack();
            return ResponseFormatter::error(
                $error->getMessage(),
                'Gagal menghapus modul',
                500
            );
        }
    }
}
