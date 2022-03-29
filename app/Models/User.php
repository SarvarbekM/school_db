<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
//    protected $fillable = [
//        'name',
//        'email',
//        'password',
//    ];

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
    ];

    public static function getBuilder($first_name, $last_name, $bio, $email)
    {
        $objects = self::on();
        if (!empty($first_name)) {
            $objects = $objects->where('first_name', 'LIKE', '%' . $first_name . '%');
        }
        if (!empty($last_name)) {
            $objects = $objects->where('last_name', 'LIKE', '%' . $last_name . '%');
        }
        if (!empty($bio)) {
            $objects = $objects->where('bio', 'LIKE', '%' . $bio . '%');
        }
        if (!empty($email)) {
            $objects = $objects->where('email', 'LIKE', '%' . $email . '%');
        }
        $objects=$objects->whereKeyNot(Auth::id());
        $objects = $objects->orderBy('first_name');
        return $objects;
    }
}
