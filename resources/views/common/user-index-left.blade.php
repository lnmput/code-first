<div class="col-md-3">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="media block">
                <div class="media-left">
                    @include('common.avatar-upload')
                </div>
                <div class="media-body">
                    <h4 class="media-heading user-name">{{ $user->name }}</h4>
                    @if($user->sex == 1)
                        <i class="fa fa-mars user-sex" aria-hidden="true"></i>
                    @elseif($user->sex == 2)
                        <i class="fa fa-venus user-sex" aria-hidden="true"></i>
                    @else
                        <i class="fa fa-question-circle-o user-sex" aria-hidden="true"></i>
                    @endif
                </div>
            </div>
            <div>
                <p>{{ $user->profile }}</p>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="user-info row">
                <div class="col-md-4">
                    <span>{{ $user->books->count() }}</span>
                    <a>微册</a>
                </div>
                <div class="col-md-4">
                    <span>{{ $user->chapters->count() }}</span>
                    <a>文章</a>
                </div>
                <div class="col-md-4">
                    <span>0</span>
                    <a>喜欢</a>
                </div>
            </div>
            <hr>
            
            <a href="{{ route('book.create') }}" class="btn btn-success btn-sm btn-block">创建新专栏</a>

            @me($user->id)
                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-danger btn-sm btn-block">编辑个人资料</a>
            @endme

            <a href="{{ route('user.index', $user->id) }}" class="btn btn-primary btn-sm btn-block">个人中心首页</a>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <ul class="list-group user-link-list">
                <a href="{{ route('user.books.buy', $user->id) }}">
                    <li class="list-group-item"><i class="text-md fa fa-headphones"></i> Ta 订阅的微册</li>
                </a>

                <a href="{{ route('user.chapters.buy', $user->id) }}">
                    <li class="list-group-item"><i class="text-md fa fa-headphones"></i> Ta 购买的文章</li>
                </a>

                <a href="{{ route('user.books', $user->id) }}">
                    <li class="list-group-item"><i class="text-md fa fa-list-ul"></i> Ta 发布的微册</li>
                </a>

                <a href="{{ route('user.chapters', $user->id) }}">
                    <li class="list-group-item"><i class="text-md fa fa-comment"></i> Ta 撰写的文章</li>
                </a>

                <a href="{{ route('user.books.like', $user->id) }}">
                    <li class="list-group-item"><i class="text-md fa fa-eye"></i> Ta 喜欢的微册</li>
                </a>

                <a href="{{ route('user.chapters.like', $user->id) }}">
                    <li class="list-group-item"><i class="text-md fa fa-eye"></i> Ta 喜欢的文章</li>
                </a>
            </ul>
        </div>
    </div>
</div>