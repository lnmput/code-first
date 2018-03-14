<?php
namespace App\Repository;
use App\Chapter;
use App\Like;
use Illuminate\Validation\Rule;

class ChapterRepository
{
    protected $chapter;

    protected $like;

    public function __construct(Chapter $chapter, Like $like)
    {
        $this->chapter = $chapter;
        $this->like = $like;
    }


    public function find($id)
    {
        return $this->chapter->find($id);
    }

    /**
     * 数据创建
     *
     * @param array $data
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return $this->chapter->create($data);
    }

    /**
     * 更新数据
     *
     * @param $id
     * @param array $data
     * @return bool
     */
    public function update($id, array $data)
    {
        return $this->chapter->where('id', $id)->update($data);
    }


    /**
     * 关系预加载
     *
     * @param array $relations
     * @return $this
     */
    public function with(array $relations)
    {
        $this->chapter->with($relations);
        return $this;
    }

    /**
     * 获取列表数据
     *
     * @param int $page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection
     */
    public function all($page = 0)
    {
        if ($page) {
            return $this->chapter->paginate($page);
        }
        return $this->chapter->get();
    }


    public function rules()
    {
        return [
            'title' => ['required', 'max:15', 'min:6', Rule::unique('chapters')],
            'sell_type' =>  ['required', Rule::in(data_get($this->getSelltypes(), '*.id'))],
            'content' => 'required|min:10',
            'price' => 'required_if:sell_type,3|numeric'
        ];
    }


    public function getSelltypes()
    {
        return config('microbook.sellType');
    }

    public function saveComment($id, array $data)
    {
        $this->chapter->where('id', $id)->first()->comments()->create($data);
    }

    /**
     * @param $uid
     * @param $id
     * @throws \Exception
     */
    public function likeOrUnlike($uid, $id)
    {
        $like = $this->like->where(['uid' => $uid, 'commentable_id' => $id, 'commentable_type' => get_class($this->chapter)])->first();

        if ($like) {
            $like->delete();
        } else {
            $this->chapter->where('id', $id)->first()->likes()->create(['uid' => $uid]);
        }
    }
}