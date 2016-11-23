<?php
namespace Home\Controller;
class TagController extends Base
{
    public function _empty($name){
        $name1 = C('ACTION_SUFFIX');
        $len = strlen($name)-strlen($name1);
        $name = mb_substr($name, 0,$len,'utf-8');
        $this->tags($name);
    }

    /**
     *
     */
    protected function tags($name){
//        var_dump($name);
        $this->display('tags');

    }
}