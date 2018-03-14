<div class="panel panel-default book-list">
    <div class="panel-heading">
        <h4><a href="{{ route('book.show', $book->id) }}">{{ $book->title }}</a></h4>
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
                <span>文章数：{{ $book->chapters->count() }}</span>
                <span>订阅数：{{ $book->chapters->count() }}</span>
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