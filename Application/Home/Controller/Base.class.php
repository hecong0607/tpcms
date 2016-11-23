<?php
namespace Home\Controller;

use Think\Controller;

class Base extends Controller
{

    public function _empty()
    {
        $this->noFund();
    }

    protected function noFund()
    {
        layout(false);
        $this->assign('error', '页面未找到！');
        $this->display('Base/error');
    }

}