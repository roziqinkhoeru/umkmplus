<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\MediaModule;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

class MediaModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function mentorMediaModule(Module $module)
    {
        $data =
            [
                'title' => 'Media Modul | Mentor UMKMPlus',
                'active' => 'course',
                'module' => $module,
            ];

        return view('mentor.courses.media.index', $data);
    }

    public function getMentorMediaModule(Module $module)
    {
        $mediaModules = $module->mediaModules()->orderBy('no_media', 'asc')->get();
        if ($mediaModules) {
            return ResponseFormatter::success(
                [
                    'mediaModules' => $mediaModules,
                    'module' => $module,
                ],
                'Berhasil mengambil media modul'
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Gagal mengambil media modul',
                500
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function mentorMediaModuleCreate(Module $module)
    {
        $data =
            [
                'title' => 'Tambah Media | Mentor UMKMPlus',
                'active' => 'course',
                'module' => $module,
            ];

        return view('mentor.courses.media.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function mentorMediaModuleStore(Request $request, Module $module)
    {
        $rules =
            [
                'title' => 'required|string|max:100',
                'video_url' => 'required|string|max:100',
                'duration' => 'required|numeric',
            ];
        $validator = validator()->make($request->all(), $rules);

        if ($validator->fails()) {
            return ResponseFormatter::error(
                [
                    'message' => 'Gagal membuat media',
                    'error' => $validator->errors()->first(),
                ],
                'Gagal membuat media',
                422
            );
        }

        $no_media = $module->mediaModules()->count() + 1;

        $media = MediaModule::create(
            [
                'module_id' => $module->id,
                'title' => $request->title,
                'video_url' => $request->video_url,
                'duration' => $request->duration,
                'no_media' => $no_media,
            ]
        );

        if ($media) {
            return ResponseFormatter::success(
                [
                    'redirect' => route('mentor.media.module', [$module->slug]),
                ],
                'Berhasil membuat media'
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Gagal membuat media',
                500
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function mentorMediaModuleEdit(Module $module, MediaModule $mediaModule)
    {
        $data =
            [
                'title' => 'Edit Media | Mentor UMKMPlus',
                'active' => 'course',
                'module' => $module,
                'mediaModule' => $mediaModule,
            ];

        return view('mentor.courses.media.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function mentorMediaModuleUpdate(Request $request, Module $module, MediaModule $mediaModule)
    {
        $rules =
            [
                'title' => 'required|string|max:100',
                'video_url' => 'required|string|max:100',
                'duration' => 'required|numeric',
                'no_media' => 'required|numeric',
            ];
        $validator = validator()->make($request->all(), $rules);

        if ($validator->fails()) {
            return ResponseFormatter::error(
                [
                    'message' => 'Gagal mengubah media',
                    'error' => $validator->errors()->first(),
                ],
                'Gagal mengubah media',
                422
            );
        }

        if ($request->no_media != $mediaModule->no_media) {
            $mediaModules = MediaModule::where('module_id', $mediaModule->module_id)->orderBy('no_media', 'asc')->get();
            foreach ($mediaModules as $media) {
                if ($request->no_media > $mediaModule->no_media) {
                    if ($media->no_media > $mediaModule->no_media && $media->no_media <= $request->no_media) {
                        $media->update(
                            [
                                'no_media' => $media->no_media - 1,
                            ]
                        );
                    }
                } else {
                    if ($media->no_media < $mediaModule->no_media && $media->no_media >= $request->no_media) {
                        $media->update(
                            [
                                'no_media' => $media->no_media + 1,
                            ]
                        );
                    }

                }
            }
        }

        $updateMedia = $mediaModule->update(
            [
                'title' => $request->title,
                'video_url' => $request->video_url,
                'duration' => $request->duration,
                'no_media' => $request->no_media,
            ]
        );

        if ($updateMedia) {
            return ResponseFormatter::success(
                [
                    'redirect' => route('mentor.media.module', [$module->slug]),
                ],
                'Berhasil mengubah media'
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Gagal mengubah media',
                500
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function mentorMediaModuleDestroy(Module $module, MediaModule $mediaModule)
    {
        // update no_media other media
        $mediaModules = MediaModule::where('module_id', $module->id)->orderBy('no_media', 'asc')->get();
        foreach ($mediaModules as $media) {
            if ($media->no_media > $mediaModule->no_media) {
                $media->update(
                    [
                        'no_media' => $media->no_media - 1,
                    ]
                );
            }
        }

        $delete = $mediaModule->delete();

        if ($delete) {
            return ResponseFormatter::success(
                null,
                'Media modul berhasil dihapus'
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Media modul gagal dihapus',
                500
            );
        }
    }
}
