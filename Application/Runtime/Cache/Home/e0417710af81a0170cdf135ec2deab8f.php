<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if IE]>
<![endif]-->
<!--[if IE 8 ]>
<html dir="ltr" lang="zh-CN" class="ie8">
<![endif]-->
<!--[if IE 9 ]>
<html dir="ltr" lang="zh-CN" class="ie9">
<![endif]-->
<!--[if (gt IE 9)|!(IE)]>
<!-->
<html dir="ltr" lang="zh-CN">
<!--<![endif]-->
<head>
    <meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>BuyPlus(败家Shopping）</title>
<meta name="description" content="BuyPlus(败家Shopping）" />
<meta name="keywords" content= "BuyPlus(败家Shopping）" />
<link href="/Public/Home/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="/Public/Home/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="/Public/Home/stylesheet/stylesheet.css" rel="stylesheet">
<link href="/Public/Home/owl-carousel/owl.carousel.css" type="text/css" rel="stylesheet" media="screen" />
<link href="/Public/Home/owl-carousel/owl.transitions.css" type="text/css" rel="stylesheet" media="screen" />
<link href="/Public/Home/image/cart.png" rel="icon" />
<script src="/Public/Home/javascript/jquery-1.11.3.min.js" type="text/javascript"></script>
    
</head>
<body>

<nav id="top">
    <div class="container">
        <div id="top-links" class="nav pull-right">
            <ul class="list-inline">
                <li>
                    <a href=""> <i class="fa fa-phone"></i>
                    </a>
                    <span class="hidden-xs hidden-sm hidden-md">123456789</span>
                </li>
                <li class="dropdown">
                    <a href="" title="会员中心" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-user"></i>
                        <span class="hidden-xs hidden-sm hidden-md">会员中心</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li>
                            <a href="<?php echo U('/register');?>">会员注册</a>
                        </li>
                        <li>
                            <a href="<?php echo U('/login');?>">会员登录</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="" id="wishlist-total" title="收藏（0）">
                        <i class="fa fa-heart"></i>
                        <span class="hidden-xs hidden-sm hidden-md">收藏（0）</span>
                    </a>
                </li>
                <li>
                    <a href="" title="购物车">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="hidden-xs hidden-sm hidden-md">购物车</span>
                    </a>
                </li>
                <li>
                    <a href="" title="结账">
                        <i class="fa fa-share"></i>
                        <span class="hidden-xs hidden-sm hidden-md">结账</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<header>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div id="logo">
                    <a href="">
                        <img src="/Public/Home/image/logo3.png" title="BuyPlus(败家Shopping）" alt="BuyPlus(败家Shopping）" class="img-responsive" />
                    </a>
                </div>
            </div>
            <div class="col-sm-8 mini-cart">
                <div id="cart">
                    <a href="" class="cart-info">
                  <span class="cart-icon">
                    <i class="fa fa-shopping-cart"></i>
                  </span>
                        <span id="cart-total"><span id="cart-total-quantity">0</span> 个商品 - ￥<span id="cart-total-price">0</span></span>
                    </a>
                    <ul id="ul-warelist" class="cart-content dropdown-menu hidden-sm hidden-xs">

                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    function refreshCart()
    {
        var url = "<?php echo U('/cartInfo');?>";
        var data = {};
        $.get(url, data, function(resp) {
            // 购物车信息
            var cart = resp.data.cart; //总数 和总价
            $('#cart-total-quantity').html(cart.total_quantity);
            $('#cart-total-price').html(cart.total);
            // 商品信息
            if (0 == cart.total_quantity) { //数量为0
                html = '<li><p class="text-center empty">您的购物车内没有商品！</p></li>';
            } else {
                html = '<li>' +
                        '<table class="table table-striped">' +
                        '<tbody>';
                //遍历购买到的商品列表
                $.each(resp.data.wareList, function(key, ware) {
                    html += '<tr><td class="text-center"><a href="' +
                            ware.url +'">' +
                            '<img src="/Public/Thumb/' +
                            ware.image_thumb +'" alt="" title="" style="max-height: 47px;" class="img-thumbnail">' +
                            '</a></td>' +
                            '<td class="text-left">' +
                            '<a href="' +
                            ware.url + '">' +
                            ware.name + '</a><br>' +
                            'x ' +
                            ware.buy_quantity;
                    if ('option' in ware) {
                        html += '<br>' + ware.option;
                    }
                    html += '</td>' +
                            '<td class="text-right">' +
                            '￥' + ware.total_price +
                            '<br><a class="remove" data-key="' +
                            key + '">移除</a>' +
                            '</td>' +
                            '</tr>';
                });
                html += '</tbody></table></li>';
            }

            // 其他的链接
            html += '<li><div><table class="table table-bordered"><tbody><tr><td class="text-right"><strong>商品总额</strong></td><td class="text-right">￥' +
                    cart.total + '</td></tr></tbody> </table>';
            html += '<p class="text-right"><a href="<?php echo U('/cart');?>"><strong><i class="fa fa-shopping-cart"></i>查看购物车</strong></a>&nbsp;&nbsp;&nbsp;<a href="<?php echo U('/checkout');?>"><strong><i class="fa fa-share"></i>去结账</strong></a></p></div></li>';

            $('#ul-warelist').empty().append(html);

            // 绑定删除事件
            $('#ul-warelist a.remove').click(function(evt) {
                var url = "<?php echo U('/removeFromCart');?>";
                var data = {
                    key: $(this).data('key'),
                };
                $.post(url, data, function(resp) {
                    refreshCart(); //刷新购物车
                }, 'json');
            });
        }, 'json');
    }

    $(function() {
        refreshCart(); //刷新购物车
    });

</script>

<div class="main-menu-wrapper">
    <div class="container">
        <div class="main-menu-mobile">
            菜单
            <span class="main-menu-toggle">
              <i class="fa fa-bars"></i>
            </span>
        </div>
        <div class="main-menu-container">
            <ul class="main-menu" id="ul-menu">
                <li class="parent">
                    <a href="<?php echo U('/');?>">首页</a>
                </li>
            </ul>
        </div>
        <div id="search" class="input-group">
            <input type="text" name="search" value="" placeholder="搜索" class="form-control" />
            <span class="input-group-btn">
              <button type="button" class="btn btn-primary">
                  <i class="fa fa-search"></i>
              </button>
            </span>
        </div>
    </div>
</div>



    <div class="container">
        <ul class="breadcrumb">
            <li><a href="<?php echo U('/');?>"><i class="fa fa-home"></i></a></li>
            <li><a href="<?php echo U('/cart');?>">购物车</a></li>
            <li><a href="javascript:;">结账</a></li>
        </ul>
        <div class="row">
            <div id="content" class="col-sm-12">
                <h1>结账</h1>
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapse-shipping-address" aria-expanded="false">第 1 步 货运地址 <i class="fa fa-caret-down"></i></a>
                            </h4>
                        </div>
                        <!-- <div class="panel-collapse collapse" id="collapse-shipping-address"> -->
                        <div id="collapse-shipping-address" class="panel-collapse collapse in" aria-expanded="true" style="">
                            <div class="panel-body">
                                <div class="radio">
                                    <label>
                                        <input type="radio" value="existing" name="shipping_address">
                                        使用现存地址</label>
                                </div>
                                <div id="shipping-existing" style="display: block;">
                                    <select class="form-control" name="address_id" id="select-address_id">
                                    </select>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" value="new" name="shipping_address">
                                        添加一个新地址</label>
                                </div>
                                <br>
                                <div style="display:none;" id="shipping-new">
                                    <form action="" id="form-address" class="form-horizontal">


                                        <div class="form-group required">
                                            <label for="input-shipping-name" class="col-sm-2 control-label">您的姓名</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="input-shipping-name" placeholder="您的姓名" value="" name="name">
                                            </div>
                                        </div>
                                        <div data-sort="1" class="form-group required custom-field">
                                            <label for="input-telephone" class="col-sm-2 control-label">手机号码</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="input-telephone" placeholder="手机号码" value="" name="telephone">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-company" class="col-sm-2 control-label">公司名称</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="input-company" placeholder="公司名称" value="" name="company">
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label for="input-region-level-1" class="col-sm-2 control-label">省/直辖市</label>
                                            <div class="col-sm-2">
                                                <select class="form-control" id="input-region-level-1" name="region_one_id" data-level="1">
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <select class="form-control" id="input-region-level-2" name="region_two_id" data-level="2"></select>
                                            </div>

                                            <div class="col-sm-2">
                                                <select class="form-control" id="input-region-level-3" name="region_three_id" data-level="3"></select>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="input-address" placeholder="地址" value="" name="address">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-postcode" class="col-sm-2 control-label">邮编</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="input-postcode" placeholder="邮编" value="" name="postcode">
                                            </div>
                                        </div>

                                    </form>

                                </div>

                                <div class="buttons clearfix">
                                    <div class="pull-right">
                                        <input type="button" class="btn btn-primary" data-loading-text="正在加载..." id="button-shipping-address" value="确定添加">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapse-shipping-method" aria-expanded="false">第 2 步 货运方式 <i class="fa fa-caret-down"></i></a></h4>
                        </div>
                        <div id="collapse-shipping-method" class="panel-collapse collapse" aria-expanded="false" style="">
                            <div class="panel-body"><p id="p-shipping-list">请选择一个货运方式。</p>
                                <p><strong>添加订单备注</strong></p>
                                <p>
                                    <textarea class="form-control" rows="8" name="comment"></textarea>
                                </p>
                                <div class="buttons">
                                    <div class="pull-right">
                                        <input type="button" class="btn btn-primary" data-loading-text="正在加载..." id="button-shipping-method" value="继续">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapse-payment-method" aria-expanded="false">第 3 步 支付方式 <i class="fa fa-caret-down"></i></a></h4>
                        </div>
                        <div id="collapse-payment-method" class="panel-collapse collapse" aria-expanded="false" style="">
                            <div class="panel-body"><p>请选择一个支付方式。</p>
                                <div class="radio">
                                    <label>
                                        <input type="radio" value="bank_transfer" name="payment_method">
                                        银行转账      </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" checked="checked" value="cod" name="payment_method">
                                        货到付款      </label>
                                </div>
                                <p><strong>添加订单备注</strong></p>
                                <p>
                                    <textarea class="form-control" rows="8" name="comment"></textarea>
                                </p>
                                <div class="buttons">
                                    <div class="pull-right">我已经阅读并同意 <a alt="条款及条件" href="http://php.kang.com/test/s/index.php?route=information/information/agree&amp;information_id=5" class="colorbox"><b>条款及条件</b></a> 条款        <input type="checkbox" value="1" name="agree">
                                        &nbsp;
                                        <input type="button" class="btn btn-primary" data-loading-text="正在加载..." id="button-payment-method" value="继续">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a class="accordion-toggle" data-parent="#accordion" data-toggle="collapse" href="#collapse-checkout-confirm" aria-expanded="true">第 4 步 确认订单 <i class="fa fa-caret-down"></i></a></h4>
                        </div>
                        <div id="collapse-checkout-confirm" class="panel-collapse collapse" aria-expanded="false" style="">
                            <div class="panel-body"><div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <td class="text-left">商品名称</td>
                                        <td class="text-left">型号</td>
                                        <td class="text-right">数量</td>
                                        <td class="text-right">价格</td>
                                        <td class="text-right">合计</td>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td class="text-right" colspan="4"><strong>商品总额:</strong></td>
                                        <td class="text-right">￥<span id="total_price"></span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="4"><strong><span id="span-shippingTitle"></span>:</strong></td>
                                        <td class="text-right">￥<span id="span-shippingFee"></span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="4"><strong>订单总额:</strong></td>
                                        <td class="text-right">￥<span id="span-order_total"></span></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                                <div class="buttons">
                                    <div class="pull-right">
                                        <input type="button" data-loading-text="正在加载..." class="btn btn-primary" id="button-confirm" value="确认订单">
                                    </div>
                                </div>
                                <script type="text/javascript"></script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                <h5>信息咨询</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="">关于我们</a>
                    </li>
                    <li>
                        <a href="">最新公告</a>
                    </li>
                    <li>
                        <a href="">隐私政策</a>
                    </li>
                    <li>
                        <a href="">条款及条件</a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-2">
                <h5>客户服务</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="">联系我们</a>
                    </li>
                    <li>
                        <a href="">退换服务</a>
                    </li>
                    <li>
                        <a href="">网站地图</a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-2">
                <h5>其他</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="">品牌专区</a>
                    </li>
                    <li>
                        <a href="">礼品券</a>
                    </li>
                    <li>
                        <a href="">加盟会员</a>
                    </li>
                    <li>
                        <a href="">特别优惠</a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-2">
                <h5>会员中心</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="">会员中心</a>
                    </li>
                    <li>
                        <a href="">历史订单</a>
                    </li>
                    <li>
                        <a href="">收藏列表</a>
                    </li>
                    <li>
                        <a href="">订阅咨询</a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-4">
                <h5>联系我们</h5>
                <ul class="list-unstyled">
                    <li>
                        <div class="icon">
                            <span class="fa fa-map-marker">&nbsp;</span>
                        </div>
                        <div class="text">科技有限公司</div>
                    </li>
                    <li>
                        <div class="icon">
                            <span class="fa fa-phone">&nbsp;</span>
                        </div>
                        <div class="text">123456789</div>
                    </li>
                    <li>
                        <div class="icon">
                            <span class="fa fa-envelope">&nbsp;</span>
                        </div>
                        <div class="text">kang@kang.com</div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="powered">
            BuyPlush(败家Shopping) &copy; 2016
            <a href="http://www.miitbeian.gov.cn/" target="_blank">京ICP备12345678号</a>
        </div>
    </div>
    <div class="go-top">
        <a href="#" class="scroll-top">
            <i class="fa fa-angle-up"></i>
            TOP
        </a>
    </div>
</footer>


<script src="/Public/Home/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Public/Home/javascript/common.js" type="text/javascript"></script>
<script src="/Public/Home/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#slideshow0').owlCarousel({
            items: 1, //显示数量
            loop: true, //循环滚动
            autoplay: true, //自动播放
            autoplayTimeout: 3000, //自动切换时间（毫秒）
            autoplayHoverPause: true, //鼠标移动到图片上面时，是否暂停自动播放
            autoplaySpeed: 300, //自动播放图片切换动画时长
            navSpeed: 400, //左右切换按钮图片切换动画时长
            dotsSpeed: 300, //点击图片下方黑点图片切换动画时长
            nav: true, //是否显示左右切换按钮
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'], //左右切换按钮图标
            dots: true, //是否显示图片下方黑点
        });
    });
</script>



<script>
    //    分类菜单的处理
    $(function() {
        // ajax获取菜单分类数据
        var url = "<?php echo U('/category/nestedList');?>";
        var data = {};
        $.get(url, data, function(resp) {
            //console.log(resp);
            // 拼凑HTML
            if (resp.error != 0) { // 存在错误//
                // console.log(resp.errorInfo);
                return ;
            }

            var liHtml = '';
            // 遍历所有的顶级分类
            $.each(resp.data, function(i, one) { // one 1级分类
                liHtml += '<li class="parent with-sub-menu">';
                liHtml += '<a href="">' + one.title +'</a>';
                liHtml += '<div class="open-sub-menu">+</div>';

                // 存在2级分类
                if(one.children.length > 0) {
                    liHtml += '<ul class="sub-menu">';
                    // 遍历2级分类
                    $.each(one.children, function(ii, two){ // two 2级分类
                        liHtml += '<li>';
                        liHtml += '<a href="">' + two.title + '</a>';
                        liHtml += '<div class="open-sub-menu">+</div>';

                        //判断是否存在3级分类
                        if (two.children.length > 0) { // 存在

                            liHtml += '<ul class="second-menu">';
                            // 遍历
                            $.each(two.children, function(iii, three) {
                                liHtml += '<li><a href="">' + three.title + '</a></li>';
                            });
                            liHtml += '</ul>';
                        }
                        liHtml += '</li>';
                    });
                    liHtml += '</ul>';
                }
                liHtml += '</li>';
            });

            // 加入到指定位置
            $('#ul-menu').append(liHtml);

            // 移动展示菜单 鼠标穿过元素事件
            $('.sub-menu>li').mouseenter(function(e){
                $(this).parent().find('ul.second-menu').hide().eq($(this).index()).show();
            });
        }, 'json');
    });
</script>



    <script>
        $(function() {
            // 获取当前会员的收货地址
            var url = "<?php echo U('/addressList');?>";
            var data = {};
            $.get(url, data, function(resp){
                if (resp.error != 0) {
                    //未登录，打印错误信息
                    console.log(resp.errorInfo);
                    return ;
                }
                var addressList = resp.data;
               // console.log(addressList);
                if (addressList.length == 0) {
                    // 没有地址, 需要增加新地址   prop设置属性和值
                    $(':radio[name=shipping_address][value=existing]').prop('checked', false); //取消选中
                    $(':radio[name=shipping_address][value=new]').prop('checked', true);//添加选中
                    $('#shipping-new').show();
                } else {
                    // 如果存在地址, 将地址的option列表展示
                    var html = '';
                    $.each(addressList, function(i, address) {  //遍历列表
                        html += '<option value="' + address.address_id + '"'; //选项值为地址id
                        if (address.is_default == '1') { //判断是否为默认选中值 添加默认选中
                            html += " selected";
                        }
                        //拼接姓名  电话 地址
                        html += '>' + address.name + ',' + address.telephone + ',' + address.address + '</option>';
                    });
                    //追加到页面
                    $('#select-address_id').append(html);

                    $(':radio[name=shipping_address][value=existing]').prop('checked', true);//选中
                    $(':radio[name=shipping_address][value=new]').prop('checked',false);//新添地址不选中


                }

            }, 'json');

            //点击新添地址后展示
            $(':radio[name=shipping_address][value=new]').click(function() {
                $('#shipping-new').show();
                $("#select-address_id").hide();
            });
            //点击列表隐藏添加页
            $(':radio[name=shipping_address][value=existing]').click(function() {
                $('#shipping-new').hide();
                $("#select-address_id").show();
            });
        });
    </script>

    <script>
        /**
         * 查找某个父地区下所有的子地区
         * @param parent_id
         * @return 地区列表数组
         */
        function childRegion(parent_id)
        {
            var url = "<?php echo U('/childRegion');?>";
            var data = {
                parent_id: parent_id,
            };
            var list = [];
            $.ajax({
                async: false, // 非异步
                url: url,
                type: 'get',
                data: data,
                dataType: 'json',
                success: function (resp) {
                    if (resp.error != 0) {
                        console.log(resp.errorInfo);
                        list = [];
                    } else {
                        list = resp.data;
                    }
                }
            });

            return list;
        }
        // 以那个为paernt_id获取数据, 以此填充level为几的下拉列表
        function setRegion(parent_id, level) {
            // 一: 利用parent_id获取子地区
            var regionList = childRegion(parent_id);

            // 二: 利用子地区, 填充地区选择下拉列表
            var html = '<option value="-1"> --- 请选择 --- </option>';
            $.each(regionList, function(i, region) {
                html += '<option value="' + region.region_id + '">' + region.title + '</option>' + '\n';
            });

            $('#input-region-level-'+level).empty().append(html);

            // 三: 重置后边的级别
            for(var l=level+1, t=3; l<=t; ++l) {
                $('#input-region-level-'+l).empty().append('<option value="-1"> --- 请选择 --- </option>');
            }
        }
        // c初始化时, 填充1级地区, 使用1为parent_id
        $(function() {
            // 初始化1级地区
            setRegion(1, 1);

            // 绑定列表的change事件
            $('select[id^=input-region-level-]').change(function(evt) {
                // 如果切换到请选择, 不做任何操作
                if ($(this).val() == "-1") {
                    return ;
                }
                // 利用当前选择的ID, 获取子地区, 填充下个level的列表
                setRegion($(this).val(), parseInt($(this).data('level'))+1);
            });
        });
    </script>

    <script>
        // 添加新地址
        $('#button-shipping-address').click(function(evt) {
            // 收集表单数据
            var data = new FormData(document.getElementById('form-address'));

            // 发出ajax请求
            var url = "<?php echo U('/addAddress');?>";
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: data,// new FormData, 不需要再处理
                processData: false, // 不再处理
                contentType: false, // 不要处理
                success: function(resp) {
                    document.getElementById('form-address').reset();
                    $('#shipping-new').hide();

                    // 如果存在地址, 将地址的option列表展示
                    var html = '';
                    addressList = resp.data;
                    $.each(addressList, function(i, address) {
                        html += '<option value="' + address.address_id + '"';
                        if (address.is_default == '1') {
                            html += " selected";
                        }
                        html += '>' + address.name + ',' + address.telephone + ',' + address.address + '</option>';
                    });
                    $('#select-address_id').empty().append(html);
                    $(':radio[name=shipping_address][value=existing]').prop('checked', true);
                    $(':radio[name=shipping_address][value=new]').prop('checked', false);

                }
            });

            evt.preventDefault(); //阻止默认行为
        })

    </script>

    <script>
        //刷新 货运名称 及运费
        function flushShippingFee()
        {
            var shippingInput = $(':radio[name=shipping_method]:checked:eq(0)');
            $('#span-shippingTitle').html(shippingInput.data('title'));
            $('#span-shippingFee').html(shippingInput.data('price'));
        }
    </script>


    <script>
        $(function(){

//            获取配送方式
            var url = "<?php echo U('/shippingList');?>";
            var data = {};
            $.get(url, data, function(resp) {


                if (resp.error != 0) {
                    return ;
                }

                var html = '';
                $.each(resp.data, function(i, shipping) {
                    html += '<p><strong>' +
                            shipping.title +'</strong></p><div class="radio"><label><input type="radio"';
                    if (i == 0) {
                        html += 'checked';
                    }
                    html += ' value="' +
                            shipping.key+'" name="shipping_method" data-price="' +
                            shipping.price + '" data-title="' +
                            shipping.title + '">' +
                            shipping.price + '</label></div>';
                });
                $('#p-shipping-list').after(html);

                // 绑定 radio的cick事件
                $(':radio[name=shipping_method]').click(function(evt) {
                    flushShippingFee();
                    flushOrderTotal();
                });

                flushShippingFee();

            }, 'json');
        });
    </script>

    <script>
        //刷新总金额
        function flushOrderTotal()
        {
            var shippingFee = $(':radio[name=shipping_method]:checked:eq(0)').data('price');// 运费
            var orderTotal = parseFloat(shippingFee) + parseFloat(wareTotal);
            $('#span-order_total').html(orderTotal);
        }
    </script>

    <script>
        // 获取订单商品信息
        $(function() {
            var url ="<?php echo U('/cartInfo');?>";
            var data = {};
            $.get(url, data, function(resp) {
                if (resp.error != 0) {
                    return ;
                }
                var wareList = resp.data.wareList;
                var html = '';
                //遍历列表
                $.each(wareList, function(i, ware) {
                    html += '<tr><td class="text-left"><a href="' +
                            ware.url + '">' +
                            ware.name + '</a></td>' +
                            '<td class="text-left">' +
                            (ware.option || '') + '</td><td class="text-right">' +
                            ware.buy_quantity + '</td><td class="text-right">￥' +
                            ware.real_price + '</td><td class="text-right">￥' +
                            ware.total_price + '</td></tr>';
                });
                $('#collapse-checkout-confirm table tbody').append(html);

                var cart = resp.data.cart;
                $('#total_price').html(cart.total);

                wareTotal = cart.total;// 全局的商品总金额

                // 刷新订单总金额
                flushOrderTotal();
            },'json');
        })
    </script>

    <script>
        $(function(){
            $('#button-confirm').click(function(evt){
                // 收集订单的必要信息
                var data = {
                    'address_id': $('#select-address_id').val(),//地址信息
                    'shipping_method_key': $(':radio[name=shipping_method]:checked:eq(0)').val(),//货运方式
                    'payment_method_key': $(':radio[name=payment_method]:checked:eq(0)').val(),//支付方式
                    'shipping_comment': $('#textarea-shipping_comment').val(),//货运备注
                    'payment_comment': $('#textarea-payment_comment').val(),//支付备注
                };
                // ajax请求加入订单队列
                var url = '<?php echo U("/order");?>';
                $.post(url, data, function(resp) {
                    if (resp.error != 0) {
                        return ;
                    }
                    // 跳转到等待页面
                    location.href = '<?php echo U("/result");?>';
                }, 'json');
            });
        })
    </script>


</body>
</html>