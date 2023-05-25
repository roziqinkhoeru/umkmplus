<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

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
        return $this->hasMany(Module::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
