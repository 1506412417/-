<?php
namespace Back\Model;
use Think\Model;

class BrandModel extends Model
{	
	//开启批量验证
	protected $patchValidate=true;
	protected $_validate = [
	    //require 必须
		['title','require','品牌不能为空'],
		//唯一
		['title','','品牌已存在',self::EXISTS_VALIDATE,'unique'],
		//必须为url地址
		['site','url','请填写正确的URL地址'],
		//必须为数字
		['sprt_number','number','排序需要整数'],

	];
	//自动完成规则
	protected $_auto = [
		//插入时填入当前时间戳
		['created_at','time',self::MODEL_INSERT,'function'],
		//修改时填入当前时间戳
		['updated_at','time',self::MODEL_BOTH,'function'],
	];
}