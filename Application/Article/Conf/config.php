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
    'FACE'                => array(
        'PATH'  =>  '/Public/images/face/',
        'ROOT' => __ROOT__.'/Public/images/face/',
    ),
    'THUMB'                => array(
        'PATH'  =>  '/Public/images/thumb/',
        'ROOT' => __ROOT__.'/Public/images/thumb/',
    ),
);
return array_merge($config, $config_local);