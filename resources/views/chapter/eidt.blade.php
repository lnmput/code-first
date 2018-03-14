@extends('layouts.app')
@section('title', '修改笔记')
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><h4>修改笔记</h4></div>
                <div class="panel-body">
                    <form method="post" enctype="multipart/form-data" action="{{ route('chapter.update') }}">
                        {{ csrf_field() }}
                        <input name="id" type="hidden" value="{{ $chapter->id }}">
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" required value="{{ $chapter->title }}" placeholder="标题">
                        </div>
                        <div class="alert alert-warning">
                            <ul>
                                <li>请注意单词拼写，以及中英文排版，<a
                                            href="https://github.com/sparanoid/chinese-copywriting-guidelines">参考此页</a>
                                </li>
                                <li>支持 Markdown 格式, <strong>**粗体**</strong>、~~删除线~~、<code>`单行代码`</code>, 更多语法请见这里 <a
                                            href="https://github.com/riku/Markdown-Syntax-CN/blob/master/syntax.md">Markdown
                                        语法</a></li>
                            </ul>
                        </div>
                        <textarea name="content" placeholder="请开始你的写作">{{ $chapter->content }}</textarea>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success submit-btn">确认修改</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script>
        new SimpleMDE({
            spellChecker: true,
            autosave: {
                enabled: true,
                delay: 5000,
                unique_id: "chapter_content" + "{{ time() }}"
            },
            forceSync: true,
            toolbar: [
                "bold", "italic", "heading", "|", "quote", "code", "table",
                "horizontal-rule", "unordered-list", "ordered-list", "|",
                "link", "image", "|", "side-by-side", 'fullscreen', "|",
                {
                    name: "guide",
                    action: function customFunction(editor) {
                        var win = window.open('https://github.com/riku/Markdown-Syntax-CN/blob/master/syntax.md', '_blank');
                        if (win) {
                            win.focus();
                        } else {
                            alert('Please allow popups for this website');
                        }
                    },
                    className: "fa fa-info-circle",
                    title: "Markdown 语法！"
                },
                {
                    name: "publish",
                    action: function customFunction(editor) {
                        $('.submit-btn').click();
                    },
                    className: "fa fa-paper-plane",
                    title: "发布文章"
                }
            ]
        });

    </script>
@endsection