@extends('layouts.app')
@section('title', 'Ta撰写的文章')
@include('common.user-css')
@section('content')
    <div class="container">
        <div class="row">
            @include('common.user-index-left')
            <div class="col-md-9 setting-content">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Ta撰写的文章</h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body ">
                        @if($user->chapters->count())
                            @foreach($user->chapters as $item)
                                @include('common.chapter-item-list')
                            @endforeach
                        @else
                            <div class="row not-have-box">
                                <div class="col-md-12">
                                    <h4>您还没有撰写过文章...</h4>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('common.user-js')

