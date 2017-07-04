<?php


namespace Home\Model;


use Think\Model\RelationModel;

class GoodsModel extends RelationModel //继承关联模型
{

    protected $_link = [
        'galleryList' => [
            'mapping_type'  => self::HAS_MANY, //一对多
            'class_name'    => 'Gallery', //关联相册表
            'foreign_key'   => 'goods_id', //以goods_id关联
        ]
    ];

}