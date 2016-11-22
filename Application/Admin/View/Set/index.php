<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <?php foreach($group as $k=>$v){ ?>
            <li class="<?=($gid==$v['gid'])?'active':'';?>"><a href="{:U('Admin/Set/index',array('gid'=>$v['gid']))}"><?=$v['gname']?></a></li>
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
            <div class="form-actions">
                <input type="hidden" name="gid" value="<?=$gid;?>">
                <button type="submit" class="btn btn-primary  js-ajax-submit">保存</button>
            </div>
        </fieldset>
    </form>
</div>

<link rel="stylesheet" href="__PUBLIC__/Admin/css/index.css">
<script src="__PUBLIC__/Admin/js/index.js"></script>

