<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Location;
use App\Models\User;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'location_id',
        'address',
        'place',
        'vendor',
        'client_id'
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function location() {
        return $this->belongsTo(Location::class);
    }

    public function scopeLimitByUser($query)
    {
        if (Auth::user()->access_level == 0) {
            return $query->where('location_id', Auth::user()->location_id);
        }
    }

    protected static function booted()
    {
        static::creating(function (Device $device) {
            $device->user_id = Auth::id();
        });
    }
}
