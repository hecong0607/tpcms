<?php
$dir = __DIR__;
$config_local_file = $dir . "/config-local.php";
if (file_exists($config_local_file)) {
    $config_local = include $config_local_file;
} else {
    $config_local = array();
}

$config = array(
    'LAYOUT_ON'           => true,
    'LAYOUT_NAME'         => 'Layout/main',

    'DATA_CACHE_TIME'     => 7200,      // 数据缓存有效期 0表示永久缓存
    'DATA_CACHE_COMPRESS' => false,   // 数据缓存是否压缩缓存
    'DATA_CACHE_CHECK'    => false,   // 数据缓存是否校验缓存
    'DATA_CACHE_PREFIX'   => '',     // 缓存前缀
    'DATA_CACHE_TYPE'     => 'File',  // 数据缓存类型,支持:File|Db|Apc|Memcache|Shmop|Sqlite|Xcache|Apachenote|Eaccelerator
    'DATA_CACHE_PATH'     => TEMP_PATH,// 缓存路径设置 (仅对File方式缓存有效)
    'DATA_CACHE_SUBDIR'   => false,    // 使用子目录缓存 (自动根据缓存标识的哈希创建子目录)
    'DATA_PATH_LEVEL'     => 1,        // 子目录缓存级别

    'URL_ADMIN_HOME'      => U('Admin/Home/index'),
    'URL_ADMIN_LOGIN'     => U('Admin/Public/login'),
    'param'               => array(
        'allowActions'      => array(        //直接开放的路由，不用管登录
            '/Admin/Public/login',
            '/Admin/Public/doLogin',
            '/Admin/Public/verify',
            '/Admin/Public/logout',
        ),
        'allowAdminActions' => array(
            '/Admin/Home/index',
            '/Admin/Home/main',
        ),
        'adminModules' => array(
            'Admin',
            'Article',
        ),
    ),
);
return array_merge($config, $config_local);