<div class="panel panel-default comment-list">
    <div class="panel-heading">
        全部评论
    </div>
    <div class="panel-body">
        @foreach($item->comments as $comment)
            <div class="media">
                <div class="media-left">
                    @if($comment->user->avatar)
                        <div>
                            <img class="user-avatar media-object" src="{{ asset($comment->user->avatar()) }}">
                        </div>
                    @else
                        <div>
                            <p class="thumbnail user-avatar text-info">{{ $comment->user->getFirstWordsFromName() }}</p>
                        </div>
                    @endif
                </div>
                <div class="media-body">
                    <h5 class="media-heading help-block">{{ $comment->user->name }}</h5>
                    {!! $comment->body !!}
                </div>
            </div>
            @if(!$loop->last)
                <hr>
            @endif
        @endforeach
    </div>
</div>