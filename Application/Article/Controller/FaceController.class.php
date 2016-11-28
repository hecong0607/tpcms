<?php
namespace Article\Controller;

use Admin\Controller\Base;
use Article\Model\ArticleFaceModel;

class FaceController extends Base
{

    /**
     * 图片上传
     */
    public function uploadAction()
    {
        if (IS_POST) {
            $uid = $this->getMyInfo()['id'];
            $face = new ArticleFaceModel();
            $result = $face->doUpload($uid);
            $jsonArr = array(
                'url' => $result->data,
                'msg' => $result->content,
            );
            $json = json_encode($jsonArr);
            if ($result->status == false) {
                $this->error($json);
            } else {
                $this->success($json);
            }
        }
    }
}