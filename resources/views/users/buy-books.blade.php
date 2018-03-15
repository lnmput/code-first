@extends('layouts.app')
@section('title', 'Ta订阅的微册')
@include('common.user-css')
@section('content')
    <div class="container">
        <div class="row">
            @include('common.user-index-left')
            <div class="col-md-9 setting-content">
                <div class="panel panel-default">
                    <div class="panel-heading">Ta订阅的微册</div>
                    <div class="panel-body ">
                        <div class="row not-have-box">
                            <div class="col-md-12">
                                <h4>您还没有订阅过微册，<a href="{{ route('book.index') }}" class="text-primary"> 点此</a>去订阅</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('common.user-js')

