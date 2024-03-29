<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function mentorCourses()
    {
        return $this->hasMany(Course::class, 'mentor_id');
    }

    public function customerSpecialists()
    {
        return $this->hasMany(CustomerSpecialist::class);
    }

    public function studentCourseEnrolls()
    {
        return $this->hasMany(CourseEnroll::class, 'student_id');
    }

    public function mentorDiscounts()
    {
        return $this->hasMany(Discount::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'student_id');
    }
    public function specialists()
    {
        return $this->belongsToMany(Specialist::class, 'customer_specialists');
    }

    public function dataMentor()
    {
        return $this->hasOne(Mentor::class, 'customer_id');
    }

    public function withdraw()
    {
        return $this->hasMany(Withdraw::class);
    }
    public static function scopeMentor($query)
    {
        return $query->select('customers.id', 'customers.name','customers.slug', 'users.email', 'role_users.role_id', 'customers.job', 'customers.profile_picture')
        ->with('dataMentor')
        ->leftJoin('users', 'users.customer_id', '=', 'customers.id')
        ->leftJoin('role_users', 'role_users.user_id', '=', 'users.id')
            ->where('role_users.role_id', 2);
    }
    public static function scopeStudent($query)
    {
        return $query->leftJoin('users', 'users.customer_id', '=', 'customers.id')
        ->leftJoin('role_users', 'role_users.user_id', '=', 'users.id')
            ->where('role_users.role_id', 3);
    }

    public static function scopeDataCourseStudent($query)
    {
        return $query->select('customers.name', 'customers.profile_picture', 'customers.job', 'customers.slug', DB::raw('count(course_enrolls.id) as total_student'))
        ->with(['dataMentor', 'specialists:name'])
        ->leftJoin('courses', 'courses.mentor_id', '=', 'customers.id')
        ->leftJoin('course_enrolls', 'course_enrolls.course_id', '=', 'courses.id')
        ->where(function ($query) {
            $query->where('course_enrolls.status', 'aktif')
                ->orWhere('course_enrolls.status', 'selesai');
        })
        ->groupBy('courses.mentor_id')
        ->orderBy('total_student', 'desc');
    }

    public static function scopeCountStudent($query, $mentorId)
    {
        return $query->leftJoin('courses', 'courses.mentor_id', '=', 'customers.id')
        ->leftJoin('course_enrolls', 'course_enrolls.course_id', '=', 'courses.id')
        ->where('courses.mentor_id', $mentorId)
        ->where(function ($query) {
            $query->where('course_enrolls.status', 'aktif')
                ->orWhere('course_enrolls.status', 'selesai');
        })
        ->count();
    }
}
