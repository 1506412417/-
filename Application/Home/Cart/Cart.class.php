<?php
namespace Home\Cart;
/**
 * Class Cart 购物车类
 * @package Home\Cart
 */
class Cart
{

    private static $instance;  //保存实例

    private $wareList = [];// 所有购物车中商品信息列表

    /**
     * 获取对象的方法
     * @return Cart 单例模式
     */
    public static function instance()
    {
        if (! self::$instance instanceof self) { //当前对象里的instance是不是当前对象的实例
            self::$instance = new self; //创建实例 会自动调用构造函数
        }

        return self::$instance; //返回该对象实例
    }

    //禁止克隆
    private function __clone()
    {
    }

    /**
     * 添加商品（购买）
     * @param $goods_id 商品id
     * @param null $product_id 货品id默认为null
     * @param int $buy_quantity 购买数量默认为1
     */
    public function addWare($goods_id, $product_id=null, $buy_quantity=1)
    {
        // 拼凑的商品的唯一标志
        $key = $goods_id . '-' . (string)$product_id;// 23-, 23-17

        // 判断商品是否买过
        if (isset($this->wareList[$key])) {
            // 商品在购物车中购买过
            // 增加购买数量即可
            $this->wareList[$key]['buy_quantity'] += $buy_quantity;
        } else {
            // 没有买过, 添加商品信息
            $this->wareList[$key] = [
                'goods_id'      => $goods_id,
                'product_id'    => $product_id,
                'buy_quantity'  => $buy_quantity,
            ];
        }
    }

    //私有构造函数
    private function __construct()
    {
        $this->init();// 构造时 初始化
    }
    /**
     * 初始化
     */
    private function init()
    {
        if (session('member')) {
            // 登录, 去数据表中获取购物车信息
            $warelist = M('Cart')->where(['member_id'=>session('member.member_id')])->getField('warelist');
        } else {
            // 未登录
            $warelist = cookie('warelist');
        }
        // 为商品列表属性复制  反序列化
        $this->wareList = $warelist ? unserialize($warelist) : [];

    }
    //析构函数 对象销毁时自动调用
    public function __destruct()
    {
        $this->save(); // 析构时 持久化
    }
    /**
     * 持久化存储
     */
    private function save()
    {
        // 当前会员是否登录
        if (session('member')) {
            // 登录
            // 当前会员是否已经有购物车了, 一个会员一个购物车
            if ($cart = M('Cart')->where(['member_id'=>session('member.member_id')])->find()) {
                // 会员有购物车 更新商品数据
                M('Cart')->warelist = serialize($this->wareList);
                M('Cart')->save();
            } else {
                //没有购物车 创建购物车  存储数据
                $data = [
                    'member_id'     => session('member.member_id'),
                    'cart_title'    => '', //购物车名字
                    'warelist'      => serialize($this->wareList),
                ];
                M('Cart')->add($data);
            }

        } else {
            // 未登录 序列化到cookie中 第三参数 设置超时时间为30天  未登录只能在本机看到
            cookie('warelist', serialize($this->wareList), ['expire'=>30*24*3600]);
        }

    }


    /**
     * 获取购物车信息
     */
    public function getInfo()
    {
        // 商品信息
        // 遍历所有的商品列表, 获取详尽的信息

        foreach($this->wareList as $key=>$ware) {
            // 完善商品信息
            $goods_id = $ware['goods_id'];
            $product_id = $ware['product_id'];// null 空字符串
            if (is_null($product_id)) {
                // 没有货品
                $nonProduct[] = $goods_id;
            } else {
                // 存在货品
                $hasProduct[] = $product_id;
            }
        }
        // 查询 数据库
        if (!empty($nonProduct)) {
            // 没有货品的商品信息 id 缩略图  商品名
            $nonProductList = M('Goods')
                ->field('goods_id, image_thumb, price, name')
                ->where(['goods_id'=>['in', $nonProduct]])
                ->select();
        }


        if (!empty($hasProduct)) {
            // 查询存在货品的商品信息 select
            // g.goods_id, g.image_thumb, g.price, g.name, p.product_id,
            // p.product_price, pd.value price_drift,
            // group_concat(a.attribute_title, ":", ao.option_value) `option`
            // from sun_goods g left join sun_product p using(goods_id)
            // left join sun_price_drift pd using(price_drift_id)
            // left join sun_product_goods_attribute_option pgao using(product_id)
            // left join sun_goods_attribute_option gao using(goods_attribute_option_id)
            // left join sun_attribute_option ao using(attribute_option_id)
            // left join sun_attribute a using(attribute_id)
            // where p.product_id in ($hasProduct)
            $hasProductList = M('Goods')
                ->field('g.goods_id, g.image_thumb, g.price, g.name, p.product_id, p.product_price, pd.value price_drift, group_concat(a.attribute_title, ":", ao.option_value) `option`')
                ->alias('g')
                ->join('left join __PRODUCT__ p using(goods_id)') //货品表
                ->join('left join __PRICE_DRIFT__ pd using(price_drift_id)') //价格浮动表 （+ - =）
                ->join('left join __PRODUCT_GOODS_ATTRIBUTE_OPTION__ pgao using(product_id)') //货品 商品 属性选项表
                ->join('left join __GOODS_ATTRIBUTE_OPTION__ gao using(goods_attribute_option_id)')//商品 属性选项表
                ->join('left join __ATTRIBUTE_OPTION__ ao using(attribute_option_id)')//属性选项表
                ->join('left join __ATTRIBUTE__ a using(attribute_id)') //属性表
                ->where(['p.product_id' => ['in', $hasProduct]])
                ->group('p.product_id')
                ->select();
        }
        //将没有货品的 和 有货品的商品 合并
        $productList = array_merge(empty($nonProductList) ? [] : $nonProductList, !empty($hasProductList) ? $hasProductList : []);
        // 仅仅是商品信息, 建立一个的对应购物车中的key
        foreach($productList as $product)  {
            $key = $product['goods_id'] . '-' . (isset($product['product_id'])?$product['product_id']:'');
            $rows[$key] = $product;
        }

        // 将购买信息和商品信息合并到一起
        // 同时统计购物车信息
        $cart['total'] = 0;
        $cart['total_quantity'] = 0;
        foreach($this->wareList as $key=>$ware) {

            // 计算单价
            if (!is_null($ware['product_id'])) { //有货品
                switch($rows[$key]['price_drift']) {
                    case '+':   //本店售价加货品价格
                        $rows[$key]['real_price'] = $rows[$key]['price'] + $rows[$key]['product_price'];
                        break;
                    case '-':  //本店售价减货品价格
                        $rows[$key]['real_price'] = $rows[$key]['price'] -  $rows[$key]['product_price'];
                        break;
                    case '=': //使用货品价格
                        $rows[$key]['real_price'] = $rows[$key]['product_price'];
                        break;
                }
            } else { //无货品
                $rows[$key]['real_price'] = $rows[$key]['price'];
            }
            // 计算单品总价 同id 价格*数量
            $rows[$key]['total_price'] = $rows[$key]['real_price'] * $ware['buy_quantity'];

            // 生成商品URL
            $rows[$key]['url'] = U('/show/' . $rows[$key]['goods_id']);

            $wareList[$key] = array_merge($ware, $rows[$key]);

            // 购物车信息
            $cart['total_quantity'] += $ware['buy_quantity'];//总数量
            $cart['total'] += $rows[$key]['total_price']; //总价格
        }

        // 购物车统计信息
        return ['wareList'=>$wareList, 'cart'=>$cart];
    }

    //删除
    public function removeWare($key)
    {
        unset($this->wareList[$key]);
    }

    /**
     * 会员登陆同步刷新
     */
    public function memberRefresh()
    {
        // 当前会员可能存在商品
        $this->wareList;// 有可能存在数据, 从数据库中获取

        // 再判断, cookie中是否存在商品
        $cookieWareList = cookie('warelist') ? unserialize(cookie('warelist')) : [];

        // 合并数据表中获取的, 与cookie中获取
        // 遍历cookie中的商品, 判断是否在数据库中存在
        foreach($cookieWareList as $key=>$ware) {
            if (isset($this->wareList[$key])) {
                // 存在过,
                // 一: 累加数量即可
//                $this->wareList[$key]['buy_quantity'] += $ware['buy_quantity'];
                // 二: 取最大数量
                if($ware['buy_quantity'] > $this->wareList[$key]['buy_quantity']) {
                    $this->wareList[$key]['buy_quantity'] = $ware['buy_quantity'];
                }
                // 三: 保持会员数量(什么都不做即可)
            } else {
                // 不存在
                $this->wareList[$key] = $ware;
            }
        }

    }

}