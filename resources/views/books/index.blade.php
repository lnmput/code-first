@extends('layouts.app')
@section('title', '微册列表-订阅你喜欢的微册')
@section('content')
<div class="container">
   <div class="row">
       <div class="col-md-8">
           @foreach($books as $book)
               @include('common.book-item-list')
           @endforeach
       </div>
       @include('common.list-left-bar')
   </div>
</div>
@endsection
