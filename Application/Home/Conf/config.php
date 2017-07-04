<?php
return array(
	//'配置项'=>'配置值'
    'DEFAULT_CONTROLLER'  => 'Shop', //默认控制器
    'DEFAULT_ACTION'      => 'index', //默认方法

    'TMPL_ACTION_ERROR'   =>  'Common/error', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS' =>  'Common/success', // 默认成功跳转对应的模板文件
    //
    'URL_ROUTER_ON'       => true, // 开启自定义路由
    'URL_ROUTE_RULES'     => [ // 自定义路由规则

        'register'       => 'Member/register', // 路由到用户的注册动作
        'login'          => 'Member/login',// 登录
        'center'         => 'Member/center',
        //请求shop/category  携带参数 操作等于嵌套列表
        'category/nestedList'=>['Shop/category',['operate'=>'nestedList']], //请求分类嵌套列表 nested 嵌套
        'goods/new'      => ['Shop/goods', ['operate'=>'new']],//最新商品
        'goods/special'  => ['Shop/goods', ['operate'=>'special']],//特价商品
        'goods/promote'  => ['Shop/goods', ['operate'=>'promote']],//推荐商品
        'goods/show'     => ['Shop/goods', ['operate'=>'show']],//商品基本信息(商品, 货品, 相册, 及其关联数据)

        'show/:goods_id' => 'Shop/show', //商品详细页
        'breadcrumb'     => 'Shop/breadcrumb',//面包屑导航
        'addToCart'      => 'Buy/addToCart', //添加商品到购物车
        'removeFromCart' => 'Buy/removeFromCart',//删除商品
        'cartInfo'       => 'Buy/cartInfo', //获取购物车信息
        'cart'           => 'Buy/cart', //购物车详细页

        'checkout'       => 'Buy/checkout',//验证登陆
        'shippingList'   => 'Buy/shippingList', //货运方式列表
        'addressList'    => 'Member/addressList',// 获取会员的收货地址列表
        'childRegion'    => 'Member/childRegion',
        'addAddress'     => 'Member/addAddress',
        'updateQuantity' => 'Buy/updateQuantity',

        'order' => 'Buy/order', //
        'result'    => 'Buy/result', //
        'orderState'    => 'Buy/orderState',//
    ],
    'URL_MODEL' => 2, // URL模式

    'TMPL_PARSE_STRING' => [
        
    ],
);