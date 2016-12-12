<style type="text/css">
    span img{max-height: 40px;  margin: 0 20px;}
</style>
<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <?php foreach ($group as $k => $v) { ?>
            <li class="<?= ($gid == $v['gid']) ? 'active' : ''; ?>"><a href="{:U('Admin/Set/index',array('gid'=>$v['gid']))}"><?= $v['gname'] ?></a>
            </li>
        <?php } ?>
    </ul>
    <form class="form-horizontal js-ajax-form" action="{:U('Admin/Set/Update')}" method="post">
        <fieldset>

            <div class="tabbable">
                <div class="tab-content">
                    <div class="tab-pane active" id="A">
                        <fieldset>
                            {$html}
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <input type="hidden" name="gid" value="<?=$gid;?>">
                <button type="submit" class="btn btn-primary  js-ajax-submit">保存</button>
            </div>
        </fieldset>
    </form>
</div>
<form id="image" style="display: none;">
    <input type="file" id="file" name="face" onchange="doUpload();">
</form>
<link rel="stylesheet" href="__PUBLIC__/admin/css/index.css">
<script src="__PUBLIC__/admin/js/index.js"></script>
<script type="text/javascript">
    var file_id = '';
    $('.btn.btn-primary.file').on('click',function(e){
        var id = $(this).siblings('input').attr('id');
        file_id = id;
        $('#file').click();
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
                    $('#' + file_id).val(json.url);
                    var img = '<img scr="'+json.url+'">';
                    $('#img_' + file_id).find('img').attr('src',json.url);
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

