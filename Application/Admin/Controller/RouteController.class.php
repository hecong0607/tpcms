<?php
namespace Admin\Controller;

use Admin\Model\RouteModel;

class RouteController extends Base
{
	/**
	 * 列表页面
	 */
	public function listAction(){
		$route = new RouteModel();
		$result = $route->getRoutes();
		$this->assign('program',$result->data['program']);
		$this->assign('database',$result->data['database']);
		$this->display('Route/list');die;
		var_dump($result->data);
	}

	/**
	 * 批量删除接口
	 */
	public function delAction(){
		$data = I('get.id');
		$route = new RouteModel();
		$delMsg = $route->del($data);
		if($delMsg->status == false){
			$this->error($delMsg->content,U('Admin/route/list'));
		}else{
			$this->success($delMsg->content,U('Admin/route/list'));
		}
	}

	/**
	 * 批量新增接口
	 */
	public function addAction(){
		$data = I('get.routes');
		$route = new RouteModel();
		$delMsg = $route->doSave($data);
		if($delMsg->status == false){
			$this->error($delMsg->content,U('Admin/route/list'));
		}else{
			$this->success($delMsg->content,U('Admin/route/list'));
		}
	}
}