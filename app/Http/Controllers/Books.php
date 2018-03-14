<?php

namespace App\Http\Controllers;

use App\Repository\BookRepository;
use App\Repository\UserRepository;
use App\Tag;
use Auth;


class Books extends Controller
{
    protected $bookRepository;

    protected $userRepository;

    protected $user;

    protected $request;

    public function __construct(BookRepository $bookRepository, UserRepository $userRepository)
    {
        $this->middleware(function ($request, $next) {
            $this->user= Auth::user();
            return $next($request);
        });

        $this->request = request();

        $this->bookRepository = $bookRepository;

        $this->userRepository = $userRepository;
    }


    /**
     * 列表页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $tags = Tag::getForSelect();

        $books = $this->bookRepository->orderByDesc('id')->all(10);

        return view('books.index',  ['books' => $books, 'tags' => $tags]);
    }


    /**
     * 单一展示
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $book = $this->bookRepository->with(['user'])->find($id);
        $tags = Tag::getForSelect();

        return view('books.show', ['item' => $book, 'tags' => $tags]);
    }

    /**
     * 创建页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $tags = Tag::getForSelect();

        return view('books.create',  ['tags' => $tags]);
    }

    /**
     * 创建方法
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $file = $this->request->file('thumb');

        if ($file->isValid()) {

            $data = $this->request->only(['title', 'price', 'tags', 'profile']);

            $data['thumb'] = $this->bookRepository->saveImage($file, $this->user->id);

            $data['uid'] = $this->user->id;

            $book = $this->bookRepository->create($data);

            flash('微册创建成功')->success();

            return redirect()->route('book.show', $book->id);
        }

        return redirect()->back();
    }


    /**
     * 编辑页面
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $book = $this->bookRepository->find($id);

        $tags = Tag::getForSelect();

        return view('books.edit', ['book' => $book, 'tags' => $tags]);
    }

    /**
     * 编辑方法
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {
        $data = $this->request->only('title', 'id', 'price', 'tags', 'profile');

        $book = $this->bookRepository->find($this->request->id);

        abort_if(!$book->id, 403);

        abort_if(!$this->userRepository->hasThisBook($book->id), 403);

        $this->bookRepository->update($book->id, $data);

        flash('修改成功')->success();

        return redirect()->route('book.show', $book->id);
    }

    /**
     * 提交评论
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitComment()
    {
        $data = $this->request->only('body');

        $book = $this->bookRepository->find($this->request->id);

        abort_if(!$book->id, 404);

        abort_if(!$this->user, 403);

        $data['uid'] = $this->user->id;

        $this->bookRepository->saveComment($this->request->id, $data);

        flash('评论成功', 'success');

        return redirect()->back();

    }

    public function likeOrUnlike()
    {
        $id = $this->request->id;

        $book = $this->bookRepository->find($id);

        if (empty($book->id) || empty($this->user->id)) {
            return ajax_error();
        }

        $this->bookRepository->likeOrUnlike($this->user->id, $book->id);

        return response()->json(['status' => 200, 'message' => 'ok']);
    }
}
