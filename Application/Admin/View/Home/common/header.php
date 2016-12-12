<div id="loading" style="display: none;"><i class="loadingicon"></i><span>正在加载...</span></div>
<div id="right_tools_wrapper">
	<span id="right_tools_clearcache" title="刷新配置缓存"
          onclick="javascript:openapp('{:U('Set/refreshData')}','right_tool_clearcache','刷新配置缓存');">
		<i class="fa fa-trash-o right_tool_icon"></i>
	</span>
	<span id="refresh_wrapper" title="刷新">
		<i class="fa fa-refresh right_tool_icon"></i>
	</span>
</div>
<div class="navbar">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a href="{:U('Home/index')}" class="brand">
                <small>
                    <img src="__PUBLIC__/admin/images/logo-18.png">
                    <span>CMS</span>
                </small>
            </a>

            <div class="pull-left nav_shortcuts">
                <a class="btn btn-small btn-warning" href="/" title="网站首页" target="_blank">
                    <i class="fa fa-home"></i>
                </a>
                <a class="btn btn-small btn-success"
                   href="javascript:openapp('/index.php?g=portal&m=AdminTerm&a=index','index_termlist','分类管理');"
                   title="分类管理">
                    <i class="fa fa-th"></i>
                </a>
                <a class="btn btn-small btn-info"
                   href="javascript:openapp('/index.php?g=portal&m=AdminPost&a=index','index_postlist','文章管理');"
                   title="文章管理">
                    <i class="fa fa-pencil"></i>
                </a>
                <a class="btn btn-small btn-danger"
                   href="javascript:openapp('/index.php?g=admin&m=setting&a=clearcache','index_clearcache','清除缓存');"
                   title="清除缓存">
                    <i class="fa fa-trash-o"></i>
                </a>
            </div>
            <ul class="nav simplewind-nav pull-right">

                <li class="light-blue">
                    <a data-toggle="dropdown" href="{:U('Home/main')}#" class="dropdown-toggle">
                        <img class="nav-user-photo" width="30" height="30" src="__PUBLIC__/admin/images/logo-18.png"
                             alt="admin">
                        <span class="user-info">欢迎, {:session('admin')['username']}</span>
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
                        <li><a href="javascript:openapp('{:U('Home/main')}','index_site','网站信息');">
                                <i class="fa fa-cog"></i> 网站信息</a>
                        </li>
                        <li><a href="javascript:openapp('{:U('Home/main')}','index_userinfo','修改信息');">
                                <i class="fa fa-user"></i> 修改信息</a>
                        </li>
                        <li><a href="{:U('Public/logout')}">
                                <i class="fa fa-sign-out"></i> 退出</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>