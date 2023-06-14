<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function mentor()
    {
        return $this->belongsTo(Customer::class, 'mentor_id');
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function courseEnrolls()
    {
        return $this->hasMany(CourseEnroll::class, 'course_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public static function scopeDataMentorCategory($query)
    {
        return $query->with('mentor', 'category')
        ->withCount("modules")
        ->withCount(["courseEnrolls as course_enrolls_count" => function ($query) {
            $query->where("status", "aktif")->orWhere("status", "selesai");
        }])
        ->orderBy("course_enrolls_count", "desc");
    }
}
