<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'cellphone', 'birthdate', 'gender', 'type', 'cpf', 'cnpj', 'company_name', 'avatar', 'oauth_provider', 'oauth_id', 'slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Validate the password of the user for the Passport password grant.
     *
     * @param  string  $password
     * @return bool
     */
    public function validateForPassportPasswordGrant($password)
    {
        return Hash::check($password, '$2y$10$MDrInA7FQkH9hrIDBl1rveOg1ecUj9BR6CjJazChALOCNQ4UtgyOe');
    }

    public function address()
    {
        return $this->hasOne('App\Address');
    }

    public function user_subspecialties()
    {
        return $this->hasMany('App\UserSubspecialty');
    }

    public function events()
    {
        return $this->hasMany('App\Event');
    }

    public function proffessional_events()
    {
        return $this->hasMany('App\Event', 'professional_id');
    }
}
