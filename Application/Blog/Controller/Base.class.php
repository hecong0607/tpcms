<?php
namespace Blog\Controller;

use Think\Controller;

class Base extends Controller
{
    private $layout = array(
        'main' => array('index', 'home'),
        'blog' => array('article', 'section', 'tag'),
    );

    public function __construct()
    {
        parent::__construct();
        $this->setLayouts();
    }

    public function _empty()
    {
        $this->noFund();
    }

    protected function noFund()
    {
        layout(false);
        $this->assign('error', '页面未找到！');
        $this->display('Base/error');
        die;
    }

    /**
     * 设置layout
     */
    private function setLayouts()
    {
        foreach ($this->layout as $k => $v) {
            foreach ($v as $key => $value) {
                if((strcasecmp($value, CONTROLLER_NAME) == 0)){
                    layout('layout/' . $k);
                }
            }
        }
    }

}