<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function mediaModules()
    {
        return $this->hasMany(MediaModule::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
