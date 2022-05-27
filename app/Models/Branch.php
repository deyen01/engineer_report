<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'ogrn',
        'inn',
        'kpp',
        'address',
        'email',
        'tel'
    ];

    public function scopeLimitByUser($query)
    {
        if (Auth::user()->access_level == 0) {
            return $query->where('id', Auth::user()->branch_id);
        }
    }
}
