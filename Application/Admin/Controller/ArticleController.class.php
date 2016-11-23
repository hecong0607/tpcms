<?php
namespace Admin\Controller;

/**
 * 文章控制器
 * Class ArticleController
 * @package Admin\Controller
 */
class ArticleController extends Base
{
    //文章创建修改
    public function ArtSaveAction()
    {
        $this->display();
    }
    //文章保存
    public function ArtDoSaveAction()
    {

    }
    //文章列表
    public function ArtListAction()
    {

    }
    //文章删除
    public function ArtDelAction()
    {

    }

    //标签查看
    public function TagsListAction()
    {

    }

    //栏目创建修改
    public function SecSaveAction()
    {

    }
    //栏目保存
    public function SecDoSaveAction()
    {

    }
    //栏目查看
    public function SecViewAction()
    {

    }
    //栏目列表
    public function SecListAction()
    {

    }
    //栏目删除
    public function SecDelAction()
    {

    }

    //图片列表查看
    public function FaceListAction()
    {

    }
    //图片详情查看
    public function FaceDesAction()
    {

    }
    //图片资源删除
    public function FaceDelAction()
    {

    }
    //图片上传
    public function FaceUploadAction()
    {
        var_dump($_FILES);
    }
}