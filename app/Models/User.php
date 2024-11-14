<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table        = 'users';

    protected $primaryKey   = 'user_id';

    protected $fillable     = ['name','email','phoneno','password'];

    protected $hidden       = ['password'];

    protected $casts        = ['email_verified_at' => 'datetime','password' => 'hashed'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function isOrganizer()
    {
        return $this->role === config('constants.is_organizer');
    }
}
