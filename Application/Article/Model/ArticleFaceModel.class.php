<?php
namespace Article\Model;

use Common\Controls\Model;

/**
 * 文章图片类
 * Class ArticleFaceModel
 * @package Admin\Model
 *
 * @property integer $id
 * @property string $user_id
 * @property string $url
 * @property string $thumb
 * @property integer $path
 */
class ArticleFaceModel extends Model
{
    protected $tableName = 'article_face';

    /**
     * 上传到服务器
     */
    public function doUpload($uid){
        $savepath=date('Ymd').'/';
        //上传处理类
        $config=array(
            'rootPath' => './'.C("FACE.PATH"),
            'savePath' => $savepath,
            'maxSize' => 11048576,
            'saveName'   =>    array('uniqid',''),
            'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
            'autoSub'    =>    false,
        );
        $upload = new \Think\Upload($config);//
        $info=$upload->upload();
        $data = array('url' => '', 'thumb' => '');
        //开始上传
        if ($info) {
            //上传成功
            //写入附件数据库信息
            $first=array_shift($info);
            if(!empty($first['url'])){
                $url=$first['url'];
            }else{
                $url=C("FACE.ROOT").$savepath.$first['savename'];
            }
            $thumb = $this->thumb('.' .$url, $first['savename']);
            $data = array('url' => $url, 'thumb' => $thumb);
            $this->msg->status = true;
            $this->msg->data = $data;
            $this->msg->content = '上传成功';
            $this->doSave($url, $thumb, $uid);
        } else {
            //上传失败，返回错误
            $this->msg->status = false;
            $this->msg->data = $data;
            $this->msg->content = $upload->getError();
        }
        return $this->msg;
    }

    /**
     * 保存在数据库
     * @param $url
     * @param $uid
     * @return mixed
     */
    protected function doSave($url, $thumb, $uid){
        $data = array(
            'url' =>$url,
            'thumb' =>$thumb,
            'user_id' =>$uid,
            'time'  => time(),
        );
        $result = $this->data($data)->add();
        return $result;
    }

    /**
     * 存放缩略图
     * @param $path
     * @param $name
     */
    public function thumb($path, $name)
    {
        $image = new \Think\Image();
        $image->open($path);
        $savePath = C('THUMB.ROOT').$name;
        // 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
        $image->thumb(150, 150)->save('.' .$savePath);
        return $savePath;
    }
}