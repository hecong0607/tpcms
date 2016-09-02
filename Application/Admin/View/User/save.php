<div class="wrap">
    <ul class="nav nav-tabs">
        <li><a href="{:U('Admin/User/list')}">管理员列表</a></li>
        <if condition="empty($data['id'])">
            <li class="active"><a href="javascript:void(0);">管理员添加</a></li>
            <else/>
            <li><a href="{:U('Admin/User/save')}">管理员添加</a></li>
            <li class="active"><a href="javascript:void(0);">管理员修改</a></li>
        </if>

    </ul>
    <form method="post" class="form-horizontal js-ajax-form" action="{:U('Admin/User/doSave')}">
        <fieldset>
            <div class="control-group">
                <label class="control-label">用户名：</label>

                <div class="controls">
                    <input type="text" name="username" value="{$data['username']}" id="username"/>
                    <span class="form-required">*</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">密码：</label>

                <div class="controls">
                    <input type="password" name="password" placeholder="**********" id="password"/>
                    <span class="form-required">*</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">电话：</label>

                <div class="controls">
                    <input type="text" name="phone" value="{$data['phone']}" id="phone"/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">邮箱：</label>

                <div class="controls">
                    <input type="text" name="email" value="{$data['email']}" id="email"/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">角色：</label>

                <div class="controls">
                    <select name="role">
                        <foreach name="roleData" item="v">
                            <option value="{$v['id']}" <?= $data['role'] == $v['id'] ? 'selected' : ''; ?>>{$v.name}
                            </option>
                        </foreach>
                    </select>
                </div>
            </div>
        </fieldset>
        <div class="form-actions">
            <input type="hidden" name="id" value="{$data['id']}"/>
            <button type="submit" class="btn btn-primary js-ajax-submit">保存</button>
            <a class="btn" href="{:U('Admin/User/list')}">返回</a>
        </div>
    </form>
</div>