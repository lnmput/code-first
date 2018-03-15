<?php
namespace App\Repository;


use App\Like;
use Storage;
use App\Book;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class BookRepository
{
    protected $book;

    protected $like;

    public function __construct(Book $book, Like $like)
    {
        $this->book = $book;

        $this->like = $like;

    }

    public function create(array $data)
    {
        $book = $this->book->create($data);

        if (isset($data['tags']) && count($data['tags'])) {
            $book->tags()->attach($data['tags']);
        }

        return $book;
    }

    public function find($id)
    {
        return $this->book->find($id);
    }

    public function with(array $relation)
    {
         $this->book->with($relation);
         return $this;
    }

    public function orderByDesc($field)
    {
        $this->book->orderByDesc($field);
        return $this;
    }

    public function all($page = 0)
    {
        if ($page) {
            return $this->book->paginate($page);
        }
        return $this->book->get();
    }


    /**
     * 修改内容
     *
     * @param $id
     * @param array $data
     * @return mixed|static
     */
    public function update($id, array $data)
    {
        $book = $this->book->find($id);

        $book->update($data);

        if (isset($data['tags']) && count($data['tags'])) {
            $book->tags()->sync($data['tags']);
        }

        return $book;
    }


    /**
     * 保存图片
     *
     * @param UploadedFile $file
     * @param string $extention
     * @return string
     */
    public function saveImage(UploadedFile $file, $extention = '')
    {
        $ext = $file->getClientOriginalExtension();

        $realPath = $file->getRealPath();

        $date = date('Y-m-d');

        $path = 'books/'.$date.'/'.time().'-'.$extention.'.'.$ext;

        Storage::disk('uploads')->put($path, file_get_contents($realPath));

        return $path;
    }

    /**
     * 保存评论
     *
     * @param $id
     * @param array $data
     */
    public function saveComment($id, array $data)
    {
        $this->book->where('id', $id)->first()->comments()->create($data);
    }


    /**
     *
     * @param $uid
     * @param $id
     */
    public function likeOrUnlike($uid, $id)
    {

        $like = $this->like->where(['uid' => $uid, 'commentable_id' => $id, 'commentable_type' => get_class($this->book)])->first();

        if ($like) {
            $like->delete();
        } else {
            $this->book->where('id', $id)->first()->likes()->create(['uid' => $uid]);
        }
    }

}