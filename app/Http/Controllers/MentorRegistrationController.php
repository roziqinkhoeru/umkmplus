<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\MentorRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MentorRegistrationController extends Controller
{

    public function register()
    {
        $user = Auth::user();
        if ($user->mentorRegistration) {
            return redirect('/')->with('error', 'Anda sudah terdaftar sebagai mentor');
        }
        $data =
            [
                'title' => 'Daftar Mentor | UMKMPlus',
                'active' => 'mentor'
            ];

        return view('user.mentors.register', $data);
    }

    public function storeRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required',
            'file_cv' => 'required|mimes:pdf|max:2048',
        ]);

        $file = $request->file('file_cv');
        $extension = $file->getClientOriginalExtension(); // Mengambil ekstensi file
        $fileName = uniqid() . '.' . $extension; // Membuat nama file acak
        $filePath = $file->storeAs('cv', $fileName, 'public'); // Menyimpan file di folder 'storage/app/public/cv'

        $mentor = MentorRegistration::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
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
