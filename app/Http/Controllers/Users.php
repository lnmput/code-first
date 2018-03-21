<?php

namespace App\Http\Controllers;

use Auth;
use App\Repository\UserRepository;

use Storage;
use Illuminate\Http\Request;


class Users extends Controller
{
    public $user;

    protected $request;

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->middleware(function ($request, $next) {

            $this->user= Auth::user();
            return $next($request);

        })->except(['index']);

        $this->request = request();

        $this->userRepository = $userRepository;
    }

    /**
     * 用户中心首页
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {

        $user = $this->userRepository->with(['books', 'chapters'])->withCount(['books', 'chapters'])->find($id);

       // dd($user);

        return view('users.index', ['user' => $user]);
    }

    /**
     * 用户信息编辑页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        return view('users.edit',  ['user' => $user]);
    }

    /**
     * 上传修改头像
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function avatarUpload()
    {
        $date = date('Y-m-d');

        $path = 'avatar/'.$date.'/'.time().'-'.$this->user->id.'.png';

        Storage::disk('uploads')->put($path, file_get_contents($this->request->img));

        $this->user->avatar = $path;

        $this->user->save();

        return response()->json(['status' => 200, 'message' => $this->user->avatar()]);

    }


    /**
     * 修改用户信息
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {
        $this->validate($this->request, $this->userRepository->rules($this->user->id));

        $this->userRepository->update($this->user->id, $this->request->only(['name', 'sex', 'profile']));

        flash('修改成功', 'success');

        return redirect()->back();
    }


    /**
     * 用户发表的微册列表
     *
     */
    public function booksIndex($id)
    {
        trace_sql();
        $user = $this->userRepository->orderByDesc('id')->with(['books'])->withCount(['books', 'chapters'])->find($id);

        return view('users.books', ['user' => $user]);
    }


    /**
     * 用户发表的文章列表
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function chapterIndex($id)
    {
        $user = $this->userRepository->orderByDesc('id')->with(['books'])->withCount(['books', 'chapters'])->find($id);

        return view('users.chapters', ['user' => $user]);
    }


    /**
     * 喜欢的文章列表
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function likeChaptersIndex($id)
    {
        $user = $this->userRepository->orderByDesc('id')->with(['books'])->withCount(['books', 'chapters'])->find($id);

        return view('users.like-chapters', ['user' => $user]);
    }


    /**
     * 喜欢的微册列表
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function likeBooksIndex($id)
    {
        $user = $this->userRepository->orderByDesc('id')->with(['like_books'])->withCount(['books', 'chapters', 'like_books'])->find($id);

        return view('users.like-books', ['user' => $user]);
    }


    /**
     * 用户已经购买的微册列表
     *
     */

    public function buyBooksIndex($id)
    {
        $user = $this->userRepository->orderByDesc('id')->with(['books'])->withCount(['books', 'chapters'])->find($id);

        return view('users.buy-books', ['user' => $user]);
    }


    /**
     * 用户单独购买的文章列表
     */
    public function buyChaptersIndex($id)
    {
        $user = $this->userRepository->orderByDesc('id')->with(['books'])->withCount(['books', 'chapters'])->find($id);

        return view('users.buy-chapters', ['user' => $user]);
    }


    /**
     * 购买微册
     */
    public function buyBook()
    {

    }


    /**
     * 购买文章
     */
    public function buyChapter()
    {

    }

}
