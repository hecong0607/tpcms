<div class="sidebar" id="sidebar">
	<!-- <div class="sidebar-shortcuts" id="sidebar-shortcuts">
	</div> -->
	<?php function getsubmenu($submenus, \Admin\Model\RoleModel $roleModel) {
		foreach ($submenus as $menu) {
			$url = $menu['module'] . '/' . $menu['controller'] . '/' . $menu['action'];
			$name = '/' . $menu['module'] . '/' . $menu['controller'] . '/' . $menu['action'];
			if ($roleModel->checkRoleByPower($name)->status) { ?>
				<li>
					<?php if (empty($menu['items'])) { ?>
						<a href="javascript:void(0);">
							<i class="fa fa-{$menu['logo']|default='desktop'}"></i>
							<span class="menu-text">
								{$menu['menu_name']}
							</span>
						</a>
					<?php } else { ?>
						<a href="javascript:void(0);" class="dropdown-toggle">
							<i class="fa fa-{$menu['logo']|default='desktop'} normal"></i>&nbsp;
							<span class="menu-text normal">
								{$menu['menu_name']}
							</span>
							<b class="arrow fa fa-angle-right normal"></b>
							<i class="fa fa-reply back"></i>
							<span class="menu-text back">返回</span>
						</a>
						<ul class="submenu">
							<?php getsubmenu1($menu['items'], $roleModel); ?>
						</ul>
					<?php } ?>
				</li>
			<?php }
		}
	}

	function getsubmenu1($submenus, \Admin\Model\RoleModel $roleModel) {
		foreach ($submenus as $menu) {
			$url = $menu['module'] . '/' . $menu['controller'] . '/' . $menu['action'];
			$name ='/' .  $menu['module'] . '/' . $menu['controller'] . '/' . $menu['action'];
			if ($roleModel->checkRoleByPower($name)->status) { ?>
				<li>
					<?php if (empty($menu['items'])) { ?>
						<a href="javascript:void(0);">
							<i class="fa fa-caret-right"></i>
							<span class="menu-text">
								{$menu['menu_name']}
							</span>
						</a>
					<?php } else { ?>
						<a href="javascript:void(0);" class="dropdown-toggle">
							<i class="fa fa-caret-right"></i>&nbsp;
							<span class="menu-text">
								{$menu['menu_name']}
							</span>
							<b class="arrow fa fa-angle-right"></b>
						</a>
						<ul class="submenu">
							<?php getsubmenu2($menu['items'], $roleModel); ?>
						</ul>
					<?php } ?>
				</li>
			<?php }
		}
	}

	function getsubmenu2($submenus, \Admin\Model\RoleModel $roleModel) {
		foreach ($submenus as $menu) {
			$url = $menu['module'] . '/' . $menu['controller'] . '/' . $menu['action'];
			$name = '/' . $menu['module'] . '/' . $menu['controller'] . '/' . $menu['action'];
			if ($roleModel->checkRoleByPower($name)->status) { ?>
				<li>
					<a href="javascript:openapp('{:U($url)}','{$name}','{$menu['menu_name']}',true);">
						<i class="fa fa-angle-double-right"></i>
						&nbsp;<span class="menu-text">
					{$menu['menu_name']}
				</span>
					</a>
				</li>
			<?php }
		}
	} ?>

	<div id="nav_wraper" style="height: 907px; overflow: auto;">
		<ul class="nav nav-list">
			<?php  $roleModel = new \Admin\Model\RoleModel();
			getsubmenu($menu, $roleModel); ?>
		</ul>
	</div>

</div>