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
    public function doSave($array)
    {
        if (empty($array)) {
            $this->msg->status = false;
            $this->msg->content = '数据为空';
        } else {
            $time = time();
            foreach ($array as $k => $v) {
                if (empty($v)) {
                    continue;
                } else {
                    $temp = array('route' => $v, 'create_time' => $time,);
                    $data[] = $temp;
                }
            }
            if (empty($data)) {
                $result = false;
            } else {
                $result = $this->addAll($data);
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
    public function del($array)
    {
        foreach ($array as $k => $v) {
            $data[] = (int)$v;
        }
        if (empty($data)) {
            $result = false;
        } else {
            $result = $this->where(array('id' => array('in', $data)))->delete();
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
     * 获取当前数据库中所有路由
     * @return \Common\Controls\Msg
     */
    public function getRoutesByDb()
    {
        $this->msg->data = $this->field('id,route')->order('route')->select();
        $this->msg->status = empty($this->msg->data) ? false : true;
        return $this->msg;
    }

    /**
     * 获取当前系统所有路由
     * 分两个数组，分别存储当前本地未存入数据库的路由和数据库已存储的路由
     * 返回数组
     * @return \Common\Controls\Msg
     */
    public function getRoutes()
    {
        $data['database'] = $this->field('id,route')->order('route')->select();
        $databaseStr = '';
        foreach ($data['database'] as $k => $v) {
            $databaseStr .= $v['route'];
        }
        $modules = C('param.adminModules');
        $configs = array();
        foreach($modules as $k=>$v){
            $configTemp['dir'] = __DIR__.'/../../'.$v.'/Controller/';
            $configTemp['modules'] = $v;
            $configTemp['controllerFile'] = scandir($configTemp['dir']);
            $configs[] = $configTemp;
        }
//        $dir = __DIR__ . '/../Controller/';
//        $controllerFile = scandir($dir);
        $routes = array();
        foreach($configs as $keyC =>$valueC) {
            $module = $valueC['modules'];
            $actionSuffix = C('ACTION_SUFFIX');
            foreach ($valueC['controllerFile'] as $k => $v) {
                $temp = explode('Controller.class.', $v);
                if (!empty($temp[1]) && $temp[0] != 'Empty') {
                    $controller = $temp[0];
                    $class = $module . '\\Controller\\' . $controller . 'Controller';
                    $methods = get_class_methods($class);
                    foreach ($methods as $key => $value) {
                        if (substr($value, -strlen($actionSuffix)) == $actionSuffix) {
                            $action = substr($value, 0, strlen($value) - strlen($actionSuffix));
                            $route = '/' . $module . '/' . $controller . '/' . $action;
                            if (stripos($databaseStr, $route) === false) {
                                $routes[] = $route;
                            }

                        }
                    }
                }
            }
        }
//		asort($routes);
        $data['program'] = $routes;
        $this->msg->data = $data;
        return $this->msg;
    }


}