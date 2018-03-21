<?php
namespace App\Repository;

use Auth;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;

class UserRepository
{
    protected $user;

    protected $currentUser;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->currentUser = Auth::user();
    }

    public function find($id)
    {
        return $this->user->find($id);
    }



    /**
     * 关系预加载
     *
     * @param array $relations
     * @return $this
     */
    public function with(array $relations)
    {
        $this->user = $this->user->with($relations);
        return $this;
    }

    public function withCount(array $relation)
    {
        $this->user = $this->user->withCount($relation);
        return $this;
    }

    public function orderByDesc($field)
    {
        $this->user = $this->user->orderByDesc($field);
        return $this;
    }


    public function order($field, $sort = 'desc')
    {
        $this->user = $this->user->orderBy($field, $sort);
        return $this;
    }


    /**
     * 修改用户数据
     *
     * @param $id
     * @param array $data
     */
    public function update($id, Array $data)
    {
        if (key_exists('profile', $data) && is_null($data['profile'])) {
             $data['profile'] = '';
        }

        $this->user->where('id', $id)->update($data);
    }


    public function hasThisBook($id)
    {
        return (boolean)$this->user->whereHas('books', function (Builder $query) use ($id) {
            $query->where('id', $id);
        })->count();
    }

    public function hasThisChapter($id)
    {
        return $this->user->whereHas('chapters', function (Builder $query) use ($id) {
            $query->where('id', $id);
        })->count();
    }

    /**
     * 数据验证规则
     *
     * @param $id
     * @return array
     */
    public function rules($id)
    {
        return [
            'name' => ['required', 'max:6', Rule::unique('users')->ignore($id)],
            'profile' => 'max:30'
        ];
    }


}