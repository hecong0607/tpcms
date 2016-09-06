<?php
namespace Home\Controller;

use Home\Logic\CurlLogic;
use Home\Model\TestArticleModel;
use Home\Model\TestNickModel;
use Home\Model\TestUserModel;
use Think\Controller;

class IndexController extends Controller
{

    public function IndexAction()
    {
        echo 'wait';
    }

    public function TestAction()
    {
        die('接口关闭');
        $data = array();
        for ($i = 1; $i <= 10000; $i++) {
            for ($j = 1; $j <= 5; $j++) {
                $temp = array(
                    'uid'   => $i,
                    'title' => 'title_' . $i . '_' . $j,
                );
                $data[] = $temp;
            }
        }

        $datas = array_chunk($data, 1000);
        foreach ($datas as $k => $v) {
            $user = new TestArticleModel();
            $user->addAll($v);
        }
    }

    public function Join1Action()
    {
        die('接口关闭');
        $t1 = microtime(true);
        $sql = 'select * from cms_test_article as article ';
        $sql .= 'left join cms_test_user as user on user.id = article.uid ';
        $sql .= 'left join cms_test_nick as nick on nick.uid = user.id ';
        $sql .= ' where article.id>1000 and  user.id>1000 limit 100,1000';

        $data = M()->query($sql);

        $t2 = microtime(true);
        echo '耗时' . round($t2 - $t1, 8) . '秒';

        var_dump($data);
    }

    public function arrAction()
    {
        die('接口关闭');
        $t1 = microtime(true);
        $sql = 'select * from cms_test_article where id>25000  and id<400000 limit 100,1000';
        $article = M()->query($sql);
        $uid = array();
        foreach($article as $k=>$v){
            $uid[] = $v['id'];
        }
        $inUid = implode(',',$uid);

        $sql = 'select * from cms_test_user where id in('.$inUid.')';
        $user = M()->query($sql);

        $sql = 'select * from cms_test_nick where uid in('.$inUid.')';
        $nick = M()->query($sql);

        foreach($user as $k=>$v){
            $uid = $v['id'];
            unset($v['id']);
            $userArr['uid'.$uid] = $v;
        }
        foreach($nick as $k=>$v){
            $uid = $v['uid'];
            unset($v['id']);
            unset($v['uid']);
            $nickArr['uid'.$uid] = $v;
        }
        $userEmpty = array('username'=>'');
        $nickEmpty = array('nickname'=>'');
        foreach($article as $k=>&$v){
            if(isset($userArr['uid'.$v['uid']])){
                $v = array_merge($v, $userArr['uid'.$v['uid']]);
            }else{
                $v = array_merge($v, $userEmpty);
            }
            if(isset($nickArr['uid'.$v['uid']])){
                $v = array_merge($v, $nickArr['uid'.$v['uid']]);
            }else{
                $v = array_merge($v, $nickEmpty);
            }
        }
        $t2 = microtime(true);
        echo '耗时' . round($t2 - $t1, 8) . '秒';


        var_dump($article);die;
        var_dump($data);die;

        var_dump($article);
        var_dump($user);
        var_dump($nick);

    }

    public function UserAction()
    {
        die('接口关闭');
        $data = array();
        for ($i = 10001; $i <= 100000; $i++) {
            $temp = array(
                'username' => 'name' . $i,
            );
            $data[] = $temp;
        }

        $datas = array_chunk($data, 10000);
        foreach ($datas as $k => $v) {
            $user = new TestUserModel();
            $user->addAll($v);
        }
    }

    public function articleAction()
    {
        die('接口关闭');
        $data = array();
        for ($i = 80001; $i <= 100000; $i++) {
            for ($j = 1; $j <= 5; $j++) {
                $temp = array(
                    'uid'   => $i,
                    'title' => 'title_' . $i . '_' . $j,
                );
                $data[] = $temp;
            }
        }

        $datas = array_chunk($data, 3000);
        foreach ($datas as $k => $v) {
            $user = new TestArticleModel();
            $result[] = $user->addAll($v);
        }
        var_dump($result);
    }

    public function nickAction()
    {
        die('接口关闭');
        $data = array();
        for ($i = 10001; $i <= 100000; $i++) {
            $temp = array(
                'uid'      => $i,
                'nickname' => 'nick' . $i,
            );
            $data[] = $temp;
        }

        $datas = array_chunk($data, 3000);
        foreach ($datas as $k => $v) {
            $user = new TestNickModel();
            $user->addAll($v);
        }
    }

}