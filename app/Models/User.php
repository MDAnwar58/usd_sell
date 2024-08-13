<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded =['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function post()
    {
        return $this->hasOne(Post::class);
    }
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }
    public function userPayment()
    {
        return $this->hasOne(UserPayment::class);
    }



    public function receivedConnections()
    {
        return $this->hasMany(Connect::class, 'to_id');
    }

    // Define the relationship for connections where the user is the sender (from_id)
    public function sentConnections()
    {
        return $this->hasMany(Connect::class, 'from_id');
    }


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
