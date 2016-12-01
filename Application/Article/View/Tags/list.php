<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li class="active"><a href="javascript:void(0);">标签列表</a></li>
    </ul>
    <form class="well form-search" method="get" action="">
        标签名称：
        <input type="text" name="name" style="width: 200px;" value="{$_GET['name']}" placeholder="请输入标签名称...">
        <input type="submit" class="btn btn-primary" value="搜索">
    </form>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>标签名称</th>
            <th>引用数量</th>
        </tr>
        </thead>
        <?php if(!empty($list)){ ?>
        <foreach name="list" item="value">
            <tr>
                <td>{$value['name']}</td>
                <td><span class="over">{$value['num']}</span></td>
            </tr>
        </foreach>
        <?php } else { ?>
            <tr><td colspan="2" >暂无信息</td></tr>
        <?php } ?>
        <tbody>
        </tbody>
    </table>
    <div class="manu">{$page}</div>
</div>