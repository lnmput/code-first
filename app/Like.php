<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use SoftDeletes;

    protected $table = 'likes';

    protected $fillable = ['uid', 'commentable_id', 'commentable_type'];

    /**
     * 获得拥有此评论的模型。
     */
    public function likeable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'uid');
    }

}
