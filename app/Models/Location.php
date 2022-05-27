<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'oktmo'
    ];

    public function scopeLimitByUser($query)
    {
        if (Auth::user()->access_level == 0) {
            return $query->where('id', Auth::user()->location_id);
        }
    }
}
