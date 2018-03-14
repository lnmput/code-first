@extends('layouts.app')
@section('title', '用户中心')
@include('common.user-css')
@section('content')
    <div class="container">
        <div class="row">
            @include('common.user-index-left')
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>最新动态</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('common.user-js')

