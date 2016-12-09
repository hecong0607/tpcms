<link rel="stylesheet" type="text/css" href="__PUBLIC__/Editor/dist/css/wangEditor.min.css">

<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li><a href="{:U('Article/Section/listAdmin')}">栏目列表</a>
            <if condition="empty($data['id'])">
                <li class="active"><a href="javascript:void(0);">栏目添加</a></li>
                <else/>
                <li><a href="{:U('Article/Section/add')}">栏目添加</a></li>
                <li class="active"><a href="javascript:void(0);">栏目修改</a></li>
            </if>
    </ul>
    <?php $url = empty($data['id']) ? U('Article/Section/doAdd') : U('Article/Section/doSave'); ?>
    <form action="{$url}" method="post" class="form-horizontal js-ajax-form" enctype="multipart/form-data">
        <div class="row-fluid">
            <div class="span9">
                <table class="table table-bordered">
                    <tr>
                        <th width="80">上级</th>
                        <td>
                            <select name="parent_id">
                                <option vlaue="0">作为一级栏目</option>
                                <foreach name="sections" item="v">
                                    <option value="{$v['id']}" <?= $data['parent_id'] == $v['id'] ? 'selected' : ''; ?>>
                                        {$v.left}{$v.name}
                                    </option>
                                </foreach>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th width="80">栏目名称</th>
                        <td>
                            <input type="text" style="width: 400px;" name="title" id="title" value="{$data['name']}" placeholder="请输入栏目名称"/>
                            <span class="form-required">*</span>
                        </td>
                    </tr>
                    <tr>
                        <th>内容</th>
                        <td>
                            <textarea name="content" id="content" style="width: 100%;height: 500px;">{$data['content']}</textarea>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="span3">
                <table class="table table-bordered">
                    <tr >
                        <th colspan="2">封面(960*540)</th>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div style="text-align: center;">
                                <input type="hidden" name="face" id="face" value="{$data['face']}">
                                <input type="hidden" name="thumb" id="thumb" value="{$data['thumb']}">
                                <a href="javascript:void(0);" onclick="$('#file').click();">
                                    <img src="{$data['face']|default='__PUBLIC__/admin/assets/images/default-thumbnail.png'}" id="thumb_preview" width="135" style="cursor: hand"/>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>发布</th>
                        <td><select name="status">
                                <option value="1" <?=($data['status']==1)?'selected':''?>>发布</option>
                                <option value="0" <?=($data['status']!=1)?'selected':''?>>待发布</option>
                            </select></td>
                    </tr>
                    <tr>
                        <th>排序</th>
                        <td>  <input type="text" style="width: 400px;" name="list_order" id="list_order" value="{$data['list_order']}" /></td>
                    </tr>
                    <tr>
                        <th>类型</th>
                        <td><select name="type">
                                <option value="1" <?=($data['type']==1)?'selected':''?>>图片</option>
                                <option value="0" <?=($data['type']!=1)?'selected':''?>>文章</option>
                            </select></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="form-actions">
            <input type="hidden" name="id" value="{$data['id']}">
            <button class="btn btn-primary js-ajax-submit" type="submit">保存</button>
            <a class="btn" href="{:U('Article/Section/listAdmin')}">返回</a>
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
        editor.config.menus = ['source', '|', 'bold', 'underline', 'italic', 'strikethrough', 'eraser', 'forecolor', 'bgcolor', '|', 'quote', 'fontfamily', 'fontsize', 'head', 'unorderlist', 'orderlist', 'alignleft', 'aligncenter', 'alignright', '|', 'link', 'unlink', 'table', '|', 'img', 'video', '|', 'undo', 'redo', 'fullscreen'];//'location','emotion',
        editor.create();
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
                if(data.status==1) {
                    $('#thumb_preview').attr('src', json.url);
                    $('#face').val(json.url);
                    $('#thumb').val(json.thumb);
                } else {
                    alert(json.msg);
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
</script>
