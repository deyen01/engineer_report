<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Report extends Model
{
    use HasFactory;

    const ToW = [
        0 => 'FLM',
        1 => 'SLM',
        2 => 'Cleaning',
        3 => 'Дежурство',
        4 => 'Возвращение домой'
    ];

    const StT = [
        0 => 'Черновик',
        1 => 'Подан на проверку',
        2 => 'Принят',
        3 => 'Отклонён'
    ];

    protected $fillable = [
        'type_of_work',
        'date_executed',
        'number_ticket',
        'number_device',
        'mileage',
        'comment',
        'location',
        'address',
        'title_client',
        'status',
        'reason'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function moderator() {
        return $this->belongsTo(User::class);
    }

    public function getTWAttribute()
    {
        return self::ToW[$this->type_of_work];
    }

    public function getSTAttribute()
    {
        return self::StT[$this->status];
    }

    public function scopeLimitByUser($query)
    {
        if (Auth::user()->access_level == 0) {
            return $query->where('user_id', Auth::id());
        }
    }

    protected static function booted()
    {
        static::creating(function (Report $report) {
            $report->user_id = Auth::id();
        });
    }
}
