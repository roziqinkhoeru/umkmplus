<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\MentorRegistration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MentorRegistrationController extends Controller
{

    public function register()
    {
        $categories = Category::all();
        $data =
            [
                'title' => 'Become Our Mentor | UMKMPlus',
                'active' => 'mentor',
                'categories' => $categories,
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
            'specialist' => 'required',
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
        $nameMentor = Str::slug($request->fullname);

        $file = $request->file('file_cv');
        $extension = $file->getClientOriginalExtension(); // Mengambil ekstensi file
        $fileName = $nameMentor . "-cv" . '.' . $extension; // Membuat nama file acak
        $filePath = $file->storeAs('cv', $fileName, 'public'); // Menyimpan file di folder 'storage/app/public/cv'

        $mentor = MentorRegistration::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'job' => $request->job,
            'file_cv' => $filePath,
            'specialist' => $request->specialist,
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
