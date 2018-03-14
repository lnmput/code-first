<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_login_at', 'avatar', 'ip', 'sex', 'is_actived', 'unique_id', 'profile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function avatar()
    {
        return 'uploads/'.$this->avatar;
    }

    public function getFirstWordsFromName()
    {
        return mb_substr($this->name, 0,1);
    }

    public function books()
    {
        return $this->hasMany('App\Book', 'uid');
    }

    public function chapters()
    {
        return $this->hasMany('App\Chapter', 'uid');
    }

    public function ifHaveThisBook()
    {

    }

    public function ifHaveThisChapter()
    {

    }




}
