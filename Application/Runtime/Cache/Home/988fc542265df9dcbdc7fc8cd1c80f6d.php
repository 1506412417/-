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
<link href="/php4/buyplus/Public/Home/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="/php4/buyplus/Public/Home/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="/php4/buyplus/Public/Home/stylesheet/stylesheet.css" rel="stylesheet">
<link href="/php4/buyplus/Public/Home/owl-carousel/owl.carousel.css" type="text/css" rel="stylesheet" media="screen" />
<link href="/php4/buyplus/Public/Home/owl-carousel/owl.transitions.css" type="text/css" rel="stylesheet" media="screen" />
<link href="/php4/buyplus/Public/Home/image/cart.png" rel="icon" />
<script src="/php4/buyplus/Public/Home/javascript/jquery-1.11.3.min.js" type="text/javascript"></script>
    
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
                        <img src="/php4/buyplus/Public/Home/image/logo3.png" title="BuyPlus(败家Shopping）" alt="BuyPlus(败家Shopping）" class="img-responsive" />
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
                            '<img src="/php4/buyplus/Public/Thumb/' +
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
        <ul class="breadcrumb" id="ul-breadcrumb">
            <li>
                <a href="/php4/buyplus">
                    <i class="fa fa-home"></i>
                </a>
            </li>

            <li>
                <a href="#" id="a-breadcrumb-goods"></a>
            </li>
        </ul>
        <div class="row">
            <div id="content" class="product-detail col-sm-12">
                <div class="row">
                    <div class="col-sm-5">
                        <!--elevate zoom start-->
                        <div class="elevate-zoom-wrapper">
                            <div class="elevate-zoom-preview">
                                <a href="javascript:;">
                                    <img style="display:none;" id="elevate-zoom" src="" data-zoom-image="" class="img-responsive">
                                </a>
                                <!--  vcxcxcx     -->
                            </div>
                            <div id="product-thumbnail-gallery">
                            </div>
                        </div>
                        <!--elevate zoom end--> </div>
                    <div class="col-sm-7 product-info">
                        <h1></h1>
                        <ul class="product-brief-wrapper">
                            <li>
                                <span>型  号</span>
                                9521
                            </li>
                            <li>
                                <span>奖励积分</span>
                                42
                            </li>
                            <li>
                                <span>库存状态</span>
                                <span id="span-stock_status"></span>
                            </li>
                        </ul>
                        <div class="product-price-wrapper">
                            <span class="price-new">￥<span id="price-new-value"></span></span>
                            <span class="price-old">￥<span id="price-old-value"></span></span>
                            <!-- <span>消费积分 100</span> -->
                        </div>
                        <hr>
                        <div id="product">
                            <!--<h3>货品</h3>-->
                            <div class="form-group required" id="div-product" style="display: none;">
                                <label class="control-label">货品</label>
                                <div id="div-product-list">
                                </div>
                            </div>
                            <!--<h3>配件</h3>-->
                            <div class="form-group required">
                                <label class="control-label">配件</label>
                                <div id="input-option233">
                                    <label class="checkbox">
                                        <input type="checkbox" name="option[233][]" value="27" />
                                        <span>耳机</span>
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="option[233][]" value="25" />
                                        <span>充电器</span>
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="option[233][]" value="26" />
                                        <span>保护膜</span>
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="option[233][]" value="24" />
                                        <span>数据线</span>
                                    </label>
                                </div>
                            </div>
                            <hr>
                            <div class="product-cart-action">
                                <div class="quantity-input-wrapper">
                                    <input type="text" name="quantity" value="1" placeholder="数量" id="input-quantity" class="form-control" />
                                    <a href="#" class="quantity-up">+</a>
                                    <a href="#" class="quantity-down">-</a>
                                </div>
                                <button type="button" id="button-cart" data-loading-text="正在加载..." class="btn btn-primary">加入购物车</button>
                                <input type="hidden" name="product_id" value="61" />
                            </div>
                        </div>
                        <div class="wishlist-share">
                            <a onclick="wishlist.add('61');">
                                <i class="fa fa-heart"></i>
                                收藏
                            </a>
                            <a onclick="compare.add('61');">
                                <i class="fa fa-link"></i>
                                对比
                            </a>
                        </div>
                        <div class="rating">
                            <p>
                    <span class="fa fa-stack">
                      <i class="fa fa-star on fa-stack-1x"></i>
                    </span>
                                <span class="fa fa-stack">
                      <i class="fa fa-star on fa-stack-1x"></i>
                    </span>
                                <span class="fa fa-stack">
                      <i class="fa fa-star on fa-stack-1x"></i>
                    </span>
                                <span class="fa fa-stack">
                      <i class="fa fa-star on fa-stack-1x"></i>
                    </span>
                                <span class="fa fa-stack">
                      <i class="fa fa-star off fa-stack-1x"></i>
                    </span>
                                <a href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">0 评价</a>
                                /
                                <a href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">如果您对本商品有什么问题或经验，请在此留下您的意见和建议！</a>
                            </p>
                            <hr>
                            <!-- Baidu Share BEGIN -->
                            <div class="bdsharebuttonbox">
                                <a href="#" class="bds_more" data-cmd="more">分享到：</a>
                                <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间">QQ空间</a>
                                <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博">新浪微博</a>
                                <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博">腾讯微博</a>
                                <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网">人人网</a>
                                <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信">微信</a>
                            </div>
                            <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{"bdSize":16}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
                            <!-- Baidu Share END -->
                        </div>
                    </div>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab-description" data-toggle="tab">商品描述</a>
                    </li>
                    <li>
                        <a href="#tab-specification" data-toggle="tab">商品属性</a>
                    </li>
                    <li>
                        <a href="#tab-review" data-toggle="tab">商品评价 (已有N条评价)</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-description">
                        <img src="image/catalog/gd/product/yanjing3-xq1.jpg">
                    </div>

                    <div class="tab-pane" id="tab-specification">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td colspan="2"> <strong>Processor</strong>
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Clockspeed</td>
                                <td>100mhz</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane" id="tab-review">
                        <form class="form-horizontal" id="form-review">
                            <div id="review"></div>
                            <h2>如果您对本商品有什么问题或经验，请在此留下您的意见和建议！</h2>
                            <div class="form-group required">
                                <div class="col-sm-12">
                                    <label class="control-label" for="input-name">您的姓名</label>
                                    <input type="text" name="name" value="" id="input-name" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group required">
                                <div class="col-sm-12">
                                    <label class="control-label" for="input-review">您的评价</label>
                                    <textarea name="text" rows="5" id="input-review" class="form-control"></textarea>
                                    <div class="help-block">
                                        <span class="text-danger">注意</span>
                                        评论内容不支持HTML代码！
                                    </div>
                                </div>
                            </div>
                            <div class="form-group required">
                                <div class="col-sm-12">
                                    <label class="control-label">顾客评分</label>
                                    &nbsp;&nbsp;&nbsp; 差评&nbsp;
                                    <input type="radio" name="rating" value="1" />
                                    &nbsp;
                                    <input type="radio" name="rating" value="2" />
                                    &nbsp;
                                    <input type="radio" name="rating" value="3" />
                                    &nbsp;
                                    <input type="radio" name="rating" value="4" />
                                    &nbsp;
                                    <input type="radio" name="rating" value="5" />
                                    &nbsp;好评
                                </div>
                            </div>
                            <div class="buttons clearfix">
                                <div class="pull-right">
                                    <button type="button" id="button-review" data-loading-text="正在加载..." class="btn btn-primary">继续</button>
                                </div>
                            </div>
                        </form>
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


<script src="/php4/buyplus/Public/Home/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/php4/buyplus/Public/Home/javascript/common.js" type="text/javascript"></script>
<script src="/php4/buyplus/Public/Home/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>

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
        // 全局数据的初始化
        $(function() {
            goods_id = <?php echo ($goods_id); ?>;
        });
    </script>

    <script>
        // 初始化 面包屑导航
        $(function() {
            var url = "<?php echo U('/breadcrumb');?>";
            var data = {
                goods_id: goods_id,
            };
            $.get(url, data, function(resp) {
                if (resp.error != 0) {
                    console.log(resp.errorInfo);
                    return ;
                }

                var html = '';
                $.each(resp.data, function(i, row) {
                    html += '<li>' +
                            '<a href="' +
                            row.url +
                            '">' +
                            row.title +
                            '</a>' +
                            '</li>';
                });
                // 在第一个li后, 插入分类的导航
                $('#ul-breadcrumb>li:eq(0)').after(html);


            }, 'json');
        });
    </script>

    <script src="/php4/buyplus/Public/Home/elevateZoom/jquery.elevateZoom.min.js"></script>
    <script src="/php4/buyplus/Public/Home/fancybox/jquery.fancybox.pack.js"></script>

    <script>
        // 商品基本信息(商品, 货品, 相册, 及其关联数据)
        $(function(){
            var url = "<?php echo U('/goods/show');?>";
            var data = {
                goods_id: goods_id,
            };
            $.get(url, data, function(resp) {
                if (resp.error != 0) {
                    console.log(resp.errorInfo);
                    return ;
                }

                var goods = resp.data;
               // console.log(goods);
                // 填充
                $('#a-breadcrumb-goods').html(goods.name);

                // 展示相册部分
                var galleryList = goods.galleryList;
                if (galleryList.length > 0) {
                    // 存在相册图像
                    // 展示第一张初始图像 中图
                    $('#elevate-zoom').attr('src', '/php4/buyplus/Public/Thumb/' + galleryList[0].image_medium).data('zoom-image', '/php4/buyplus/Public/Thumb/' +galleryList[0].image_big).show();

                    // 遍历展示所有的小图
                    var html = '';
                    $.each(galleryList, function(i, gallery) {
                        html += '<a data-zoom-image="/php4/buyplus/Public/Thumb/' +
                                gallery.image_big + '" data-image="/php4/buyplus/Public/Thumb/' +
                                gallery.image_medium + '" data-upate="" class="elevatezoom-gallery';
                        if (0 == i) {
                            html += ' active';
                        }
                        html += '" href="/php4/buyplus/Public/Thumb/' +
                                gallery.image_big + '">';
                        html += '<img src="/php4/buyplus/Public/Thumb/' +
                                gallery.image_small + '" width="60">';
                        html += '</a>';
                    });

                    $('#product-thumbnail-gallery').html(html);

                    // 触发放大镜插件

                    if ($(window).width() >= 768) {
                        // 如果窗口 大于768, 则触发 elevateZoom插件
                        $('#elevate-zoom').elevateZoom({
                            zoomWindowFadeIn: 500,//镜头窗口淡入速度
                            zoomWindowFadeOut: 500,//镜头窗口淡出速度
                            lensFadeIn: 500,//透镜淡入速度
                            lensFadeOut: 500,//透镜淡出速度
                            // lensShape: 'basic',
                            // lensSize: 150,
                            zoomWindowOffetx: 10,
                            // zoomWindowWidth: 450,
                            // zoomWindowHeight: 450,
                            borderSize: 1,
                            borderColour: '#eaeaea',
                            gallery: 'product-thumbnail-gallery',
                            galleryActiveClass: 'active',
                            cursor:'pointer',
                        });

                        // 支持 点击的fancybox灯箱
//                        $('#elevate-zoom').bind('click', function(e) {
//                            var ez = $('#elevate-zoom').data('elevateZoom');
//                            $.fancybox(ez.getGalleryList());
//                            return false;
//                        });
                    } else {
                        $('.elevatezoom-gallery').fancybox();
                        $('.elevate-zoom-preview a').bind('click', function(e) {
                            $('.elevatezoom-gallery').eq(0).trigger('click');
                            return false;
                        });
                    }

                } else {
                    // 没有相册图像
                    $('#elevate-zoom').attr('src', '/php4/buyplus/Public/Thumb/' + goods.image_thumb).show();
                }

                // 商品信息
                $('.product-info:eq(0) > h1').html(goods.name);

                $('#span-stock_status').html(goods.stock_status_title);

                $('#price-new-value').html(goods.price);
                $('#price-old-value').html(goods.market_price);

                // 货品的展示
                productList = goods.productList;
                if (productList.length > 0) {
                    var html = '';
                    $.each(productList, function(i, product) {
                        html += '<label class="radio product">' +
                                '<input type="radio" name="product_id" value="' +
                                product.product_id + '"';
                        if (product.promoted == '1') {
                            html += ' checked';
                        }
                        html +='/><span>' +
                                product.option + '</span></label>&nbsp;';
                        // 当前是否为默认货品, 影响价格
                        if (product.promoted == '1') {
                            updatePrice(goods, product);
                        }
                    });
                    // 加入到货品列表
                    $('#div-product-list').append(html);
                    $('#div-product').show();

                    // 增加事件监听
                    $('label.product').click(function(evt) {
                        var currProductId = $(this).find(':radio').eq(0).val();

                        var currProduct;
                        $.each(productList, function(i, product) {
                            if(product.product_id == currProductId) {
                                currProduct = product;
                                return false;
                            }
                        });
                        updatePrice(goods, currProduct);

//                        evt.preventDefault();// 取消默认
//                        evt.stopPropagation();// 阻止传播
                    });


                } else {
                    // 没有货品
                }

                // 五, 属性列表
                var html = '';
                $.each(attributeList=goods.attributeList, function(i, attribute) {
                    html += '<tr><td>' +
                            attribute.attribute_title + '</td><td>';
                    if (attribute.attribute_type_title == 'text') {
                        html += attribute.value;
                    } else {
                        html += attribute.valuelist;
                    }
                    html += '</td></tr>';
                });

                $('#tab-specification>table>tbody').append(html);

                // 六, 商品描述
                $('#tab-description').append(goods.description);

            }, 'json');
        });

        function updatePrice(goods, product)
        {
            goods.price = Number(goods.price);
            product.product_price = Number(product.product_price);
            switch (product.price_drift) {
                case '+':
                    var price = goods.price + product.product_price;
                    break;
                case '-':
                    var price = goods.price - product.product_price;
                    break;
                case '=':
                    var price = product.product_price;
                    break;
                default:
                    var price = goods.price;
                    break;
            }
            $('#price-new-value').html(price);
        }
    </script>
    <script>
        // 添加到购物车
        $(function(){
            $('#button-cart').click(function(evt) {
                var url = "<?php echo U('/addToCart');?>";
                var data = {
                    goods_id: goods_id, //商品id
                    //表单过滤选择器 找到所有单选框中 name=product的且有checked属性单选框  的值
                    product_id: $(':radio[name=product_id]:checked').val(), //货品id
                    buy_quantity: $('#input-quantity').val(), //购买数量
                };
                $.post(url, data, function(resp) {
                    if (resp.error != 0) {
                        console.log(resp.errorInfo);
                        return ;
                    }

                    refreshCart();// 刷新右上角的购物车即可, 独立的, 在多数页面都需要使用的
                    $(window).scrollTop(10);
                }, 'json');

                evt.preventDefault(); //阻止默认
            });

            $('.quantity-up').click(function(evt){
                var quantity=$('#input-quantity').val();
                $('#input-quantity').val(parseInt(quantity)+1);
            });
            $('.quantity-down').click(function(evt){
                var quantity=$('#input-quantity').val();
                if(quantity>1) {
                    $('#input-quantity').val(quantity - 1);
                }
            });
        })
    </script>

</body>
</html>