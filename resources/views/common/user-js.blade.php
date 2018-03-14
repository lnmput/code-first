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
                var teststr = texts;
                testend = teststr.match(/[^\\]+\.[^\(]+/i);
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
                url: "{{ route('user.avatar.upload') }}",

                data: data,
                type: "POST",
                dataType: 'json',
                success: function(re) {
                    windows.localtion.reload();
                }
            });
        }
    </script>
@endsection