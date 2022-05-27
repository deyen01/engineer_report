<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Position;
use App\Models\Location;
use App\Models\Branch;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const AAL = [
        0 => 'Обычный',
        1 => 'Модератор',
        2 => 'Администратор'
    ];

    protected $fillable = [
        'email',
        'family',
        'name',
        'ibn',
        'inn',
        'position_id',
        'tel',
        'location_id',
        'address',
        'branch_id',
        'access_level',
        'enabled',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function position() {
        return $this->belongsTo(Position::class);
    }

    public function location() {
        return $this->belongsTo(Location::class);
    }

    public function branch() {
        return $this->belongsTo(Branch::class);
    }

    public function getALAttribute()
    {
        return self::AAL[$this->access_level];
    }

    public function getEnableAttribute()
    {
        if ($this->enabled){
            return 'Да';
        } else {
            return 'Нет';
        }
    }

    public function scopeLimitAL($query)
    {
        if (Auth::user()->access_level == 0) {
            return $query->where('id', Auth::id());
        }
    }
}
