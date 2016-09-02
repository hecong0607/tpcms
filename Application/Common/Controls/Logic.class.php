<?php
namespace Common\Controls;

/**
 * Class Logic
 * @package Controls\Helps
 * 业务逻辑公用基类
 * 添加了msg成员对象
 */
class Logic
{
    public $msg;

    function __construct()
    {
        //初始化消息类成员
        $this->msg = new Msg();
    }

}