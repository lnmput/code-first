<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends Model
{
    use SoftDeletes;

    protected $table = 'chapters';

    protected $fillable = ['title', 'content', 'thumb', 'price', 'sell_type', 'book_id', 'uid'];


    public function user()
    {
        return $this->belongsTo('App\User', 'uid');
    }

    public function book()
    {
        return $this->belongsTo('App\Book', 'book_id');
    }

    public function content()
    {
        $parsedown = new \Parsedown();
        $parsedown->setSafeMode(true);

        return $parsedown->text($this->content);
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
