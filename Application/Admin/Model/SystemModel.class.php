<?php
namespace Admin\Model;

use Common\Controls\Logic;

class SystemModel extends Logic
{
    public $info = array(
        'system'    => array('key' => '', 'value' => ''),
        'running'   => array('key' => '', 'value' => ''),
        'runType'   => array('key' => '', 'value' => ''),
        'mysql'     => array('key' => '', 'value' => ''),
        'maxUpload' => array('key' => '', 'value' => ''),
        'runTime'   => array('key' => '', 'value' => ''),
        'lastSpace' => array('key' => '', 'value' => ''),
    );


    public function getData()
    {
        S('system', false);
        $system = S('system');
        if ($system == false) {
            $this->info = array(
                'system'    => array('key' => '操作系统', 'value' => php_uname('s'),),
                'running'   => array('key' => '运行环境', 'value' => $_SERVER['SERVER_SOFTWARE'],),
                'runType'   => array('key' => 'PHP运行方式', 'value' => php_sapi_name(),),
                'mysql'     => array('key' => 'MYSQL版本', 'value' => mysql_get_server_info(),),
                'maxUpload' => array('key' => '上传附件限制', 'value' => ini_get('upload_max_filesize'),),
                'runTime'   => array('key' => '执行时间限制', 'value' => ini_get('max_execution_time') . "s",),
                'lastSpace' => array('key' => '剩余空间', 'value' => round((@disk_free_space(".") / (1024 * 1024)), 2) . 'M',),
            );
            S('system', $this->info);
            $this->msg->data = $this->info;
        } else {
            $this->msg->data = $system;
        }
        return $this->msg;
    }
}