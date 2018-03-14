@if($user->avatar)
    <div class="user-avatar-box">
        <img title="修改头像" class="user-avatar thumbnail" data-toggle="modal" data-target="#avatar-modal" src="{{ asset($user->avatar()) }}">
    </div>
@else
    <span class="duke-pulse patch-hint"></span>
    <div title="修改头像" class="user-avatar-box text-info"  data-toggle="modal" data-target="#avatar-modal">
        <p class="thumbnail user-avatar">{{ $user->getFirstWordsFromName() }}</p>
    </div>
@endif

<div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="avatar-form">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" type="button">&times;</button>
                    <h4 class="modal-title" id="avatar-modal-label">修改头像</h4>
                </div>
                <div class="modal-body">
                    <div class="avatar-body">
                        <div class="avatar-upload">
                            <input class="avatar-src" name="avatar_src" type="hidden">
                            <input class="avatar-data" name="avatar_data" type="hidden">
                            <button class="btn btn-primary btn-sm pull-left" onClick="$('input[id=avatarInput]').click();">请选择头像</button>
                            <span id="avatar-name"></span>
                            <input class="avatar-input hide" id="avatarInput" name="avatar_file" type="file"></div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="avatar-wrapper"></div>
                            </div>
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg" id="imageHead"></div>
                                <div class="avatar-preview preview-md"></div>
                                <div class="avatar-preview preview-sm"></div>
                            </div>
                        </div>
                        <div class="row avatar-btns">
                            <div class="col-md-4">
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-sm fa fa-undo" type="button" data-method="rotate" data-option="-90">向左旋转</button>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-sm fa fa-repeat" type="button" data-method="rotate" data-option="90"> 向右旋转</button>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <button class="btn btn-primary btn-sm fa fa-arrows" data-method="setDragMode" data-option="move" type="button" title="移动">
								<span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;setDragMode&quot;, &quot;move&quot;)">
								</span>
                                </button>
                                <button type="button" class="btn btn-primary btn-sm fa fa-search-plus" data-method="zoom" data-option="0.1" title="放大图片">
								<span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;zoom&quot;, 0.1)">
								</span>
                                </button>
                                <button type="button" class="btn btn-primary btn-sm fa fa-search-minus" data-method="zoom" data-option="-0.1" title="缩小图片">
								<span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;zoom&quot;, -0.1)">
								</span>
                                </button>
                                <button type="button" class="btn btn-primary btn-sm fa fa-refresh" data-method="reset" title="重置图片">
									<span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;reset&quot;)" aria-describedby="tooltip866214">
                                    </span>
                                </button>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-success fa fa-save avatar-save" type="button" data-dismiss="modal">保存修改 </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>