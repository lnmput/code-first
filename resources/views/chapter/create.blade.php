@extends('layouts.app')
@section('title', '撰写笔记')
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><h4>新建文章</h4></div>
                <div class="panel-body">
                    <form method="post" enctype="multipart/form-data" action="{{ route('chapter.store') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <div class="form-group">
                            所属微册：<u><a target="_blank" href="{{ route('book.show', $book->id) }}">{{ $book->title }}</a></u>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{ old('title') }}" name="title" required placeholder="标题">
                        </div>
                        <div class="form-group">
                            @foreach($sellTypes as $sellType)
                                <label class="radio-inline">
                                    <input type="radio" name="sell_type" data-code="{{ $sellType['code'] }}" value="{{ $sellType['id'] }}" required > {{ $sellType['cn'] }}
                                </label>
                            @endforeach
                            <p class="help-block free hidden">其他用户可以无条件查看该文章， 与该文章所属微册是否收费无关</p>
                            <p class="help-block flow hidden">如果该文章所属微册收费，则其他用户在订阅该微册后可看， 反之则免费查看</p>
                            <p class="help-block alone hidden">即使该文章所属微册收费，用户还可以通过单独购买该文章查看， 如果用户已经购买过该文章所属微册， 则无需额外付费</p>
                        </div>
                        <div class="form-group">
                            <input id="price" type="number" class="form-control hidden" name="price" min="0.1" step="0.1" placeholder="价格">
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
                        <textarea name="content" placeholder="请开始你的写作">{{ old('content') }}</textarea>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success submit-btn">添加文章</button>
                            <button type="button" class="btn btn-default submit-btn" onclick="history.back();">取消返回</button>
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
        $(function () {
            $("input[name=sell_type]").change(function () {
                var type = $(this).data('code');
                var priceEle = $("#price");
                if (type === 'alone') {
                    priceEle.removeClass('hidden');
                } else {
                    priceEle.addClass('hidden');
                }

                $(".help-block").addClass('hidden');
                $("."+type).removeClass('hidden');
            });
        });

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