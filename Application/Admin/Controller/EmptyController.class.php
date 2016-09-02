<?php
namespace Admin\Controller;

/**
 * 调用不存在的控制器的类
 * Class EmptyController
 * @package Admin\Controller
 */
class EmptyController extends Base
{
    /**
     * 调用本控制器不存在的方法
     */
    public function _empty()
    {
        $this->noFund();
    }
}