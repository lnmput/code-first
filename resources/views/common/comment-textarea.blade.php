<div class="alert alert-info">
    <ul class="helpblock list rm-link-color add-link-underline">
        <li>请注意单词拼写，以及中英文排版，<a href="https://github.com/sparanoid/chinese-copywriting-guidelines">参考此页</a></li>
        <li>支持 Markdown 格式, <strong>**粗体**</strong>、~~删除线~~、<code>`单行代码`</code>, 更多语法请见这里 <a href="https://github.com/riku/Markdown-Syntax-CN/blob/master/syntax.md">Markdown 语法</a></li>
    </ul>
</div>
<form method="post" action="{{ $url }}">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $item->id }}">
    <div class="form-group">
        @guest
            <textarea class="form-control" rows="5" name="body" disabled placeholder="请登录以后发表评论"></textarea>
        @else
            <textarea class="form-control" rows="5" name="body" placeholder="使用markdown语法， 注意不要使用大号标题， 影响页面美观的会被删掉"></textarea>
        @endguest
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success" @guest disabled  @endguest>提交</button>
    </div>
</form>