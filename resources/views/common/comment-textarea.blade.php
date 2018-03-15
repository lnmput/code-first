<form method="post" action="{{ $url }}">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $item->id }}">
    <div class="form-group">
        @guest
            <textarea class="form-control" rows="5" name="body" disabled placeholder="请登录以后发表评论"></textarea>
        @else
            <textarea class="form-control" rows="5" name="body"></textarea>
        @endguest
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success" @guest disabled  @endguest>提交</button>
    </div>
</form>