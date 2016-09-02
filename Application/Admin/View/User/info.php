<div class="wrap">
    <ul class="nav nav-tabs">
        <li class="active"><a href="javascript:void(0);">信息修改</a></li>
    </ul>
    <form method="post" class="form-horizontal js-ajax-form" action="{:U('Admin/User/setInfo')}">
        <fieldset>
            <div class="control-group">
                <label class="control-label">昵称：</label>

                <div class="controls">
                    <input type="text" name="realname" value="{$data['realname']}" id="realname"/>
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
                <label class="control-label">qq：</label>

                <div class="controls">
                    <input type="text" name="qq" value="{$data['qq']}" id="qq"/>
                </div>
            </div>
        </fieldset>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary js-ajax-submit">保存</button>
        </div>
    </form>
</div>