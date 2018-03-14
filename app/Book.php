<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $table = 'books';

    protected $fillable = ['title', 'profile', 'thumb', 'price', 'uid'];

    public function user()
    {
        return $this->belongsTo('App\User', 'uid');
    }

    public function chapters()
    {
        return $this->hasMany('App\Chapter', 'book_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    /**
     * 解析
     *
     * @return string
     */
    public function profile()
    {
        $parsedown = new \Parsedown();
        $parsedown->setSafeMode(true);

        return $parsedown->text($this->profile);
    }

    public function price()
    {
        return '¥'. $this->price;
    }

    public function thumb()
    {
        return 'uploads/'.$this->thumb;
    }

    public function updated_at()
    {
        return Carbon::parse($this->updated_at)->format('d/m/Y');
    }



    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable')->orderByDesc('id');
    }

    public function likes()
    {
        return $this->morphMany('App\Like', 'commentable')->orderByDesc('id');
    }

    






}
