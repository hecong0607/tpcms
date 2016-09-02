<?php
namespace Common\Controls;
/**
 * Class Msg
 * @package Helps
 * 消息辅助类，用于各层之间的消息返回
 *
 * @property integer $status
 * @property string $data
 * @property string $content
 */
class Msg
{
    public $status = false;
    public $data = array();
    public $content = '';

}