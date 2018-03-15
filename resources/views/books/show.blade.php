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

                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="user-info row">
                            <div class="col-md-4">
                                <span>{{ $item->chapters_count }}</span>
                                <a>文章数</a>
                            </div>
                            <div class="col-md-4">
                                <span>0</span>
                                <a>订阅数</a>
                            </div>
                            <div class="col-md-4">
                                <span>{{ $item->likes_count }}</span>
                                <a>喜欢数</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="">
                            <li class="list-group-item list-group-item-success"><i class="fa fa-shopping-cart" aria-hidden="true"></i></i> &nbsp 立即订阅 @if($item->price) {{ $item->price() }} @endif</li>
                        </a>
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
                                <li class="list-group-item"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; 新增文章</li>
                            </a>
                        </div>
                    </div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading text-center">其他</div>
                    <div class="panel-body">
                    </div>
                </div>
            </div>

            <div class="col-md-9 book-profile">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h4>{{ $item->title }}</h4>
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
                                    <span>喜欢数：{{ $chapter->likes->count() }}</span>
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


