<?php
namespace Home\Controller;

class SectionController extends Base
{
    public function _empty($name){
        $name1 = C('ACTION_SUFFIX');
        $len = strlen($name)-strlen($name1);
        $name = mb_substr($name, 0,$len,'utf-8');
        $this->sections($name);
    }

    /**
     *
     */
    protected function sections($name){
//        var_dump($name);
        $this->display('sections');

    }
}