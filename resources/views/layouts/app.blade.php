<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.bootcss.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/font-autumn.css') }}">
    <link href="https://cdn.bootcss.com/animate.css/3.5.2/animate.min.css" rel="stylesheet">
    @yield('css')
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    @yield('head_js')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'CodeFirst') }}
                    </a>
                </div>
                <div class="container">
                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="{{ set_active('/') }}"><a href="/">文章</a></li>
                            <li class="{{ set_active('book') }}"><a href="{{ route('book.index') }}">微册</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            @guest
                                <li><a href="{{ route('login') }}">登录</a></li>
                                <li><a href="{{ route('register') }}">注册</a></li>
                            @else
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                        @if($currentUser->avatar)
                                            <img class="avatar" title="{{ Auth::user()->name }}" src="{{ asset($currentUser->avatar()) }}">
                                        @else
                                            <div title="修改头像" class="text-info" >
                                                <span class="avatar">{{ $currentUser->getFirstWordsFromName() }}</span>
                                            </div>
                                        @endif
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('user.index', Auth::id())}}"><i class="icon-camera-retro"></i> 个人中心</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('book.create') }}"><i class="icon-camera-retro"></i> 创建专栏</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                <i class="icon-camera-retro"></i>
                                                退出
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @endguest
                        </ul>
                    </div>

                </div>
            </div>
        </nav>
        <div class="container">
            @include('flash::message')
            @if (count($errors) > 0)
                <div class="row">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>
        @yield('content')
    </div>
    <script src="{{ asset('head/jquery.min.js') }}"></script>
    <script src="{{ asset('head/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('js')
</body>
</html>
