<?php
namespace Back\Model;

use Think\Model;

class GoodsModel extends Model
{
    // 验证规则
    protected $patchValidate = true;
    protected $_validate = [
    //判断单位是否属于设定的值 不属于则验证失败
    	['sku_id', 'chkSku', '请选择合理的库存单位', self::EXISTS_VALIDATE, 'callback', self::MODEL_BOTH],
        ['tax_id', 'chkTax', '请选择合理的税类型', self::EXISTS_VALIDATE, 'callback', self::MODEL_BOTH],
        ['length_unit_id', 'chkLengthUnit', '请选择合理的长度单位',self::EXISTS_VALIDATE, 'callback',self::MODEL_BOTH],
        ['weight_unit_id', 'chkWeightUnit','请选择合理的重量单位', self::EXISTS_VALIDATE, 'callback',self::MODEL_BOTH],
        ['stock_status_id', 'chkStockStatus', '请选择合理的库存状态',self::EXISTS_VALIDATE, 'callback',self::MODEL_BOTH],
        ['brand_id', 'chkBrand', '请选择现有的品牌,如果品牌不存在请先添加品牌',self::EXISTS_VALIDATE, 'callback',self::MODEL_BOTH],
        ['category_id', 'chkCategory', '请选择现有的分类,如果分类不存在请先添加分类',self::EXISTS_VALIDATE, 'callback',self::MODEL_BOTH],

    ];

    // 完成规则
    protected $_auto = [
    	//商品代码 插入时完成规则
    	['upc', 'mkUpc', self::MODEL_INSERT, 'callback'],
        ['created_at', 'time', self::MODEL_INSERT, 'function'], //创建时间
        //修改时间 全部情况下完成 （插入，修改）
        ['updated_at', 'time', self::MODEL_BOTH, 'function'],
        ['date_available', 'mkDateAvailable', self::MODEL_BOTH, 'callback']
    ];
    //
    protected function mkDateaVailable($value) {
//        if ($value !== '') {
//            return $value;
//        }
        return date('Y-m-d');
    }

    //商品代码自动完成
    protected function mkUpc($value)
    {
        // 如果用户指定, 使用用户的
        if ($value !== '') {
            return $value;
        }
        // 否则使用自动生成
        return time() . mt_rand(100, 999) . mt_rand(100, 999) . mt_rand(100, 999);// 伪随机数
    }

    //库存单位验证
    protected function chkSku($value)
    {	
    	//转换成布尔类型  找到为true 找不到为false
        return (bool) M('Sku')->find($value);
    }

    //税类型验证
    protected function chkTax($value)
    {
        return (bool) M('Tax')->find($value);
    }

    //长度单位验证
    protected function chkLengthUnit($value)
    {
    	return (bool) M('LengthUnit')->find($value);
    }

    //重量单位验证
    protected function chkWeightUnit($value)
    {
    	return (bool) M('WeightUnit')->find($value);
    }
    //库存状态验证
    protected function chkStockStatus($value)
    {
    	return (bool) M('StockStatus')->find($value);
    }
    //品牌是否存在验证
    protected function chkBrand($value)
    {
    	return (bool) M('Brand')->find($value);
    }
    //分类是否存在验证
    protected function chkCategory($value)
    {
    	return (bool) M('Category')->find($value);
    }
}