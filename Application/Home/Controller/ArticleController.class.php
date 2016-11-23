<?php
namespace Home\Controller;
class ArticleController extends Base{

    public function AllAction(){
        $this->display('all');
    }

    public function DetailsAction(){
        $this->display('details');
    }
}