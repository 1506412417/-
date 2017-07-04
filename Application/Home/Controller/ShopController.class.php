<?php

namespace Home\Controller;

use Think\Controller;

class ShopController extends Controller
{
    public function indexAction()
    {
        $this->display();
    }

    public function showAction()
    {
        $this->assign('goods_id', I('get.goods_id'));

        $this->display();
    }

    /**
     * 后端程序
     * 提供对分类操作全面数据数据
     */
    public function categoryAction()
    {
        switch (I('request.operate', '')) {
            case 'nestedList':// 嵌套列表
                $this->ajaxReturn(['error'=>0, 'data'=>D('Category')->getNestedList()]);
                break;
            default:
                $this->ajaxReturn(['error'=>1, 'errorInfo'=>'操作不支持']);
                break;
        }
    }

    /**
     * 商品操作
     */
    public function goodsAction()
    {
        switch (I('request.operate', '')) {
            case 'new':
                $rows = M('Goods')
                    ->where(['status'=>'1', 'deleted'=>'0']) //商品可用  没有被删除得商品（逻辑删除，可以还原）
                    ->order('created_at desc, sort_number') //依据添加时间降序排序 其次以排序数字升序排序
                    ->limit(I('request.limit', CC('goods_new_number'))) // 展示的新商品的数量(增加该配置) 用户有提交就用提交纸  否则使用m默认的值  数据库默认4个
                    ->select();
                if ($rows) {  //判断是否有查询到的数据
                    $rows = array_map(function($row) {  //给数据加上url属性
                        $row['url'] = U('/show/' . $row['goods_id']);
                        return $row;
                    }, $rows);

                    //处理过的数据返回给前台
                    $this->ajaxReturn(['error'=>0, 'data'=>$rows]);
                } else {
                    $this->ajaxReturn(['error'=>1, 'errorInfo'=>'查询失败']);
                }
                break;

            case 'show':
                // 商品详细相关信息
                $modelGoods = D('Goods');
                $row = $modelGoods
                    //查询goods表所有 库存状态表 标题
                    ->field('g.*, ss.title stock_status_title')
                    ->alias('g')
                    ->join('left join __STOCK_STATUS__ ss using(stock_status_id)')//连接库存状态表
                    ->relation(true) //开启关联查询
                    ->where(['status'=>'1', 'deleted'=>'0', 'goods_id'=>I('request.goods_id')])//商品可用  没有被删除得商品（逻辑删除，可以还原）
                    ->find();
                if ($row) {  //该商品有
                    // 查询货品信息
                    $productList = M('Product')
                        //货品id 是否推荐 group_concat()组内统计  concat()连接
                        ->field('p.product_id, p.promoted, pd.value price_drift, product_price, product_quantity, group_concat(a.attribute_title, \':\', ao.option_value) as `option`')
                        ->alias('p')
                        //连接 货品 商品 属性 选项表
                        ->join('left join __PRODUCT_GOODS_ATTRIBUTE_OPTION__ pgao using(product_id)')
                        //连接 商品属性选项表
                        ->join('left join __GOODS_ATTRIBUTE_OPTION__ gao using(goods_attribute_option_id)')
                        //连接 属性选项表
                        ->join('left join __ATTRIBUTE_OPTION__ ao using(attribute_option_id)')
                        //连接属性表
                        ->join('left join __ATTRIBUTE__ a using(attribute_id)')
                        //连接 价格浮动表（ + - =）
                        ->join('left join __PRICE_DRIFT__ pd using(price_drift_id)')
                        ->where(['goods_id'=>I('request.goods_id'), 'enabled'=>1])
                        ->group('p.product_id')
                        ->select();

                    $row['productList'] = $productList ? $productList : [];

//                     商品属性信息  select
//                                     a.attribute_title,at.attribute_type_title,
//                                     ga.value,group_concat(ao .option_value) valuelist
//                                     from sun_goods_attribute ga left join
//                                     sun_attribute a using(attribute_id)
//                                     left join sun_attribute_type at using(attribute_type_id)
//                                     left join sun_goods_attribute_option gao using(goods_attribute_id)
//                                     left join sun_attribute_option ao using(attribute_option_id)
//                                     where goods_id=3 group by ga.attribute_id;
                    $attributeList = M('GoodsAttribute')
                        //属性名 属性输入类型  商品属性选项值 group_concat()会计算哪些行属于同一组，将属于同一组的列显示出来
                        ->field('a.attribute_title, at.attribute_type_title, ga.value, group_concat(ao.option_value) valuelist')
                        ->alias('ga')
                        //属性表
                        ->join('left join __ATTRIBUTE__ a using(attribute_id)')
                        //属性类型表
                        ->join('left join __ATTRIBUTE_TYPE__ at using(attribute_type_id)')
                        //商品属性选项表
                        ->join('left join __GOODS_ATTRIBUTE_OPTION__ gao using(goods_attribute_id)')
                        //属性选项表
                        ->join('left join __ATTRIBUTE_OPTION__ ao using(attribute_option_id)')
                        ->where(['goods_id'=>I('request.goods_id')])
                        ->group('ga.attribute_id')//以属性id分组
                        ->select();
                    //得到属性列表
                    $row['attributeList'] = $attributeList ? $attributeList : [];

                    $this->ajaxReturn(['error'=>0, 'data'=>$row]);
                } else {
                    $this->ajaxReturn(['error'=>1, 'errorInfo'=>'商品查询失败']);
                }
                break;
            default:
                $this->ajaxReturn(['error'=>1, 'errorInfo'=>'操作不支持']);
                break;
        }
    }

    /**
     * 面包屑导航
     */
    public function breadcrumbAction()
    {
        $goods_id = I('request.goods_id', null);//获取当前操作商品ID

        // 找到当前商品所属的分类
        $modelGoods = M('Goods');
        $category_id = $modelGoods->where(['goods_id'=>$goods_id])->getField('category_id');

        // 找当前分类
        $modelCategory = M('Category');
        // 一直找到顶级分类
        // 先执行一次循环体, 再判断条件, 满足继续执行
        // 使用环境: 循环条件, 需要通过循环体的执行才能够获取

        // 循环条件: 分类的上级分类是否为0,
        // 循环体: 查找当前分类
        // 依赖: 确定上级分类是否为0,的前提就是 查找当前分类
        $breadcrumb = [];
        do {
            $category = $modelCategory->find($category_id);
            $category['url'] = U('/category/'.$category_id);//为面包屑导航每一级做URL
            array_unshift($breadcrumb, $category);//在数组的开头插入元素
            $category_id = $category['parent_id'];
        } while ($category['parent_id'] != 0); //如果不属于顶级分类则继续查找

        $this->ajaxReturn(['error'=>0, 'data'=>$breadcrumb]);
    }
}