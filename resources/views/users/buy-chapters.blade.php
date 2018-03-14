@extends('layouts.app')
@section('title', 'Ta购买的文章')
@include('common.user-css')
@section('content')
    <div class="container">
        <div class="row">
            @include('common.user-index-left')
            <div class="col-md-9 setting-content">
                <div class="panel panel-default">
                    <div class="panel-heading">Ta购买的文章</div>
                    <div class="panel-body ">
                        <div class="row not-have-box">
                            <div class="col-md-12">
                                <h4>您还没有订阅过专栏，<a href="" class="text-primary"> 点此</a>去订阅</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('common.user-js')

