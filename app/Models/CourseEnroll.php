<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseEnroll extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'id' => 'string',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function student()
    {
        return $this->belongsTo(Customer::class, 'student_id');
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }
}
