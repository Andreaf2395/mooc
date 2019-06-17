<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\NewResetPasswordNotification;
//use App\thread;

class Login extends Authenticatable  
{
	use Notifiable;

    protected $table = 'login';

    


    protected $fillable = [
         'username', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function getAuthIdentifierName(){
    	return 'username';
    }

    public function threads()
    {
        return $this->hasMany(thread::class);
    }
}
