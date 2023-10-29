<?php

namespace App\Models;

use App\Notifications\AdminResetPassword;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Authenticatable {
    use Notifiable, SoftDeletes;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'username', 'role', 'email', 'password',
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
    * Send the password reset notification.
    *
    * @param  string  $token
    * @return void
    */

    public function post(): HasMany {
        return $this->hasMany( Posts::class, 'post_id', 'id' );
    }

    public function sendPasswordResetNotification( $token ) {
        $this->notify( new AdminResetPassword( $token ) );
    }
}
