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

}
