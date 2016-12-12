<?php
namespace Home\Controller;

use Admin\Model\ConfigModel;
use Think\Controller;

class Base extends Controller
{
    private $layout = array(
        'main' => array('index'),
    );

    public function __construct()
    {
        parent::__construct();
        $this->setLayouts();
        $pageInfo = array(
            'title' => ConfigModel::getDataByName('site_title'),
            'keywords' => ConfigModel::getDataByName('site_keywords'),
            'description' => ConfigModel::getDataByName('site_description'),
            'record' => ConfigModel::getDataByName('site_record'),
            'name' => ConfigModel::getDataByName('site_name'),
        );
        $this->assign('pageInfo', $pageInfo);
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