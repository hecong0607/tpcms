<?php
/* @var $menu array */
?>
<div class="sidebar" id="sidebar">
    <?php function getsubmenu($submenus, \Admin\Model\RoleModel $roleModel, $i)
    {   $i++;
        foreach ($submenus as $menu) {
            $url = $menu['route'];
            if ($roleModel->checkRoleByPower($url)->status) { ?>
                <li>
                    <?php if (empty($menu['items'])) { ?>
                        <a href="javascript:openapp('{:U($url)}','{$menu['menu_name']}','{$menu['menu_name']}',true);">
                            <i class="fa fa-{$menu['logo']|default='desktop'}"></i>&nbsp;
							<span class="menu-text" style="padding-left: <?=$i*10;?>px">
								{$menu['menu_name']}
							</span>
                        </a>
                    <?php } else { ?>
                        <a href="javascript:void(0);" class="dropdown-toggle">
                            <i class="fa fa-{$menu['logo']} normal"></i>&nbsp;
							<span class="menu-text normal" style="padding-left: <?=$i*10;?>px">
								{$menu['menu_name']}
							</span>
                            <b class="arrow fa fa-angle-right normal"></b>
                            <i class="fa fa-reply back"></i>
                            <span class="menu-text back">返回</span>
                        </a>
                        <ul class="submenu">
                            <?php getsubmenu($menu['items'], $roleModel, $i); ?>
                        </ul>
                    <?php } ?>
                </li>
            <?php }
        }
    } ?>

    <div id="nav_wraper" style="height: 907px; overflow: auto;">
        <ul class="nav nav-list">
            <?php $roleModel = new \Admin\Model\RoleModel();
            $i = -1;
            getsubmenu($menu, $roleModel, $i); ?>
        </ul>
    </div>

</div>