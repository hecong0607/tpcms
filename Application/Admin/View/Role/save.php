<div class="wrap">
    <ul class="nav nav-tabs">
        <li><a href="{:U('Admin/Role/list')}">角色列表</a></li>
        <if condition="empty($data['id'])">
            <li class="active"><a href="javascript:void(0);">角色添加</a></li>
            <else/>
            <li><a href="{:U('Admin/Role/save')}">角色添加</a></li>
            <li class="active"><a href="javascript:void(0);">角色修改</a></li>
        </if>

    </ul>
    <form method="post" class="form-horizontal js-ajax-form" action="{:U('Admin/Role/doSave')}">
        <fieldset>
            <div class="control-group">
                <label class="control-label">角色名称</label>

                <div class="controls">
                    <input type="text" name="name" value="{$data['name']}" id="rolename"/>
                    <span class="form-required">*</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">角色描述</label>

                <div class="controls">
                    <textarea name="remark" rows="2" cols="20" id="remark" class="inputtext"
                              style="height: 100px; width: 500px;">{$data['remark']}</textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">状态</label>

                <div class="controls">
                    <select name="status">
                        <option value="1" <?= $data['status'] == 1 ? 'selected' : ''; ?>>开启</option>
                        <option value="0" <?= $data['status'] === '0' ? 'selected' : ''; ?> >禁用</option>
                    </select>
                </div>
            </div>
        </fieldset>
        <div class="form-actions">
            <input type="hidden" name="id" value="{$data['id']}"/>
            <button type="submit" class="btn btn-primary js-ajax-submit">保存</button>
            <a class="btn" href="{:U('Admin/Role/list')}">返回</a>
        </div>
    </form>
</div>