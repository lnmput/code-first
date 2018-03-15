<?php

namespace App\Http\Controllers;

use App\Repository\BookRepository;
use App\Repository\ChapterRepository;
use App\Repository\UserRepository;
use App\Tag;
use Auth;


class Chapters extends Controller
{
    protected $user;

    protected $request;

    protected $bookRepository;

    protected $userRepository;

    protected $chapterRepository;

    public function __construct(ChapterRepository $chapterRepository, BookRepository $bookRepository, UserRepository $userRepository)
    {
        $this->middleware(function ($request, $next) {
            $this->user= Auth::user();
            return $next($request);
        });

        $this->request = request();

        $this->chapterRepository = $chapterRepository;

        $this->bookRepository = $bookRepository;

        $this->userRepository = $userRepository;
    }


    public function index()
    {
        $items = $this->chapterRepository->orderByDesc('id')->all(20);

        $tags = Tag::getForSelect();

        return view('chapter.index', ['items' => $items, 'tags' => $tags]);
    }

    public function create($id)
    {
        $book = $this->bookRepository->find($id);

        abort_if(!$book->id, 404);

        abort_if(!$this->userRepository->hasThisBook($id), 403);

        return view('chapter.create', ['book' => $book, 'sellTypes' => $this->chapterRepository->getSelltypes()]);
    }


    public function store()
    {

        $data = $this->request->only('title', 'content', 'book_id', 'sell_type', 'price');

        $book = $this->bookRepository->find($this->request->book_id);

        abort_if(!$book->id, 404);

        abort_if(!$this->userRepository->hasThisBook($book->id), 403);

        $this->validate($this->request, $this->chapterRepository->rules());

        $data['uid'] = $this->user->id;

        $chapter = $this->chapterRepository->create($data);

        flash('微册创建成功', 'success');

        return redirect()->route('chapter.show', $chapter->id);
    }

    public function show($id)
    {
        $chapter = $this->chapterRepository->with(['book'])->find($id);

        return view('chapter.show', ['item' => $chapter]);
    }

    public function edit($id)
    {
        $chapter = $this->chapterRepository->with(['book'])->find($id);

        return view('chapter.eidt', ['chapter' => $chapter]);
    }

    public function update()
    {
        $data =  $this->request->only('title', 'content', 'id');

        $chapter = $this->chapterRepository->find($data['id']);

        abort_if(!$chapter->id, 404);

        abort_if(!$this->userRepository->hasThisChapter($data['id']), 403);

        $this->chapterRepository->update($chapter->id, $data);

        flash('修改成功')->success();

        return redirect()->route('chapter.show', $chapter->id);

    }

    public function submitComment()
    {
        $data = $this->request->only('body');

        $chapter = $this->chapterRepository->find($this->request->id);

        abort_if(!$chapter->id, 404);

        abort_if(!$this->user, 403);

        $data['uid'] = $this->user->id;

        $this->chapterRepository->saveComment($this->request->id, $data);

        flash('评论成功', 'success');

        return redirect()->back();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function likeOrUnlike()
    {
        $id = $this->request->id;

        $book = $this->bookRepository->find($id);

        if (empty($book->id) || empty($this->user->id)) {
            return ajax_error();
        }

        $this->chapterRepository->likeOrUnlike($this->user->id, $book->id);

        return response()->json(['status' => 200, 'message' => 'ok']);
    }
}
