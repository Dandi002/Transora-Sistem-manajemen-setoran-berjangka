<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeeklyProgress extends Model
{
    protected $table = 'weekly_progress';

    protected $fillable = [
        'user_id',
        'week_number',
        'is_checked',
        'checked_at',
    ];
}
