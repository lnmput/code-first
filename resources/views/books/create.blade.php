@extends('layouts.app')
@section('title', '新建专栏')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <link href="http://cdn.bootcss.com/select2/4.0.2/css/select2.css" rel="stylesheet"/>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><h4>创建微册</h4></div>
                <div class="panel-body">
                    <form method="post" enctype="multipart/form-data" action="{{ route('book.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" required placeholder="标题">
                        </div>
                        <div class="form-group">
                            <input type="number" min="0" class="form-control" name="price"
                                   placeholder="定价，如果不填写将以免费的形式发布">
                        </div>
                        <div class="form-group">
                            <select id="sel_tags" multiple="multiple" name="tags[]" class="form-control"
                                    data-placeholder="话题选择" required>
                                <optgroup label="选择标签">
                                    @foreach($tags as $id => $tag)
                                        <option value="{{ $id }}">{{ $tag }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>专栏封面</label>
                            <input type="file" name="thumb" required>
                            <p class="help-block">请上传长宽比4/3比例的图片.格式限制 - jpg, png, gif</p>
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
                        <textarea name="profile" placeholder="这里请介绍你的专栏内容, 写作计划, 更新进度, 答疑情况等内容"></textarea>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success submit-btn">创建微册</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="http://cdn.bootcss.com/select2/4.0.2/js/select2.js"></script>
    <script src="https://cdn.bootcss.com/select2/4.0.3/js/i18n/zh-CN.js"></script>
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script>
        $(function () {
            $("#sel_tags").select2({
                tags: true,
                maximumSelectionLength: 3
            });
        });

        new SimpleMDE({
            spellChecker: false,
            autosave: {
                enabled: true,
                delay: 5000,
                unique_id: "book_content" + "{{ time() }}"
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
                    title: "创建微册"
                }
            ]
        });

    </script>
@endsection