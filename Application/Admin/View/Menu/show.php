<div class="wrap">
    <ul class="nav nav-tabs">
        <li><a href="{:U('Admin/Menu/list')}">菜单列表</a></li>
        <li><a href="{:U('Admin/Menu/save')}">菜单添加</a></li>
        <li class="active"><a href="javascript:void(0);">菜单详情</a></li>
    </ul>
    <div class="form-horizontal">
        <fieldset>
            <div class="control-group">
                <label class="control-label">上级：</label>

                <div class="controls"><i class="fa fa-{$data['logo']} normal"></i> {$data['parent_id']}</div>
            </div>
            <div class="control-group">
                <label class="control-label">图标-菜单名称：</label>

                <div class="controls"><i class="fa fa-{$data['logo']} normal"></i> {$data['menu_name']}</div>
            </div>
            <div class="control-group">
                <label class="control-label">模块：</label>

                <div class="controls">{$data['module']}</div>
            </div>
            <div class="control-group">
                <label class="control-label">控制器：</label>

                <div class="controls">{$data['controller']}</div>
            </div>
            <div class="control-group">
                <label class="control-label">方法：</label>

                <div class="controls">{$data['action']}</div>
            </div>
            <div class="control-group">
                <label class="control-label">类型：</label>

                <div class="controls">
                    <if condition="$data['type']==1">
                        菜单+权限
                        <else/>
                        菜单
                    </if>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">状态：</label>

                <div class="controls">
                    <if condition="$data['status']==1">
                        显示
                        <else/>
                        隐藏
                    </if>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">排序：</label>

                <div class="controls">{$data['list_order']}</div>
            </div>
            <div class="control-group">
                <label class="control-label">等级：</label>

                <div class="controls">{$data['level']}</div>
            </div>
        </fieldset>
    </div>
</div>