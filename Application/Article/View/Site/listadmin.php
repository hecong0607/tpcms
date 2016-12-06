<style>
    .over {
        width: 500px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: block;
    }
    .thumb{width: 50px;height: auto;max-height: 50px;}
</style>
<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li class="active"><a href="javascript:void(0);">文章列表</a></li>
    </ul>
    <form class="well form-search" method="get" action="">
        标题：
        <input type="text" name="title" style="width: 200px;" value="{$_GET['title']}" placeholder="请输入标题...">
        编辑者帐号：
        <input type="text" name="editor" style="width: 200px;" value="{$_GET['editor']}" placeholder="请输入编辑者...">
        时间：
        <input type="text" name="start_time" class="js-date date" value="{$_GET['start_time']}" style="width: 80px;" autocomplete="off">-
        <input type="text" class="js-date date" name="end_time" value="{$_GET['end_time']}" style="width: 80px;" autocomplete="off"> &nbsp; &nbsp;
        <input type="submit" class="btn btn-primary" value="搜索">
    </form>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>文章名称</th>
            <th width="50">封面</th>
            <th width="300">摘要</th>
            <th width="60">发布</th>
            <th width="60">热门</th>
            <th width="60">推荐</th>
            <th width="120">编辑人</th>
            <th width="60">审核状态</th>
            <th width="120">创建时间</th>
            <th width="180">操作</th>
        </tr>
        </thead>
        <?php if(!empty($list)){ ?>
        <foreach name="list" item="value">
            <tr>
                <td>{$value['title']}</td>
                <td><img class="thumb"  src="{$value['thumb']}"></td>
                <td><span class="over">{$value['summary']}</span></td>
                <td>
                    <if condition="$value['status'] eq 1">
                        <font color="red">√</font>
                        <else/>
                        <font color="red">╳</font>
                    </if>
                </td>
                <td>
                    <if condition="$value['popular'] eq 1">
                        <font color="red">√</font>
                        <else/>
                        <font color="red">╳</font>
                    </if>
                </td>
                <td>
                    <if condition="$value['recommend'] eq 1">
                        <font color="red">√</font>
                        <else/>
                        <font color="red">╳</font>
                    </if>
                </td>
                <td>{$value['realname']}({$value['username']})</td>
                <td><?php if($value['flag'] == Article\Model\ArticleModel::Pended){
                        echo '通过';
                     } elseif($value['flag'] == Article\Model\ArticleModel::PendingEdited) {
                        echo '已修改';
                     } else {
                        echo '待修改';
                     } ?></td>
                <td><?= date('Y-m-d H:i', $value['create_time']); ?></td>
                <td>
                    <a href="{:U('/Articles/'.$value['id'])}" target="_blank">查看</a> |
                    <a href="{:U('Article/Site/setPopular',array('id'=>$value['id']))}"><?= empty($value['popular'])?'设为':'取消';?>热门</a> |
                    <a href="{:U('Article/Site/setRecommend',array('id'=>$value['id']))}"><?= empty($value['recommend'])?'设为':'取消';?>推荐</a> |
                    <?php if ($value['flag'] == Article\Model\ArticleModel::Pended) { ?>
                        <a href="{:U('Article/Site/setPend',array('id'=>$value['id'],'flag'=>Article\\Model\\ArticleModel::PendingEditing))}">设为未通过</a>
                    <?php } else { ?>
                        <a href="{:U('Article/Site/setPend',array('id'=>$value['id'],'flag'=>Article\\Model\\ArticleModel::Pended))}">设为通过</a>
                    <?php } ?>
                </td>
            </tr>
        </foreach>
        <?php } else { ?>
            <tr><td colspan="6" >暂无信息</td></tr>
        <?php } ?>
        <tbody>
        </tbody>
    </table>
    <div class="manu">{$page}</div>
</div>