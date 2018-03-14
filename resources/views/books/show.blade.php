@extends('layouts.app')
@section('title', $item->title)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 show-left-bar">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">微册作者: {{ $item->user->name }}</div>
                    <div class="panel-body">
                        @if($item->user->avatar)
                             <img class="thumbnail show-user-avatar" src="{{ asset($item->user->avatar()) }}">
                        @else
                            <div title="修改头像" class="text-info show-user-avatar">
                                <p class="thumbnail show-user-avatar">{{ $item->user->getFirstWordsFromName() }}</p>
                            </div>
                        @endif

                        @if($item->user->sex == 1)
                            <i class="fa fa-mars" aria-hidden="true"></i>
                        @elseif($item->user->sex == 2)
                            <i class="fa fa-venus" aria-hidden="true"></i>
                        @else
                            <i class="fa fa-question-circle-o" aria-hidden="true"></i>
                        @endif
                        <p class="help-block">{{ $item->user->profile }}</p>
                    </div>
                </div>
                @if(!empty($currentUser) && $currentUser->id == $item->user->id)
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <a href="{{ route('book.edit', $item->id) }}" >
                                <li class="list-group-item"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp; 编辑微册</li>
                            </a>
                            <hr>
                            <a href="{{ route('chapter.create', $item->id) }}" >
                                <li class="list-group-item"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; 添加文章（{{ $item->chapters->count() }}）</li>
                            </a>
                        </div>
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="">
                            <li class="list-group-item list-group-item-success"><i class="text-md fa fa-list-ul"></i> &nbsp订阅微册 @if($item->price) {{ $item->price() }} @endif</li>
                        </a>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading text-center">其他文章</div>
                    <div class="panel-body">
                    </div>
                </div>
            </div>

            <div class="col-md-9 book-profile">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h4>{{ $item->title }}</h4>
                        <div class="help-block text-center book-extention-info">
                            <i class="fa fa-clock-o"></i> <abbr>2天前</abbr>
                            ⋅
                            <i class="fa fa-eye"></i> 337
                            ⋅
                            <i class="fa fa-thumbs-o-up"></i> 18
                            ⋅
                            <i class="fa fa-comments-o"></i> 15
                        </div>
                    </div>
                    <div class="panel-body">
                        <h2 class="show-h2">全部章节</h2>
                        <ul class="list-group">
                            @foreach($item->chapters as $chapter)
                                <li class="list-group-item">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                    <a href="{{ route('chapter.show', $chapter->id) }}">{{ $chapter->title }}</a>
                                    <small>
                                    <span class="pull-right">
                                    <span>评论数：12</span>
                                </span>
                                    </small>
                                </li>
                            @endforeach
                        </ul>
                        <h2 class="show-h2">简介</h2>
                        {!! $item->profile() !!}
                    </div>
                </div>

                @include('common.like', ['url' => route('book.like.submit')])

                @include('common.comment-list')
                @include('common.comment-textarea', ['url' => route('book.comment.submit')])
            </div>
        </div>
    </div>
@endsection


