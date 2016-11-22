<?php
namespace Admin\Model;

use Common\Controls\Model;

class ConfigGroupModel extends Model
{
    protected $tableName = 'config_group';
    const Enabled = 1;
    const Disable = 0;

    /**
     * 根据id获取信息
     * @param $gid
     * @return mixed
     */
    public function getDataById($gid){
        $data = $this->where(array('gid'=>$gid,'status'=>self::Enabled))->select();
        return $data;
    }

    /**
     * 获取全部开启的配置
     * @return mixed
     */
    public function getDataAll(){
        $data = $this->where(array('status'=>self::Enabled))->order('gsort asc')->select();
        return $data;
    }




}