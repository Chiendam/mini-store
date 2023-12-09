<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use MongoDB\Laravel\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'username',
        'phone_number',
        'role',
        'email',
        'password',
        'status',
        'remember_token',
        'created_by',
        'updated_by',
    ];

    public $timestamps = true;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getIsActiveTextAttribute(): string
    {
        if($this->status == NULL) return '<span class="label label-primary">Hoạt động</span>';
        return match ((int)$this->status) {
            1 => '<span class="label label-primary">Hoạt động</span>',
            0 => '<span class="label label-danger">Tạm khóa</span>',
        };
    }

    public function getRoleTextAttribute()
    {
        if($this->role == NULL) return '<span class="label label-success">Quyền quản trị viên</span>';
        return match ((int)$this->role) {
            1 => '<span class="label label-success">Quyền quản trị viên</span>',
            2 => '<span class="label label-primary">Quyền nhân viên',
        };
    }
}
