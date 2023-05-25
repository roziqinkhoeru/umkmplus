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
        return $this->hasMany(Course::class);
    }

    public function customerSpecialists()
    {
        return $this->hasMany(CustomerSpecialist::class);
    }

    public function studentCourseEnrolls()
    {
        return $this->hasMany(CourseEnroll::class);
    }

    public function mentorDiscounts()
    {
        return $this->hasMany(Discount::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public static function scopeMentor($query)
    {
        return $query->join('users', 'users.customer_id', '=', 'customers.id')
        ->join('role_users', 'role_users.user_id', '=', 'users.id')
            ->where('role_users.role_id', 2);
    }
    public static function scopeStudent($query)
    {
        return $query->join('users', 'users.customer_id', '=', 'customers.id')
        ->join('role_users', 'role_users.user_id', '=', 'users.id')
            ->where('role_users.role_id', 3);
    }

    public static function scopeDataCourseStudent($query)
    {
        return $query->select('customers.id', 'customers.name', 'customers.profile_picture', 'customers.job', DB::raw('count(course_enrolls.id) as total_student'))
        ->leftJoin('courses', 'courses.mentor_id', '=', 'customers.id')
        ->leftJoin('course_enrolls', 'course_enrolls.course_id', '=', 'courses.id')
        ->groupBy('customers.id')
        ->orderBy('total_student', 'desc');
    }
}
