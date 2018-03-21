<div class="panel panel-default book-list">
    <div class="panel-heading">
        @if($book->user->avatar)
            <div  style="display: inline-block;">
                <img class="book-list-user-avatar" title="{{ $book->user->name }}" src="{{ asset($book->user->avatar()) }}">
            </div>
        @else
            <div class="text-info" style="display: inline-block;">
                <p class="thumbnail book-list-user-avatar">{{ $book->user->getFirstWordsFromName() }}</p>
            </div>
        @endif
        <h2 style="display: inline-table; font-size: 22px; margin: 0;"><a style="color: inherit" href="{{ route('book.show', $book->id) }}">{{ $book->title }}</a></h2>
    </div>
    <div class="panel-body row">
        <div class="col-md-1">
            <img class="book-list-thumb" src="{{ asset($book->tags->first()->thumb) }}">
        </div>
        <div class="col-md-11">
            <div class="tags">
                @foreach($book->tags as $tag)
                    <span class="label label-primary">{{ $tag->name }}</span>
                @endforeach
            </div>
            <div class="help-block">
                <span>文章数：{{ $book->chapters_count }}</span>
                <span>订阅数：0</span>
                <span>喜欢数：{{ $book->likes_count }}</span>
            </div>
            <div class="help-block">
                <span>更新时间：{{ $book->updated_at }}</span>
            </div>
            <a class="btn btn-success btn-sm">
                @if($book->price)
                    {{ $book->price() }}
                @else
                    免费
                @endif
                订阅
            </a>
        </div>
    </div>
</div>