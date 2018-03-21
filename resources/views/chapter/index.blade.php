@extends('layouts.app')
@section('title', '文章列表-查看你喜欢的文章')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    @foreach($items as $item)
                        @include('common.chapter-item-list')
                    @endforeach
                </div>
            </div>
            @include('common.list-left-bar')
        </div>
    </div>
@endsection
