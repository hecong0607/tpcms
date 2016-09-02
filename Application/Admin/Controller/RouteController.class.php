<?php
namespace Admin\Controller;

use Admin\Model\RouteModel;

/**
 * 路由类
 * Class RouteController
 * @package Admin\Controller
 */
class RouteController extends Base
{
    /**
     * 列表页面
     */
    public function listAction()
    {
        $route = new RouteModel();
        $result = $route->getRoutes();
        $this->assign('program', $result->data['program']);
        $this->assign('database', $result->data['database']);
        $this->display('Route/list');
    }

    /**
     * 批量删除接口
     */
    public function delAction()
    {
        $data = I('post.id');
        $route = new RouteModel();
        $delMsg = $route->del($data);
        if ($delMsg->status == false) {
            $this->error($delMsg->content, U('Admin/route/list'));
        } else {
            $this->success($delMsg->content, U('Admin/route/list'));
        }
    }

    /**
     * 批量新增接口
     */
    public function addAction()
    {
        $data = I('post.routes');
        $route = new RouteModel();
        $delMsg = $route->doSave($data);
        if ($delMsg->status == false) {
            $this->error($delMsg->content, U('Admin/route/list'));
        } else {
            $this->success($delMsg->content, U('Admin/route/list'));
        }
    }

    /**
     * 返回试试刷新数据json
     */
    public function refreshAction()
    {
        $route = new RouteModel();
        $result = $route->getRoutes();
        $this->success($result->data, U('Admin/Route/list'));
    }
}