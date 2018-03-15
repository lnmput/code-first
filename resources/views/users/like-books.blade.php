@extends('layouts.app')
@section('title', 'Ta喜欢的微册')
@include('common.user-css')
@section('content')
    <div class="container">
        <div class="row">
            @include('common.user-index-left')
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Ta喜欢的微册</h4>
                    </div>
                </div>
                @if($user->like_books->count())
                    @foreach($user->like_books as $item)
                        @php $book = $item->book;  @endphp
                        @include('common.book-item-list')
                    @endforeach
                @else
                    <div class="row not-have-box">
                        <div class="col-md-12">
                            <h4>您还没有订阅过专栏，<a href="" class="text-primary"> 点此</a>去订阅1</h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@include('common.user-js')

