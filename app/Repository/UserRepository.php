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