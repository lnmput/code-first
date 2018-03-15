@extends('layouts.app')
@section('title', 'Ta喜欢的文章')
@include('common.user-css')
@section('content')
    <div class="container">
        <div class="row">
            @include('common.user-index-left')
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Ta喜欢的文章</h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    @if($user->like_chapters->count())
                        @foreach($user->like_chapters as $item)
                            @php $item = $item->chapter;  @endphp
                            @include('common.chapter-item-list')
                        @endforeach
                    @else
                        <div class="row not-have-box">
                            <div class="col-md-12">
                                <h4>您还没有喜欢的文章，<a href="" class="text-primary"> 点此</a>去查看</h4>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@include('common.user-js')

