<div class="panel-body chapter-list row">
    <div class="col-md-1">
        @if($item->user->avatar)
            <img class="chapter-list-user-avatar" title="{{ $item->user->name }}" src="{{ asset($item->user->avatar()) }}">
        @else
            <div class="text-info" >
                <p class="thumbnail chapter-list-user-avatar">{{ $item->user->getFirstWordsFromName() }}</p>
            </div>
        @endif
    </div>
    <div class="col-md-11">
        <h4 class="chapter-list-title">
            <a href="{{ route('chapter.show', $item->id) }}">{{ $item->title }}</a>
        </h4>
        <span class="help-block">{{ $item->user->name }}</span>
        <div>
            @foreach($item->book->tags as $tag)
                <span class="label label-primary">{{ $tag->name }}</span>
            @endforeach
        </div>
    </div>
</div>
@if(!$loop->last)
    <hr>
@endif