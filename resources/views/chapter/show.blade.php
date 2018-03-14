@extends('layouts.app')
@section('title', '文章：'.$item->title)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 show-left-bar">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">文章作者: {{ $item->user->name }}</div>
                    <div class="panel-body">
                        @if($item->user->avatar)
                            <a href="{{ route('user.index', $item->user->id) }}">
                                <img class="thumbnail show-user-avatar" src="{{ asset($item->user->avatar()) }}">
                            </a>
                        @else
                            <div class="text-info show-user-avatar">
                                <p class="thumbnail show-user-avatar">{{ $item->user->getFirstWordsFromName() }}</p>
                            </div>
                        @endif
                        @if($item->user->sex == 1)
                            <i class="fa fa-mars sex" aria-hidden="true"></i>
                        @elseif($item->user->sex == 2)
                            <i class="fa fa-venus sex" aria-hidden="true"></i>
                        @else
                            <i class="fa fa-question-circle-o sex" aria-hidden="true"></i>
                        @endif
                        <p>{{ $item->user->profile }}</p>
                    </div>
                </div>

                @if(!empty($currentUser) && $currentUser->id == $item->user->id)
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <a href="{{ route('chapter.edit', $item->id) }}" >
                                <li class="list-group-item"><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp 持续改进</li>
                            </a>
                        </div>
                    </div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="{{ route('book.show', $item->book->id) }}" >
                            <li class="list-group-item"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp 系列文章</li>
                        </a>
                        <hr>
                        <a href="{{ route('book.show', $item->book->id) }}" >
                            <li class="list-group-item list-group-item-success"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp 订阅微册</li>
                        </a>
                        <hr>
                        <a href="{{ route('book.show', $item->book->id) }}" >
                            <li class="list-group-item list-group-item-danger"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp 单独购买</li>
                        </a>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading text-center">其他文章</div>
                    <div class="panel-body">
                    </div>
                </div>
            </div>

            <div class="col-md-9">
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
                        {!! $item->content() !!}
                    </div>
                </div>
                @include('common.like', ['url' => route('chapter.like.submit')])
                @include('common.comment-list')
                @include('common.comment-textarea', ['url' => route('chapter.comment.submit')])
        </div>
    </div>
@endsection

