<?php
namespace Admin\Model;

use Common\Controls\Model;

/**
 * Class RouteModel
 * @package Admin\Model
 * @property string $route
 * @property integer $create_time
 */
class RouteModel extends Model
{
	protected $tableName = 'admin_route';


	/**
	 * 批量添加操作（新增和修改）
	 * @return \Common\Controls\Msg
	 */
	public function doSave($array) {
		if (empty($array)) {
			$this->msg->status = false;
			$this->msg->content = '数据为空';
		} else {
			$time = time();
			foreach ($array as $k => $v) {
				if (empty($v)) {
					continue;
				} else {
					$temp = array('name' => $v, 'create_time' => $time,);
					$data[] = $temp;
				}
			}
			if (empty($data)) {
				$result = false;
			} else {
				$result = $this->data($data)->add();
			}
			if ($result === false) {
				$this->msg->status = false;
				$this->msg->content = '保存失败！';
			} else {
				$this->msg->status = true;
				$this->msg->content = '保存成功';
			}
		}
		return $this->msg;
	}

	/**
	 * 批量删除数据逻辑，返回删除结果
	 * @param $id
	 * @return \Common\Controls\Msg
	 */
	public function del($array) {
		foreach ($array as $k => $v) {
			$data[] = (int)$v;
		}
		if (empty($data)) {
			$result = false;
		} else {
			$result = $this->where(array('id'=>array('in',$data)))->delete();
		}
		if ($result == false) {
			$this->msg->status = false;
			$this->msg->content = '删除失败！';
		} else {
			$this->msg->status = true;
			$this->msg->content = '删除成功！';
		}
		return $this->msg;
	}

	/**
	 * 返回当前系统所有路由
	 * @return \Common\Controls\Msg
	 */
	public function getRoutes(){
		$data['database'] = $this->field('id,route')->select();
		$databaseStr = '';
		foreach($data['database'] as $k=>$v){
			$databaseStr .= $v['route'];
		}
		$dir = __DIR__.'/../Controller/';
		$controllerFile = scandir($dir);
		$routes = array();
		$module = MODULE_NAME;
		$actionSuffix = C('ACTION_SUFFIX');
		foreach($controllerFile as $k=>$v) {
			$temp = explode('Controller.class.', $v);
			if (!empty($temp[1]) && $temp[0] != 'Empty') {
				$controller = $temp[0];
				$class = $module . '\\Controller\\' . $controller . 'Controller';
				$methods = get_class_methods($class);
				foreach ($methods as $key => $value) {
					if (substr($value, -strlen($actionSuffix)) == $actionSuffix) {
						$action = substr($value, 0, strlen($value) - strlen($actionSuffix));
						$route = '/' . $module . '/' . $controller . '/' . $action;
						$routes[] = $route;
//						if (stripos($databaseStr, $route) === false){
//							$routes[] = $route;
//						}

					}
				}
			}
		}
		$data['program'] = $routes;
		$this->msg->data = $data;
		return $this->msg;
	}



}