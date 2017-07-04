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
            <li>
                <a href="">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li>
                <a href="javascript:;">购物车内的商品</a>
            </li>
        </ul>
        <div class="row">
            <div id="content" class="col-sm-12">
                <h1>购物车内的商品 &nbsp;(0.00kg)</h1>
                <div class="table-responsive" id="div-wareList">



                </div>

                <div class="row">
                    <div class="col-sm-4 col-sm-offset-8">
                        <table class="table table-bordered">
                            <tr>
                                <td class="text-right"> <strong>商品总额:</strong>
                                </td>
                                <td class="text-right">￥<span id="cart_total_price"></span></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="buttons">
                    <div class="pull-left">
                        <a href="<?php echo U('/');?>" class="btn btn-default">继续购物</a>
                    </div>
                    <div class="pull-right">
                        <a href="<?php echo U('/checkout');?>" class="btn btn-primary">去结账</a>
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
            var url = "<?php echo U('/cartInfo');?>";// http://圆通/订单进度查询
            var data = {};
            $.get(url, data, function(resp) {
                // 购物车信息
                var cart = resp.data.cart;
                $('#cart-total-quantity').html(cart.total_quantity);
                $('#cart-total-price').html(cart.total);

                if (cart.total_quantity == 0) {
                    // 当前购物车没有商品, 回到首页
                    location.href = "<?php echo U('/');?>";
                }

                // 购物车有商品
                var html = '<table class="table table-bordered"><thead><tr><td class="text-center">图片</td><td class="text-left">商品名称</td><td class="text-left">型号</td><td class="text-left">数量</td><td class="text-right">单价</td><td class="text-right">总计</td></tr></thead><tbody>';
                var wareList = resp.data.wareList;
                $.each(wareList, function(key, ware) {
                    html += '<tr><td class="text-center"><a href="' +
                            ware.url + '"><img src="/Public/Thumb/' +
                            ware.image_thumb + '" alt="" title="2" class="img-thumbnail" style="max-height: 47px;"/></a>' +
                            '</td><td class="text-left"><a href="' +
                            ware.url + '">' +
                            ware.name + '</a></td><td class="text-left">' +
                            ware.option + '</td><td class="text-left"><div class="input-group btn-block" style="max-width: 200px;"><input type="text" name="" value="' +
                            ware.buy_quantity + '" size="1" class="form-control" id="input-ware-' +
                            key + '"/><span class="input-group-btn"><button type="button" data-toggle="tooltip" title="更新" class="btn btn-primary button-ware-refresh" data-key="' +
                            key + '"><i class="fa fa-refresh"></i></button><button type="button" data-toggle="tooltip" title="移除" class="btn btn-danger"><i class="fa fa-remove"></i></button></span></div></td><td class="text-right">￥' +
                            ware.real_price + '</td><td class="text-right">￥' +
                            ware.total_price+'</td></tr>';
                });

                html  += '</tbody></table>';

                $('#div-wareList').empty().append(html);

                $('#cart_total_price').html(cart.total);

                // 更新事件
                $('.button-ware-refresh').click(function(evt) {
                    var url = '<?php echo U("/updateQuantity");?>';
                    var key = $(this).data('key');
                    var data = {
                        key: key,
                        buy_quantity: $('#input-ware-' + key).val(),
                    };
                    $.post(url, data, function(resp){
                        alert('更新成功');
                    }, 'json');

                });

            });
        });
    </script>

</body>
</html>