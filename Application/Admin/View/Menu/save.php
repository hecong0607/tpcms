<style>
    .select {
        position: absolute;
        width: 222px;
        list-style: none;
        box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.44);
        -webkit-margin-before: 0em;
        -webkit-margin-after: 0em;
        -webkit-margin-start: 0px;
        -webkit-margin-end: 0px;
        -webkit-padding-start: 0px;
    }

    .select li {
        text-align: left;
        padding: 5px;
        font-family: inherit;
        border-bottom: 1px solid rgba(0, 0, 0, 0.16);
        height: 25px;
        line-height: 25px;
        background-color: rgba(255, 255, 255, 0.8);
        cursor: pointer;
    }
</style>
<div class="wrap">
    <ul class="nav nav-tabs">
        <li><a href="{:U('Admin/Menu/list')}">菜单列表</a></li>
        <if condition="empty($data['id'])">
            <li class="active"><a href="javascript:void(0);">菜单添加</a></li>
            <else/>
            <li><a href="{:U('Admin/Menu/add')}">菜单添加</a></li>
            <li class="active"><a href="javascript:void(0);">菜单编辑</a></li>
        </if>

    </ul>
    <?php $url = empty($data['id'])?U('Admin/Menu/doAdd'):U('Admin/Menu/doSave');?>
    <form method="post" class="form-horizontal js-ajax-form" action="{$url}">
        <fieldset>
            <div class="control-group">
                <label class="control-label">上级：</label>

                <div class="controls">
                    <select name="parent_id">
                        <option vlaue="0">作为一级菜单</option>
                        <foreach name="menu" item="v">
                            <if condition="$v['id']!=$data['id']">
                                <option value="{$v['id']}" <?= $data['parent_id'] == $v['id'] ? 'selected' : ''; ?>>
                                    {$v.left}{$v.menu_name}
                                </option>
                            </if>
                        </foreach>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">菜单名称：</label>

                <div class="controls">
                    <input type="text" name="menu_name" value="{$data['menu_name']}">
                    <span class="form-required">*</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">路由：</label>

                <div class="controls">
                    <input id="route" type="text" name="route" value="{$data['route']}">
                    <span class="form-required">*</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">图标：</label>

                <div class="controls">
                    <input type="text" name="logo" value="{$data['logo']}">
                    <a target="_blank" href="{:U('Admin/Menu/icons')}">选择图标</a>
                    <span> 不带前缀fa-，如fa-user => user</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">备注：</label>

                <div class="controls">
                    <input type="text" name="remark" value="{$data['remark']}">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">类型：</label>

                <div class="controls">
                    <select name="type">
                        <option value="0" <?= $data['type'] == 0 ? 'selected' : ''; ?>>菜单</option>
                        <option value="1" <?= $data['type'] == 1 ? 'selected' : ''; ?>>菜单+权限</option>
                        <option value="2" <?= $data['type'] == 2 ? 'selected' : ''; ?>>权限</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">列表排序：</label>

                <div class="controls">
                    <input type="text" name="list_order" value="{$data['list_order']}">
                </div>
            </div>
        </fieldset>
        <div class="form-actions">
            <input type="hidden" name="id" value="{$data['id']}"/>
            <button type="submit" class="btn btn-primary js-ajax-submit">保存</button>
            <button class="btn js-ajax-close-btn" type="submit">关闭</button>
        </div>
    </form>
    <script>

        $(function () {
            $(".js-ajax-close-btn").on('click', function (e) {
                e.preventDefault();
                Wind.use("artDialog", function () {
                    art.dialog({
                        id: "question",
                        icon: "question",
                        fixed: true,
                        lock: true,
                        background: "#CCCCCC",
                        opacity: 0,
                        content: "您确定需要关闭当前页面嘛？",
                        ok: function () {
                            setCookie('Admin_Menu', 1);
                            window.close();
                            return true;
                        }
                    });
                });
            });
        });
        <?php
            $data = [] ;
            foreach($route as $k=>$v){
                $data[] = $v['route'];
            };
            $words = json_encode($data,false);
        ?>

        $(document).ready(function () {
            var proposalList = $('<ul class="select"></ul>');

            var words = <?= $words;?>;
            var input = $('#route');
            input.bind("change paste keyup", function (e) {
                if (e.which != 13 && e.which != 27
                    && e.which != 38 && e.which != 40) {
                    currentProposals = [];
                    currentSelection = -1;
                    proposalList.empty();
                    if (input.val() != '') {
                        var word = "^" + $('#route').val() + ".*";
                        proposalList.empty();
                        for (var test in words) {
                            if (words[test].match(word)) {
                                var temp = words[test];
                                currentProposals.push(words[test]);
                                var element = $('<li></li>')
                                    .html(words[test])
                                    .click(function () {
                                        input.val($(this).html());
                                        proposalList.empty();
                                    });
                                proposalList.append(element);
                            }
                        }
                    }
                    input.after(proposalList);
                }
            });
        });
    </script>

</div>