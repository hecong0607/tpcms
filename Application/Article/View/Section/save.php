<link rel="stylesheet" type="text/css" href="__PUBLIC__/Editor/dist/css/wangEditor.min.css">

<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li><a href="{:U('Article/Section/list')}">栏目列表</a>
        <if condition="empty($data['id'])">
            <li class="active"><a href="javascript:void(0);">栏目添加</a></li>
            <else/>
            <li><a href="{:U('Article/Section/add')}">栏目添加</a></li>
            <li class="active"><a href="javascript:void(0);">栏目修改</a></li>
        </if>
    </ul>
    <?php $url = empty($data['id'])?U('Article/Section/doAdd'):U('Article/Section/doSave');?>
    <form action="{$url}" method="post" class="form-horizontal js-ajax-forms" enctype="multipart/form-data">
        <div class="row-fluid">
            <div class="span9">
                <table class="table table-bordered">
                    <tr>
                        <th width="80">栏目</th>
                        <td>
                            <input type="text" style="width: 400px;" name="title" id="title" value="{$data['name']}" placeholder="请输入标题"/>
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
        </div>
        <div class="form-actions">
            <input type="hidden" name="id" value="{$data['id']}">
            <button class="btn btn-primary js-ajax-submit" type="submit">保存</button>
            <a class="btn" href="{:U('Article/Section/list')}">返回</a>
        </div>
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
