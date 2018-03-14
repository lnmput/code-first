@inject('CommonPresenter','App\Presenters\CommonPresenter')
<div class="panel panel-default like">
    <div class="panel-body">
        <a href="javascript:void(0)" class="btn btn-danger like-btn" data-request-url="{{ $url }}" data-request-id="{{ $item->id }}"><i class="fa fa-heart" aria-hidden="true"></i> 喜欢 </a>
        <div class="like-avatar-list">
            @if($item->likes->count())
                @foreach($item->likes as $like)
                    @if(!empty($like->user->id))
                        @if($like->user->avatar)
                            <div class="text-info animated">
                                <a href="{{ route('user.index', $like->user->id) }}"><img class="user-avatar thumbnail" src="{{ asset($like->user->avatar()) }}"></a>
                            </div>
                        @else
                            <div class="text-info not-image animated">
                                <p class="user-avatar thumbnail"><a href="{{ route('user.index', $like->user->id) }}">{{ $like->user->getFirstWordsFromName() }}</a></p>
                            </div>


                        @endif
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</div>