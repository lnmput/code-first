<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">关键词筛选</div>
        <div class="panel-body tags">

            @foreach($tags as $key => $tag)

                <a href="{{ $key }}">{{ $tag }}</a>
            @endforeach


        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">优秀推荐</div>

        <div class="panel-body">

            <div class="media">
                <div class="media-left media-middle">
                    <a href="#">
                        <img class="media-object right-list-image" src="{{ asset('images/list-image.jpg') }}" alt="">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Middle aligned media</h4>
                    ...
                </div>
            </div>

            <div class="media">
                <div class="media-left media-middle">
                    <a href="#">
                        <img class="media-object right-list-image" src="{{ asset('images/list-image.jpg') }}" alt="">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Middle aligned media</h4>
                    ...
                </div>
            </div>

            <div class="media">
                <div class="media-left media-middle">
                    <a href="#">
                        <img class="media-object right-list-image" src="{{ asset('images/list-image.jpg') }}" alt="">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Middle aligned media</h4>
                    ...
                </div>
            </div>

        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">免费订阅</div>

        <div class="panel-body">



        </div>
    </div>
</div><?php
/**
 * Created by PhpStorm.
 * User: yangzie
 * Date: 2018/3/8
 * Time: 23:07
 */