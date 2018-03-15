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

    /**
     * 关联用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'uid');
    }

    /**
     * 关联微册
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book()
    {
        return $this->belongsTo('App\Book', 'commentable_id')->orderByDesc('id');
    }

    /**
     * 关联文章
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chapter()
    {
        return $this->belongsTo('App\Chapter', 'commentable_id')->orderByDesc('id');
    }

}
