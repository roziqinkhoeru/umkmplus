<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\MentorRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MentorRegistrationController extends Controller
{

    public function register()
    {
        $data =
            [
                'title' => 'Become Our Mentor | UMKMPlus',
                'active' => 'mentor'
            ];

        return view('user.mentors.join', $data);
    }

    public function storeRegister(Request $request)
    {
        $rules = [
            'fullname' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric',
            'address' => 'required',
            'job' => 'required',
            'file_cv' => 'required|mimes:pdf|max:2048',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return ResponseFormatter::error(
                [
                    'error' => $validator->errors()->first(),
                ],
                'Pendaftaran mentor gagal',
                400
            );
        }

        $file = $request->file('file_cv');
        $extension = $file->getClientOriginalExtension(); // Mengambil ekstensi file
        $fileName = uniqid() . '.' . $extension; // Membuat nama file acak
        $filePath = $file->storeAs('cv', $fileName, 'public'); // Menyimpan file di folder 'storage/app/public/cv'

        $mentor = MentorRegistration::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'job' => $request->job,
            'file_cv' => $filePath,
        ]);

        if ($mentor) {
            $redirect = redirect('/')->getTargetUrl();
            return ResponseFormatter::success(
                [
                    'redirect' => $redirect,
                ],
                'Pendaftaran mentor berhasil'
            );
        } else {
            return ResponseFormatter::error(
                [
                    'error' => 'Pendaftaran mentor gagal',
                ],
                'Pendaftaran mentor gagal',
                400
            );
        }
    }
}
