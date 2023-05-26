<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function student()
    {
        return $this->belongsTo(Customer::class);
    }
    public static function scopeCountCart($query)
    {
        return $query->where('student_id', auth()->user()->customer->id)
        ->groupBy('student_id')
        ->count();
    }
}
