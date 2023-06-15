<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $hidden = [
        'balance',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
