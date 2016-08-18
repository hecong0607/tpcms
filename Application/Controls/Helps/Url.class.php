<?php
namespace Controls\Helps;
class Url
{
	private $adminLogin = '';
	private $adminHome = '';

	function __construct() {
		$this->adminHome = U('Admin/Home/index');
		$this->adminLogin = U('Admin/Public/login');
	}

	public function getAdminLogin(){
		return $this->adminLogin;
	}
	public function getAdminHome(){
		return $this->adminHome;
	}

}