<link rel="stylesheet" type="text/css" href="__PUBLIC__/Editor/dist/css/wangEditor.min.css">

<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li><a href="{:U('Article/Site/list')}">文章列表</a>
        <if condition="empty($data['id'])">
            <li class="active"><a href="javascript:void(0);">文章添加</a></li>
            <else/>
            <li><a href="{:U('Article/Site/add')}">文章添加</a></li>
            <li class="active"><a href="javascript:void(0);">文章修改</a></li>
        </if>
        <li class="active"><a href="javascript:void(0);">文章添加</a></li>
    </ul>
    <form action="{:U('Article/Site/doAdd')}" method="post" class="form-horizontal js-ajax-form" enctype="multipart/form-data">
        <input type="hidden" name="post[post_type]" value="2">
        <div class="row-fluid">
            <div class="span9">
                <table class="table table-bordered">
                    <tr>
                        <th width="80">标题</th>
                        <td>
                            <input type="text" style="width: 400px;" name="post[title]" id="title" value="" placeholder="请输入标题"/>
                            <span class="form-required">*</span>
                        </td>
                    </tr>
                    <tr>
                        <th>栏目</th>
                        <td><select name="post[section]">
                                <option value="0">选择栏目</option>
                            </select></td>
                    </tr>
                    <tr>
                        <th>标签</th>
                        <td><input type="text" name="post[tags]" id="tags" value="" style="width: 280px" placeholder="请输入标签"> 多标签之间用“，”隔开</td>
                    </tr>
                    <tr>
                        <th>内容</th>
                        <td>
                            <textarea name="post[content]" id="content" style="width: 100%;height: 500px;"><p>请输入内容...</p></textarea>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="span3">
                <table class="table table-bordered">
                    <tr>
                        <th>封面</th>
                    </tr>
                    <tr>
                        <td>
                            <div style="text-align: center;">
                                <input type="hidden" name="post[face]" id="face" value="">
                                <a href="javascript:void(0);" onclick="$('#file').click();">
                                    <img src="__PUBLIC__/admin/assets/images/default-thumbnail.png" id="thumb_preview" width="135" style="cursor: hand"/>
                                </a>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="form-actions">
            <button class="btn btn-primary js-ajax-submit" type="submit">保存</button>
            <a class="btn" href="{:U('Article/Site/List')}">返回</a>
        </div>
    </form>
    <form id="image" style="display: none;">
        <input type="file" id="file" name="face" onchange="doUpload();">
    </form>
</div>
<script type="text/javascript" src="__PUBLIC__/Editor/dist/js/wangEditor.min.js"></script>
<script type="text/javascript">
    $(function () {
        var editor = new wangEditor('content');
        editor.config.menus = ['source', '|', 'bold', 'underline', 'italic', 'strikethrough', 'eraser', 'forecolor', 'bgcolor', '|', 'quote', 'fontfamily', 'fontsize', 'head', 'unorderlist','orderlist', 'alignleft', 'aligncenter', 'alignright', '|', 'link', 'unlink', 'table',  '|', 'img', 'video', '|', 'undo', 'redo', 'fullscreen'];//'location','emotion',
        editor.create();
    });
</script>
<script type="text/javascript">
    $(function() {

    });

    function doUpload() {
        var formData = new FormData($( "#image" )[0]);
        $.ajax({
            url: "{:U('Article/Face/upload')}" ,
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data){
                var json = eval("(" + data.info + ")");
                $('#thumb_preview').attr('src',json.url);
                $('#face').val(json.url);
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
</script>
