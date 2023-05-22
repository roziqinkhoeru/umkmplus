<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function mentor()
    {
        return $this->belongsTo(Customer::class, 'mentor_id');
    }

    public function courseEnrolls()
    {
        return $this->hasMany(CourseEnroll::class);
    }
}
