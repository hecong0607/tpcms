<?php
$dir = __DIR__;
$config_local_file = $dir . "/config-local.php";
if (file_exists($config_local_file)) {
    $config_local = include $config_local_file;
} else {
    $config_local = array();
}

$config = array(
    //'配置项'=>'配置值'
    'MODULE_ALLOW_LIST'    => array('Home', 'Admin','Article'),   //允许访问模块
    'DEFAULT_MODULE'       => 'Home',   //默认模块
    'ACTION_SUFFIX'        => 'Action', // 操作方法后缀
    'URL_MODEL'            => 2,
    'TMPL_TEMPLATE_SUFFIX' => '.php',     // 默认模板文件后缀
//	'SESSION_OPTIONS' =>array(
//		'expire'=>7200,
//	),
);


return array_merge($config, $config_local);