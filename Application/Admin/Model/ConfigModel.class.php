<?php
namespace Admin\Model;

use Common\Controls\Model;

class ConfigModel extends Model
{
    protected $tableName = 'config';

    public function getData($gid){
        $where = array(
            'status'=>1,
            'gid'=>(int)$gid,
        );
        $data = $this->where($where)->order('sort asc')->select();
        $html = $this->build_html($data);
        return $html;
    }

    /**
     * 配置转换成修改的html
     * @param $config_list
     * @return string
     */
    protected function build_html($config_list){
        $config_html = '';
        if(is_array($config_list)){
            foreach($config_list as $k=>$v){

                $tmp_type_arr = explode('&',$v['type']);
                $type_arr = array();
                foreach($tmp_type_arr as $key=>$value){
                    $tmp_value = explode('=',$value);
                    $type_arr[$tmp_value[0]] = $tmp_value[1];
                }
                $type = $type_arr['type'];
                $style = $type_arr['style'];
                $value = isset($type_arr['value']) ? $type_arr['value'] : null;
                unset($type_arr['type']);
                unset($type_arr['style']);
                unset($type_arr['value']);
                $option = '';
                foreach($type_arr as $k1=>$v1){
                    $option .= $k1 . '="' . $v1 . '" ';
                }
                if($type == 'text'){
                    $config_html .= '<div class="control-group"><label class="control-label">' . $v['info'] . '</label><div class="controls">';
                    $config_html .= '<input type="text" '.$option.' name="options[' . $v['name'] . ']" value="' . $v['value'] . '" style="'.$style.'">';
                    $config_html .= '<img src="/Public/Admin/images/help.gif" class="tips_img" data-title="' . $v['desc'] . '"></div></div>';
                }elseif($type == 'select'){
                    $config_html .= '<div class="control-group"><label class="control-label">' . $v['info'] . '</label><div class="controls">';
                    $config_html .= '<select '.$option.' name="options[' . $v['name'] . ']">';
                    $select_option = explode('|',$value);
                    foreach($select_option as $select_k=>$select_v){
                        $option_one = explode(':',$select_v);
                        $config_html .= '<option value="'.$option_one[0].'" '.($v['value']==$option_one[0] ? 'selected="selected"' : '').'>'.$option_one[1].'</option>';
                    }
                    $config_html .= '</select>';
                    $config_html .= '<img src="/Public/Admin/images/help.gif" class="tips_img" data-title="' . $v['desc'] . '"></div></div>';
                }elseif($type == 'textarea'){
                    $config_html .= '<div class="control-group"><label class="control-label">' . $v['info'] . '</label><div class="controls">';
                    $config_html .= '<textarea '.$option.' name="options[' . $v['name'] . ']" >' . $v['value'] . '</textarea>';
                    $config_html .= '<img src="/Public/Admin/images/help.gif" class="tips_img" data-title="' . $v['desc'] . '"></div></div>';
                }elseif($type == 'radio'){
                    $config_html .= '<div class="control-group"><label class="control-label">' . $v['info'] . '</label><div class="controls">';
                    $config_html .= '<label class="checkbox inline"><input '.$option.' type="checkbox" name="options[' . $v['name'] . ']" '. ($v['value'] == 'true' ? 'checked':'') . '></label>';
                    $config_html .= '<img src="/Public/Admin/images/help.gif" class="tips_img" data-title="' . $v['desc'] . '"></div></div>';
                }
            }
        }
        return $config_html;
    }

    /**
     * 转html参照
     * @param $config_list
     * @return mixed
     */
    private function build_html1($config_list){
        if(is_array($config_list)){
            $config_html = '';
            $has_tab = (count($config_list) > 1) ? true : false;
            $config_tab_html = $has_tab ? '<ul class="tab_ul">' : '';
            $pigcms_auto_key = 1;
            foreach($config_list as $pigcms_key=>$pigcms_value){
                if($has_tab) $config_tab_html .= '<li '.($pigcms_auto_key==1 ? 'class="active"' : '').'><a data-toggle="tab" href="#tab_'.$pigcms_key.'">'.$pigcms_value['name'].'</a></li>';

                $config_html .= '<table cellpadding="0" cellspacing="0" class="table_form" width="100%" style="display:none;" id="tab_'.$pigcms_key.'">';
                foreach($pigcms_value['list'] as $key=>$value){
                    $tmp_type_arr = explode('&',$value['type']);
                    $type_arr = array();
                    foreach($tmp_type_arr as $k=>$v){
                        $tmp_value = explode('=',$v);
                        $type_arr[$tmp_value[0]] = $tmp_value[1];
                    }

                    $config_html .= '<tr>';
                    $config_html .= '<th width="160">'.$value['info'].'：</th>';
                    $config_html .= '<td>';
                    if($type_arr['type'] == 'text'){
                        $size = !empty($type_arr['size']) ? $type_arr['size'] : '60';
                        $config_html .= '<input type="text" class="input-text" name="'.$value['name'].'" id="config_'.$value['name'].'" value="'.$value['value'].'" size="'.$size.'" validate="'.$type_arr['validate'].'" tips="'.$value['desc'].'"/>';
                    }else if($type_arr['type'] == 'textarea'){
                        $rows = !empty($type_arr['rows']) ? $type_arr['rows'] : '4';
                        $cols = !empty($type_arr['cols']) ? $type_arr['cols'] : '80';
                        $config_html .= '<textarea rows="'.$rows.'" cols="'.$cols.'" name="'.$value['name'].'" id="config_'.$value['name'].'" validate="'.$type_arr['validate'].'" tips="'.$value['desc'].'">'.$value['value'].'</textarea>';
                    }else if($type_arr['type'] == 'radio'){
                        $radio_option = explode('|',$type_arr['value']);
                        foreach($radio_option as $radio_k=>$radio_v){
                            $radio_one = explode(':',$radio_v);
                            if($radio_k == 0){
                                $config_html .= '<span class="cb-enable"><label class="cb-enable '.($value['value']==$radio_one[0] ? 'selected' : '').'"><span>'.$radio_one[1].'</span><input type="radio" name="'.$value['name'].'" value="'.$radio_one[0].'" '.($value['value']==$radio_one[0] ? 'checked="checked"' : '').'/></label></span>';
                            }else if($radio_k == 1){
                                $config_html .= '<span class="cb-disable"><label class="cb-disable '.($value['value']==$radio_one[0] ? 'selected' : '').'"><span>'.$radio_one[1].'</span><input type="radio" name="'.$value['name'].'" value="'.$radio_one[0].'" '.($value['value']==$radio_one[0] ? 'checked="checked"' : '').'/></label></span>';
                            }
                        }
                        if($value['desc']){
                            $config_html .= '<em tips="'.$value['desc'].'" class="notice_tips"></em>';
                        }
                    }else if($type_arr['type'] == 'image'){
                        $config_html .= '<span class="config_upload_image_btn"><input type="button" value="上传图片" class="button" style="margin-left:0px;margin-right:10px;"/></span><input type="text" class="input-text input-image" name="'.$value['name'].'" id="config_'.$value['name'].'" value="'.$value['value'].'" size="48" validate="'.$type_arr['validate'].'" tips="'.$value['desc'].'"/> ';
                    }else if($type_arr['type'] == 'file'){
                        $config_html .= '<span class="config_upload_file_btn" file_validate="'.$type_arr['file'].'"><input type="button" value="上传文件" class="button" style="margin-left:0px;margin-right:10px;"/></span><input type="text" class="input-text input-file" name="'.$value['name'].'" id="config_'.$value['name'].'" value="'.$value['value'].'" size="48" readonly="readonly" validate="'.$type_arr['validate'].'" tips="'.$value['desc'].'"/> ';
                    }else if($type_arr['type'] == 'select'){
                        $radio_option = explode('|',$type_arr['value']);
                        $config_html .= '<select name="'.$value['name'].'">';
                        foreach($radio_option as $radio_k=>$radio_v){
                            $radio_one = explode(':',$radio_v);
                            $config_html .= '<option value="'.$radio_one[0].'" '.($value['value']==$radio_one[0] ? 'selected="selected"' : '').'>'.$radio_one[1].'</option>';
                        }
                        $config_html .= '</select>';
                        if($value['desc']){
                            $config_html .= '<em tips="'.$value['desc'].'" class="notice_tips"></em>';
                        }
                    }else if($type_arr['type'] == 'webTpl'){
                        $hostArr = parse_url($this->config['site_url']);
                        import('ORG.Util.Dir');
                        $dirObj = new Dir(TMPL_PATH.C('DEFAULT_GROUP'));
                        $radio_option = array();
                        foreach($dirObj->_values as $dirValue){
                            if($dirValue['isDir']){
                                $tpl_theme_ini = parse_ini_file($dirValue['pathname'].'/theme.ini');
                                if($tpl_theme_ini){
                                    $tmpArr = array(
                                        'name'=>$tpl_theme_ini['name'],
                                        'path'=>$tpl_theme_ini['path'],
                                        'isUse'=> ($tpl_theme_ini['path'] == $value['value'] ? true : false)
                                    );
                                    if(empty($tpl_theme_ini['domain']) || $tpl_theme_ini['domain'] == $hostArr['host']){
                                        array_push($radio_option,$tmpArr);
                                    }
                                }
                            }
                        }
                        $config_html .= '<select name="'.$value['name'].'">';
                        foreach($radio_option as $radio_k=>$radio_v){
                            $config_html .= '<option value="'.$radio_v['path'].'" '.($radio_v['isUse'] ? 'selected="selected"' : '').'>'.$radio_v['name'].'</option>';
                        }
                        $config_html .= '</select>';
                        if($value['desc']){
                            $config_html .= '<em tips="'.$value['desc'].'" class="notice_tips"></em>';
                        }
                    }else if($type_arr['type'] == 'wapTpl'){
                        $hostArr = parse_url($this->config['site_url']);
                        import('ORG.Util.Dir');
                        $dirObj = new Dir(TMPL_PATH.'Wap/');
                        $radio_option = array();
                        foreach($dirObj->_values as $dirValue){
                            if($dirValue['isDir']){
                                $tpl_theme_ini = parse_ini_file($dirValue['pathname'].'/theme.ini');
                                if($tpl_theme_ini){
                                    $tmpArr = array(
                                        'name'=>$tpl_theme_ini['name'],
                                        'path'=>$tpl_theme_ini['path'],
                                        'isUse'=> ($tpl_theme_ini['path'] == $value['value'] ? true : false)
                                    );
                                    if(empty($tpl_theme_ini['domain']) || $tpl_theme_ini['domain'] == $hostArr['host']){
                                        array_push($radio_option,$tmpArr);
                                    }
                                }
                            }
                        }
                        $config_html .= '<select name="'.$value['name'].'">';
                        foreach($radio_option as $radio_k=>$radio_v){
                            $config_html .= '<option value="'.$radio_v['path'].'" '.($radio_v['isUse'] ? 'selected="selected"' : '').'>'.$radio_v['name'].'</option>';
                        }
                        $config_html .= '</select>';
                        if($value['desc']){
                            $config_html .= '<em tips="'.$value['desc'].'" class="notice_tips"></em>';
                        }
                    }
                    $config_html .= '</td>';
                    $config_html .= '</tr>';
                }
                $config_html .= '</table>';
                $pigcms_auto_key++;
            }
            if($has_tab) $config_tab_html .= '</ul>';

            $return_config['config_html'] = $config_html;
            if($has_tab) $return_config['config_tab_html'] = $config_tab_html;
            return $return_config;
        }
    }

    /**
     * 修改配置
     * @param $name
     * @param $value
     */
    public function updateDataByName($name,$value){
        $result = $this->where(array('name'=>$name))->data(array('value'=>$value))->save();
        return $result;
    }
}
