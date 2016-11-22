<?php
namespace Admin\Controller;

use Admin\Model\ConfigGroupModel;
use Admin\Model\ConfigModel;

class SetController extends Base
{
    public function IndexAction(){
        $gid = (int)I('gid',2);
        $group = new ConfigGroupModel();
        $data = $group->getDataById($gid);
        $groupData = $group->getDataAll();
        if(empty($data)){
            $html = null;
        } else{
            $config = new ConfigModel();
            $html = $config->getData($gid);
        }
        $this->assign('gid',$gid);
        $this->assign('group',$groupData);
        $this->assign('html',$html);
        $this->display('index');
    }

    public function _empty($name){

        parent::_empty();
    }

    public function UpdateAction(){
        $option = I('post.options');
        $gid = (int)I('post.gid',2);
        $config = new ConfigModel();
        foreach($option as $key=>$value){
            $config->updateDataByName($key,$value);
        }
        $this->success('保存成功！', U('Admin/Set/Index',array('gid'=>$gid)));
    }

}