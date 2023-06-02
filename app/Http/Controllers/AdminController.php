<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Admin | Admin UMKMPlus',
            'active' => 'dashboard'
        ];

        return view('admin.dashboard', $data);
    }

    public function profile()
    {
        $user = Auth::user();
        $data = [
            'title' => 'Profile ' . $user->customer->name . ' | Admin UMKMPlus',
            'active' => 'profile',
            'user' => $user,
        ];
        dd($data);

        return view('admin.profile.index', $data);
    }
}
