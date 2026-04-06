<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\SavingPlan;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'alamat',
        'is_active',
        'status',
        'staff_id',
        'assigned_staff_id',
        'saving_plan_id',
        'profile_photo_path',



    ];
    public function staff()
{
    return $this->belongsTo(User::class, 'staff_id');
}

public function users()
{
    return $this->hasMany(User::class, 'staff_id');
}
public function assignedStaff()
{
    return $this->belongsTo(User::class, 'assigned_staff_id');
}

public function monitoredUsers()
{
    return $this->hasMany(User::class, 'assigned_staff_id');
}

public function savingPlan()
{
    return $this->belongsTo(SavingPlan::class);
}

public function weeklyProgress()
{
    return $this->hasMany(WeeklyProgress::class);
}

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'is_active'         => 'boolean',
    ];


}
