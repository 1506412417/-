<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html dir="ltr" lang="zh-CN">
<head>
  <meta charset="UTF-8" />
  <title>控制面板</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <link href="/Public/Back/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet" />
  <link href="/Public/Back/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
  <link href="/Public/Back/summernote/summernote.css" rel="stylesheet" />

  <link href="/Public/Back/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
  <link type="text/css" href="/Public/Back/stylesheet/stylesheet.css" rel="stylesheet" media="screen" />
  
</head>
<body>
  <div id="container">
    <header id="header" class="navbar navbar-static-top">
      <div class="navbar-header">
        <a type="button" id="button-menu" class="pull-left"> <i class="fa fa-indent fa-lg"></i>
        </a>
        <a href="" class="navbar-brand">
          <img src="/Public/Back/image/logo.png" alt="BuyPlus" title="BuyPlus" />
        </a>
      </div>
      <ul class="nav pull-right">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown">
            <span class="label label-danger pull-left">0</span> <i class="fa fa-bell fa-lg"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-right alerts-dropdown">
            <li class="dropdown-header">订单管理</li>
            <li>
              <a href="" style="display: block; overflow: auto;">
                <span class="label label-warning pull-right">0</span>
                处理中订单
              </a>
            </li>
            <li>
              <a href="">
                <span class="label label-success pull-right">0</span>
                已完成订单
              </a>
            </li>
            <li>
              <a href="">
                <span class="label label-danger pull-right">0</span>
                退货
              </a>
            </li>
            <li class="divider"></li>
            <li class="dropdown-header">客户列表</li>
            <li>
              <a href="">
                <span class="label label-success pull-right">0</span>
                在线客户
              </a>
            </li>
            <li>
              <a href="">
                <span class="label label-danger pull-right">0</span>
                待审批
              </a>
            </li>
            <li class="divider"></li>
            <li class="dropdown-header">商品</li>
            <li>
              <a href="">
                <span class="label label-danger pull-right">0</span>
                缺货
              </a>
            </li>
            <li>
              <a href="">
                <span class="label label-danger pull-right">0</span>
                评论
              </a>
            </li>
            <li class="divider"></li>
            <li class="dropdown-header">加盟</li>
            <li>
              <a href="">
                <span class="label label-danger pull-right">0</span>
                待审批
              </a>
            </li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-life-ring fa-lg"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-right">
            <li class="dropdown-header">
              网店名称
              <i class="fa fa-shopping-cart"></i>
            </li>
            <li>
              <a href="" target="_blank">BuyPlus(败家Shopping)</a>
            </li>
            <li class="divider"></li>
            <li class="dropdown-header">
              帮助
              <i class="fa fa-life-ring"></i>
            </li>
            <li>
              <a href="" target="_blank">技术支持</a>
            </li>
            <li>
              <a href="" target="_blank">支持文档</a>
            </li>
            <li>
              <a href="" target="_blank">应用商店</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="">
            <span class="hidden-xs hidden-sm hidden-md">注销</span>
            <i class="fa fa-sign-out fa-lg"></i>
          </a>
        </li>
      </ul>
    </header>
    <nav id="column-left">
      <div id="profile">
        <div>
          <!-- <i class="fa fa-BuyPlus"></i>
        -->
        <img src="/Public/Back/image/avatar.png" style="max-width:42px; max-height: 42px;" ></div>
      <div>
        <h4>HelloKang</h4>
        <small>Administrator</small>
      </div>
    </div>
    <ul id="menu">
      <li id="dashboard">
        <a href="">
          <i class="fa fa-dashboard fa-fw"></i>
          <span>管理首页</span>
        </a>
      </li>
      <li id="catalog">
        <a class="parent">
          <i class="fa fa-tags fa-fw"></i>
          <span>商品目录</span>
        </a>
        <ul>
          <li>
            <a href="">商品分类</a>
          </li>
          <li>
            <a href="">商品管理</a>
          </li>
          <li class="hidden">
            <a href="">分期付款</a>
          </li>
          <li>
            <a href="">筛选过滤</a>
          </li>
          <li>
            <a class="parent">商品属性</a>
            <ul>
              <li>
                <a href="">商品属性</a>
              </li>
              <li>
                <a href="">属性组</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="">商品选项</a>
          </li>
          <li>
            <a href="">品牌管理</a>
          </li>
          <li>
            <a href="">下载设置</a>
          </li>
          <li>
            <a href="">商品评论</a>
          </li>
          <li>
            <a href="">信息管理</a>
          </li>
        </ul>
      </li>
      <li id="extension">
        <a class="parent">
          <i class="fa fa-puzzle-piece fa-fw"></i>
          <span>扩展功能</span>
        </a>
        <ul>
          <li>
            <a href="">扩展安装</a>
          </li>
          <li>
            <a href="">扩展配置</a>
          </li>
          <li>
            <a href="">流量分析</a>
          </li>
          <li>
            <a href="">验证码</a>
          </li>
          <li>
            <a href="">插件扩展</a>
          </li>
          <li>
            <a href="">反欺诈</a>
          </li>
          <li>
            <a href="">模块配置</a>
          </li>
          <li>
            <a href="">支付管理</a>
          </li>
          <li>
            <a href="">配送管理</a>
          </li>
          <li>
            <a href="">订单配置</a>
          </li>
        </ul>
      </li>
      <li id="design">
        <a class="parent">
          <i class="fa fa-television fa-fw"></i>
          <span>页面设计</span>
        </a>
        <ul>
          <li>
            <a href="">布局</a>
          </li>
          <li>
            <a href="">横幅</a>
          </li>
        </ul>
      </li>
      <li id="sale">
        <a class="parent">
          <i class="fa fa-shopping-cart fa-fw"></i>
          <span>营销推广</span>
        </a>
        <ul>
          <li>
            <a href="">订单管理</a>
          </li>
          <li class="hidden">
            <a href="">分期付款订单</a>
          </li>
          <li>
            <a href="">商品退换</a>
          </li>
          <li>
            <a class="parent">礼品券</a>
            <ul>
              <li>
                <a href="">礼品券</a>
              </li>
              <li>
                <a href="">礼品券主题</a>
              </li>
            </ul>
          </li>
          <li>
            <a class="parent hidden">PayPal</a>
            <ul>
              <li>
                <a href="">搜寻交易记录</a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
      <li id="customer">
        <a class="parent">
          <i class="fa fa-user fa-fw"></i>
          <span>客户列表</span>
        </a>
        <ul>
          <li>
            <a href="">客户列表</a>
          </li>
          <li>
            <a href="">客户群组</a>
          </li>
          <li>
            <a href="">自定义区</a>
          </li>
        </ul>
      </li>
      <li>
        <a class="parent">
          <i class="fa fa-share-alt fa-fw"></i>
          <span>市场营销</span>
        </a>
        <ul>
          <li>
            <a href="">市场营销</a>
          </li>
          <li>
            <a href="">加盟会员</a>
          </li>
          <li>
            <a href="">优惠券设置</a>
          </li>
          <li>
            <a href="">Mail</a>
          </li>
        </ul>
      </li>
      <li id="system">
        <a class="parent">
          <i class="fa fa-cog fa-fw"></i>
          <span>系统设置</span>
        </a>
        <ul>
          <li>
            <a href="">网店设置</a>
          </li>
          <li>
            <a class="parent">用户管理</a>
            <ul>
              <li>
                <a href="">用户管理</a>
              </li>
              <li>
                <a href="">用户群组</a>
              </li>
              <li>
                <a href="">API</a>
              </li>
            </ul>
          </li>
          <li>
            <a class="parent">参数设置</a>
            <ul>
              <li>
                <a href="">店铺地址</a>
              </li>
              <li>
                <a href="">语言设置</a>
              </li>
              <li>
                <a href="">货币设置</a>
              </li>
              <li>
                <a href="">库存状态</a>
              </li>
              <li>
                <a href="">订单状态</a>
              </li>
              <li>
                <a class="parent">商品退换</a>
                <ul>
                  <li>
                    <a href="">退换状态</a>
                  </li>
                  <li>
                    <a href="">退换管理</a>
                  </li>
                  <li>
                    <a href="">退换原因</a>
                  </li>
                </ul>
              </li>
              <li>
                <a href="">省/直辖市设置</a>
              </li>
              <li>
                <a href="">城市设置</a>
              </li>
              <li>
                <a href="">区县</a>
              </li>
              <li>
                <a href="">区域群组</a>
              </li>
              <li>
                <a class="parent">商品税种</a>
                <ul>
                  <li>
                    <a href="">税率类别</a>
                  </li>
                  <li>
                    <a href="">商品税率</a>
                  </li>
                </ul>
              </li>
              <li>
                <a href="">尺寸单位</a>
              </li>
              <li>
                <a href="">重量单位</a>
              </li>
            </ul>
          </li>
          <li>
            <a class="parent">相关工具</a>
            <ul>
              <li>
                <a href="">上传文件</a>
              </li>
              <li>
                <a href="">备份/恢复</a>
              </li>
              <li>
                <a href="">错误日志</a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
      <li id="reports">
        <a class="parent">
          <i class="fa fa-bar-chart-o fa-fw"></i>
          <span>统计报表</span>
        </a>
        <ul>
          <li>
            <a class="parent">营销推广</a>
            <ul>
              <li>
                <a href="">商品销售统计</a>
              </li>
              <li>
                <a href="">商品销售税费统计</a>
              </li>
              <li>
                <a href="">运费统计</a>
              </li>
              <li>
                <a href="">退换商品统计</a>
              </li>
              <li>
                <a href="">折扣商品统计</a>
              </li>
            </ul>
          </li>
          <li>
            <a class="parent">商品管理</a>
            <ul>
              <li>
                <a href="">商品浏览统计</a>
              </li>
              <li>
                <a href="">商品购买统计</a>
              </li>
            </ul>
          </li>
          <li>
            <a class="parent">客户列表</a>
            <ul>
              <li>
                <a href="">在线客户统计</a>
              </li>
              <li>
                <a href="">客户活动统计</a>
              </li>
              <li>
                <a href="">客户订单统计</a>
              </li>
              <li>
                <a href="">奖励积分统计</a>
              </li>
              <li>
                <a href="">客户余额统计</a>
              </li>
            </ul>
          </li>
          <li>
            <a class="parent">市场营销</a>
            <ul>
              <li>
                <a href="">市场营销</a>
              </li>
              <li>
                <a href="">加盟会员</a>
              </li>
              <li>
                <a href="">加盟会员活动统计</a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
    <div id="stats">
      <ul>
        <li>
          <div>
            订单已经完成
            <span class="pull-right">0%</span>
          </div>
          <div class="progress">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
              <span class="sr-only">0%</span>
            </div>
          </div>
        </li>
        <li>
          <div>
            订单待处理
            <span class="pull-right">0%</span>
          </div>
          <div class="progress">
            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
              <span class="sr-only">0%</span>
            </div>
          </div>
        </li>
        <li>
          <div>
            其它状态
            <span class="pull-right">0%</span>
          </div>
          <div class="progress">
            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
              <span class="sr-only">0%</span>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </nav>

  
    <div id="content">
        <div class="page-header">
            <div class="container-fluid">
                <div class="pull-right">
                    <button type="submit" form="form-product" data-toggle="tooltip" title="保存" class="btn btn-primary">
                        <i class="fa fa-save"></i>
                    </button>
                    <a href="<?php echo U('list');?>" data-toggle="tooltip" title="取消" class="btn btn-default">
                        <i class="fa fa-reply"></i>
                    </a>
                </div>
                <h1>商品管理</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="<?php echo U('Manage/index');?>">首页</a>
                    </li>
                    <li>
                        <a href="#">商品选项管理</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-pencil"></i>
                        商品选项管理
                    </h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post" enctype="multipart/form-data" id="form-product" class="form-horizontal">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab-option" data-toggle="tab">选项设置</a>
                            </li>

                        </ul>
                        <div class="tab-content">

                            <div class="tab-pane active" id="tab-option">
                                <div class="row">

                                    <div class="col-sm-12">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab-option0">
                                                <div class="table-responsive">
                                                    <table id="table-product" class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <?php if(is_array($optionList)): $i = 0; $__LIST__ = $optionList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?><td class="text-left"><?php echo ($option['attribute_title']); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>

                                                            <td class="text-left">库存</td>
                                                            <td class="text-left">销售价格</td>
                                                            <td>推荐</td>
                                                            <td>可用</td>
                                                            <td>操作</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <!--显示已有货品选项-->
                                                        <?php if(is_array($productList)): $i = 0; $__LIST__ = $productList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$product): $mod = ($i % 2 );++$i;?><tr id="tr-product-<?php echo ($product['product_id']); ?>">
    <?php if(is_array($product['optionList'])): $i = 0; $__LIST__ = $product['optionList'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?><td class="text-left">
            <?php echo ($option['option_value']); ?>
        </td><?php endforeach; endif; else: echo "" ;endif; ?>

    <td class="text-right">
        <input type="text" name="product[<?php echo ($product['product_id']); ?>][product_quantity]" id="input-product_quantity-<?php echo ($product['product_id']); ?>" value="<?php echo ($product['product_quantity']); ?>" placeholder="商品数量" class="form-control" />
    </td>
    <td class="text-right">
        <select name="" id="select-price_drift_id-<?php echo ($product['product_id']); ?>" class="form-control">
            <?php if(is_array($priceDriftList)): $i = 0; $__LIST__ = $priceDriftList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$priceDrift): $mod = ($i % 2 );++$i;?><option <?php if($priceDrift['price_drift_id'] == $product['price_drift_id']): ?>selected<?php endif; ?> value="<?php echo ($priceDrift['price_drift_id']); ?>"><?php echo ($priceDrift['title']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
        <input type="text" name="" id="input-product_price-<?php echo ($product['product_id']); ?>" value="<?php echo ($product['product_price']); ?>" placeholder="销售价格" class="form-control" />
    </td>

    <td class="text-left">
        <input type="checkbox" class="form-control" id="input-promoted-<?php echo ($product['product_id']); ?>" name="" value="1"<?php if($product['promoted']): ?>checked<?php endif; ?>>
    </td>
    <td class="text-left">
        <input type="checkbox" class="form-control" id="input-enabled-<?php echo ($product['product_id']); ?>" name="" value="1"<?php if($product['enabled']): ?>checked<?php endif; ?>>
    </td>
    <td>
        <a href="" id="" class="btn btn-default">删</a>
        <a href="" id="" class="btn btn-default">更</a>

    </td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                                        <!--
                                                        追加html位置
                                                         -->

                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <td><a class="btn btn-primary" href="" id="a-add">添加</a></td>
                                                        </tr>
                                                        <tr id="">
                                                            <?php if(is_array($optionList)): $i = 0; $__LIST__ = $optionList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?><td class="text-left">
                                                                    <select name="" class="form-control" id="select-option-<?php echo ($option['goods_attribute_id']); ?>">
                                                                        <?php if(is_array($option['valueList'])): $i = 0; $__LIST__ = $option['valueList'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><option value="<?php echo ($value['goods_attribute_option_id']); ?>">
                                                                                <?php echo ($value['option_value']); ?>
                                                                            </option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                                    </select>
                                                                </td><?php endforeach; endif; else: echo "" ;endif; ?>

                                                            <td class="text-right">
                                                                <input type="text" name="" id="input-product_quantity" value="0" placeholder="商品数量" class="form-control" />
                                                            </td>
                                                            <td class="text-right">
                                                                <select name="" id="select-price_drift_id" class="form-control"><!--价格浮动列表-->
                                                                    <?php if(is_array($priceDriftList)): $i = 0; $__LIST__ = $priceDriftList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$priceDrift): $mod = ($i % 2 );++$i;?><option value="<?php echo ($priceDrift['price_drift_id']); ?>"><?php echo ($priceDrift['title']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                                </select>
                                                                <input type="text" name="" id="input-product_price" value="0" placeholder="销售价格" class="form-control" />
                                                            </td>

                                                            <td class="text-left">
                                                                <input type="checkbox" class="form-control" id="input-promoted" name="" value="1">
                                                            </td>
                                                            <td class="text-left">
                                                                <input type="checkbox" class="form-control" id="input-enabled" name="" value="1" checked>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>

                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



  <footer id="footer">
    <a href="http://www.hellokang.net">BuyPlus(败家Shopping) HelloKang</a>
    <br>
    &copy; 2009-2016 All Rights Reserved.
    <br>Version 1.0
  </footer>
  <script type="text/javascript" src="/Public/Back/jquery/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="/Public/Back/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/Public/Back/summernote/summernote.js"></script>
  <script src="/Public/Back/datetimepicker/moment.js" type="text/javascript"></script>
  <script src="/Public/Back/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
  <script src="/Public/Back/javascript/common.js" type="text/javascript"></script>

    <script>
        $(function(){

            $('#a-add').click(function(evt) {
                // 获取当前用户所选择全部数据
                var data = {
                    goods_id: <?php echo ($goods_id); ?>,
                    option: [] //存储当前选项值
                };
//                先获取选项的值
                $('select[id^=select-option-]').each(function(i){
                    // 确定当前的选项值
                    data.option.push($(this).val());//将当前选项值存储到option数组中
                });
                data.product_quantity = $('#input-product_quantity').val();//库存值
                data.price_drift_id = $('#select-price_drift_id').val();//浮动价格类型
                data.product_price = $('#input-product_price').val();//价格
                data.promoted = $('#input-promoted').prop('checked') ? '1' : '0'; //是否推荐
                data.enabled = $('#input-enabled').prop('checked') ? '1' : '0';//是否可用    prop用于获取布尔类型的数据

                //console.log(data);

                // ajax添加数据
                var url = "<?php echo U('ajax', ['operate'=>'addProduct']);?>";
                $.post(url, data, function(resp){
                    //获取返回来的html数据 追加到tbody里
                    $('#table-product>tbody').append(resp);// resp 生成的tr的HTML代码
                });

                evt.preventDefault();//阻止浏览器默认行为
            });
        });

    </script>

</body>
</html>