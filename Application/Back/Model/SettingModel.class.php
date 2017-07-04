<?php
namespace Back\Model;

use Think\Model\RelationModel;

class SettingModel extends RelationModel
{

    //定义关联
    protected $_link = [
        //一个配置项肯能拥有多个选项预设值
        'optionList' => [
/*          const   HAS_ONE     =   1; 有一个, 一对一时使用
            const   BELONGS_TO  =   2; 属于, 多对一时
            const   HAS_MANY    =   3; 有多个, 一对多
            const   MANY_TO_MANY=   4; 多对多*/
            'mapping_type' => self::HAS_MANY, //映射类型（关联类型）
            'class_name'   => 'SettingOption',//所关联的模型名字
            'foreign_key'  => 'setting_id',//外键字段
        ],
    ];
}