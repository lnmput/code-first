<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;

    protected $table = 'tags';

    protected $fillable = ['name', 'thumb'];


    /**
     * 获取下拉菜单数据
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getForSelect()
    {
        return static::query()->pluck('name', 'id');
    }

    public function books()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function thumb()
    {
        return '';
    }
}
