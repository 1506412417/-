<?php
namespace Back\Model;

use Think\Model\RelationModel;

class GoodsAttributeModel extends  RelationModel
{
    //关联商品属性选项表
    protected  $_link = [
        'GoodsOptionList'=>[
            'mapping_type'=>self::HAS_MANY,
            'class_name'=>'GoodsAttributeOption',
            'foreign_key'=>'goods_attribute_id',

        ],
    ];

}