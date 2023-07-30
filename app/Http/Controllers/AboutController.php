<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentDate = now();
        $currentYear = now()->year;
        $createdUMKMPlus = now()->setYear(2023)->setMonth(6)->setDay(16);

        function dateDiffInDays($date1, $date2)
        {
            $oneDay = 24 * 60 * 60; // 1 day in seconds
            return round(abs($date1->timestamp - $date2->timestamp) / $oneDay);
        }

        $daysDifference = dateDiffInDays($createdUMKMPlus, $currentDate);
        $countStudent = User::leftJoin('role_users', 'role_users.role_id', '=', 'users.id')->where('role_users.role_id', '3')->count();
        $countMentor = User::leftJoin('role_users', 'role_users.role_id', '=', 'users.id')->where('role_users.role_id', '2')->count();
        $countCourse = Course::count();
        $data = [
            'title' => 'Tentang Kami | UMKMPlus',
            'active' => 'dashboard',
            'countStudent' => $countStudent,
            'countMentor' => $countMentor,
            'countCourse' => $countCourse,
            'daysDifference' => $daysDifference,
            'currentYear' => $currentYear,
        ];

        return view('user.company.about', $data);
    }
}
