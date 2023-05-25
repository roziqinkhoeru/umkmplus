<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
