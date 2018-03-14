@extends('layouts.app')
@section('title', '用户设置')
@section('css')
    <link href="{{ asset('head/cropper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('head/sitelogo.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            @include('common.user-index-left')
            <div class="col-md-9 setting-content">
                <div class="panel panel-default">
                    <div class="panel-heading">个人资料修改</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="post" action="{{ route('users.update') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">用户名</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $currentUser->name }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">性别</label>
                                <div class="col-sm-10">
                                    <label class="radio-inline">
                                        <input type="radio" name="sex" value="1" @if($currentUser->sex == '1') checked @endif> 程序猿
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="sex" value="2" @if($currentUser->sex == '2') checked @endif> 程序媛
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="sex" value="0" @if($currentUser->sex == '0') checked @endif> 保密
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="profile" class="col-sm-2 control-label">简介</label>
                                <div class="col-sm-10">
                                    <textarea name="profile" id="profile" class="form-control" rows=3" maxlength="30" placeholder="请用一句话介绍自己">{{ $currentUser->profile }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-success btn-block">修改</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('head/cropper.js') }}"></script>
    <script src="{{ asset('head/sitelogo.js') }}"></script>
    <script src="{{ asset('head/html2canvas.min.js') }}" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        //做个下简易的验证  大小 格式
        $('#avatarInput').on('change', function(e) {
            var filemaxsize = 1024 * 5;//5M
            var target = $(e.target);
            var Size = target[0].files[0].size / 1024;
            if(Size > filemaxsize) {
                alert('图片过大，请重新选择!');
                $(".avatar-wrapper").childre().remove;
                return false;
            }
            if(!this.files[0].type.match(/image.*/)) {
                alert('请选择正确的图片!')
            } else {
                var filename = document.querySelector("#avatar-name");
                var texts = document.querySelector("#avatarInput").value;
                var teststr = texts; //你这里的路径写错了
                testend = teststr.match(/[^\\]+\.[^\(]+/i); //直接完整文件名的
                filename.innerHTML = testend;
            }

        });

        $(".avatar-save").on("click", function() {
            var img_lg = document.getElementById('imageHead');
            // 截图小的显示框内的内容
            html2canvas(img_lg, {
                allowTaint: true,
                taintTest: false,
                onrendered: function(canvas) {
                    canvas.id = "mycanvas";
                    //生成base64图片数据
                    var dataUrl = canvas.toDataURL("image/jpeg");
                    var newImg = document.createElement("img");
                    newImg.src = dataUrl;
                    imagesAjax(dataUrl)
                }
            });
        });

        function imagesAjax(src) {
            var data = {};
            data.img = src;
            data.jid = $('#jid').val();
            data._token = "{{ csrf_token() }}";
            $.ajax({
                url: "{{ route('users.avatar.upload') }}",

                data: data,
                type: "POST",
                dataType: 'json',
                success: function(re) {
                    console.log(re);
                }
            });
        }
    </script>
@endsection