<?php
namespace Admin\Controller;

class EmptyController extends Base{
	public function _empty(){
		$controller = new HomeController();
		$controller->mainAction();
//		header('location: '.U('Home/main'));
	}
}