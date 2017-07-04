<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html dir="ltr" lang="zh-CN">
<head>
  <meta charset="UTF-8" />
  <title>控制面板</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <link href="/daniu/php4/buyplus/Public/Back/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet" />
  <link href="/daniu/php4/buyplus/Public/Back/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
  <link href="/daniu/php4/buyplus/Public/Back/summernote/summernote.css" rel="stylesheet" />

  <link href="/daniu/php4/buyplus/Public/Back/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
  <link type="text/css" href="/daniu/php4/buyplus/Public/Back/stylesheet/stylesheet.css" rel="stylesheet" media="screen" />
  
    <link rel="stylesheet" href="/daniu/php4/buyplus/Public/Back/jqueryFileUpload/css/jquery.fileupload.css">
    <link href="/daniu/php4/buyplus/Public/Back/summernote/summernote.css" rel="stylesheet" />

</head>
<body>
  <div id="container">
    <header id="header" class="navbar navbar-static-top">
      <div class="navbar-header">
        <a type="button" id="button-menu" class="pull-left"> <i class="fa fa-indent fa-lg"></i>
        </a>
        <a href="" class="navbar-brand">
          <img src="/daniu/php4/buyplus/Public/Back/image/logo.png" alt="BuyPlus" title="BuyPlus" />
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
          <a href="<?php echo U('Admin/logout');?>">
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
        <img src="/daniu/php4/buyplus/Public/Back/image/avatar.png" style="max-width:42px; max-height: 42px;" ></div>
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
        <a class="parent" >
          <i class="fa fa-tags fa-fw"></i>
          <span>商品目录</span>
        </a>
        <ul>
          <li>
            <a href="">商品分类</a>
          </li>
          <?php if(isset($accessList['BACK']['GOODS']['LIST'])): ?><li>
              <a href="<?php echo U('Goods/list');?>">商品管理</a>
            </li><?php endif; ?>
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
                    <button type="submit" form="form-set" data-toggle="tooltip" title="保存" class="btn btn-primary"> <i class="fa fa-save"></i>
                    </button>
                    <a href="<?php echo U('list');?>" data-toggle="tooltip" title="取消" class="btn btn-default"> <i class="fa fa-reply"></i>
                    </a>
                </div>
                <h1>商品</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="<?php echo U('Manage/index');?>">首页</a>
                    </li>
                    <li>
                        <a href="<?php echo U('list');?>">商品</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-pencil"></i>
                        设置商品
                    </h3>
                </div>
                <div class="panel-body">
                    <!-- /daniu/php4/buyplus/entry.php/Back/Goods/add -->
                    <form action="<?php echo U('');?>" method="post" enctype="multipart/form-data" id="form-set" class="form-horizontal">
                        <?php if(ACTION_NAME == 'edit'): ?><input type="hidden" name="goods_id" id="input-goods_id" value="<?php echo ($data['goods_id']); ?>"><?php endif; ?>
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab-general" data-toggle="tab">基本信息</a>
                            </li>
                            <li>
                                <a href="#tab-description" data-toggle="tab">商品描述</a>
                            </li>
                            <li>
                                <a href="#tab-links" data-toggle="tab">关联项目</a>
                            </li>
                            <li>
                                <a href="#tab-seo" data-toggle="tab">SEO项目</a>
                            </li>
                            <li>
                                <a href="#tab-gallery" data-toggle="tab">图片设置</a>
                            </li>
                            <li>
                                <a href="#tab-attribute" data-toggle="tab">属性</a>
                            </li>
                            <li>
                                <a href="#tab-discount" data-toggle="tab">促销活动</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-general">
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-name">商品</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" value="<?php echo ($data['name']); ?>" placeholder="商品" id="input-name" class="form-control">
                                        <?php if(isset($message['errorInfo']['name'])): ?><label for="input-name" class="text-danger"><?php echo ($message['errorInfo']['name']); ?></label><?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-upc">商品代码</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="upc" value="<?php echo ($data['upc']); ?>" placeholder="商品代码" id="input-upc" class="form-control">
                                        <?php if(isset($message['errorInfo']['upc'])): ?><label for="input-upc" class="text-danger"><?php echo ($message['errorInfo']['upc']); ?></label><?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-image">图像</label>
                                    <div class="col-sm-10">
                                        <input type="hidden" name="image" value="" id="input-image-data">
                                        <input type="hidden" name="image_thumb" value="" id="input-image_thumb-data">
                                        <span id="image-preview" class="text-center">
                                            <?php if($data['image']): ?><img src="/daniu/php4/buyplus/Public/Thumb/$data['image_thumb']" style="max-height: 50px;" alt=""><?php endif; ?>
                                        </span>

                                        <span class="btn btn-success fileinput-button">
                                            <i class="glyphicon glyphicon-plus"></i>
                                            <span>选择图像</span>
                                            <!-- The file input field used as target for the file upload widget -->
                                            <input id="input-image" type="file" name="imageAjax"> <!-- $_FILES['files']  -->
                                        </span>
                                        <?php if(isset($message['errorInfo']['image'])): ?><label for="input-image" class="text-danger"><?php echo ($message['errorInfo']['image']); ?></label><?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-quantity">库存</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="quantity" value="<?php echo ((isset($data['quantity']) && ($data['quantity'] !== ""))?($data['quantity']):1); ?>" placeholder="库存" id="input-quantity" class="form-control">
                                        <?php if(isset($message['errorInfo']['quantity'])): ?><label for="input-quantity" class="text-danger"><?php echo ($message['errorInfo']['quantity']); ?></label><?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-sku_id">库存单位</label>
                                    <div class="col-sm-10">
                                        <select name="sku_id" id="input-sku_id" class="form-control">
                                            <?php if(is_array($sku_list)): $i = 0; $__LIST__ = $sku_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sku): $mod = ($i % 2 );++$i;?><option value="<?php echo ($sku['sku_id']); ?>"<?php if($data['sku_id'] == $sku['sku_id']): ?>selected<?php endif; ?> ><?php echo ($sku['title']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                        <?php if(isset($message['errorInfo']['sku_id'])): ?><label for="input-sku_id" class="text-danger"><?php echo ($message['errorInfo']['sku_id']); ?></label><?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-price">本店售价</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="price" value="<?php echo ((isset($data['price']) && ($data['price'] !== ""))?($data['price']):0); ?>" placeholder="本店售价" id="input-price" class="form-control">
                                        <?php if(isset($message['errorInfo']['price'])): ?><label for="input-price" class="text-danger"><?php echo ($message['errorInfo']['price']); ?></label><?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-market_price">市场价</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="market_price" value="<?php echo ((isset($data['market_price']) && ($data['market_price'] !== ""))?($data['market_price']):0); ?>" placeholder="市场价" id="input-market_price" class="form-control">
                                        <?php if(isset($message['errorInfo']['market_price'])): ?><label for="input-market_price" class="text-danger"><?php echo ($message['errorInfo']['market_price']); ?></label><?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-tax_id">税类型</label>
                                    <div class="col-sm-10">
                                        <select name="tax_id" id="input-tax_id" class="form-control">
                                            <?php if(is_array($tax_list)): $i = 0; $__LIST__ = $tax_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tax): $mod = ($i % 2 );++$i;?><option value="<?php echo ($tax['tax_id']); ?>" <?php if($data['tax_id'] == $tax['tax_id']): ?>selected<?php endif; ?> ><?php echo ($tax['title']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                        <?php if(isset($message['errorInfo']['tax_id'])): ?><label for="input-tax_id" class="text-danger"><?php echo ($message['errorInfo']['tax_id']); ?></label><?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-minimum">最少起售量</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="minimum" value="<?php echo ((isset($data['minimum']) && ($data['minimum'] !== ""))?($data['minimum']):1); ?>" placeholder="最少起售量" id="input-minimum" class="form-control">
                                        <?php if(isset($message['errorInfo']['minimum'])): ?><label for="input-minimum" class="text-danger"><?php echo ($message['errorInfo']['minimum']); ?></label><?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-subtract">是否减少库存</label>
                                    <div class="col-sm-10">
                                        <input type="checkbox" name="subtract" value="1" id="input-subtract" <?php if($data['subtract'] OR !isset($data['subtract'])): ?>checked<?php endif; ?> placeholder="是否减少库存"  class="form-control">
                                        <?php if(isset($message['errorInfo']['subtract'])): ?><label for="input-subtract" class="text-danger"><?php echo ($message['errorInfo']['subtract']); ?></label><?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-shipping">是否支持配送</label>
                                    <div class="col-sm-10">
                                        <input type="checkbox" name="shipping" value="1" id="input-shipping" <?php if($data['shipping'] OR !isset($data['shipping'])): ?>checked<?php endif; ?> placeholder="是否减少库存"  class="form-control">
                                        <?php if(isset($message['errorInfo']['shipping'])): ?><label for="input-shipping" class="text-danger"><?php echo ($message['errorInfo']['shipping']); ?></label><?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-date_available">起售日期</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="date_available" value="<?php echo ($data['date_available']); ?>" placeholder="起售日期" id="input-date_available" class="form-control date">
                                        <?php if(isset($message['errorInfo']['date_available'])): ?><label for="input-date_available" class="text-danger"><?php echo ($message['errorInfo']['date_available']); ?></label><?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-length">长度</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="length" value="<?php echo ((isset($data['length']) && ($data['length'] !== ""))?($data['length']):0); ?>" placeholder="长度" id="input-length" class="form-control">
                                        <?php if(isset($message['errorInfo']['length'])): ?><label for="input-length" class="text-danger"><?php echo ($message['errorInfo']['length']); ?></label><?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-width">宽度</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="width" value="<?php echo ((isset($data['width']) && ($data['width'] !== ""))?($data['width']):0); ?>" placeholder="宽度" id="input-width" class="form-control">
                                        <?php if(isset($message['errorInfo']['width'])): ?><label for="input-width" class="text-danger"><?php echo ($message['errorInfo']['width']); ?></label><?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-height">高度</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="height" value="<?php echo ((isset($data['height']) && ($data['height'] !== ""))?($data['height']):0); ?>" placeholder="高度" id="input-height" class="form-control">
                                        <?php if(isset($message['errorInfo']['height'])): ?><label for="input-height" class="text-danger"><?php echo ($message['errorInfo']['height']); ?></label><?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-length_unit_id">长度单位</label>
                                    <div class="col-sm-10">
                                        <select name="length_unit_id" id="input-length_unit_id" class="form-control">
                                            <?php if(is_array($length_unit_list)): $i = 0; $__LIST__ = $length_unit_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$length_unit): $mod = ($i % 2 );++$i;?><option value="<?php echo ($length_unit['length_unit_id']); ?>" <?php if($data['length_unit_id'] == $length_unit['length_unit_id']): ?>selected<?php endif; ?> ><?php echo ($length_unit['title']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                        <?php if(isset($message['errorInfo']['length_unit_id'])): ?><label for="input-length_unit_id" class="text-danger"><?php echo ($message['errorInfo']['length_unit_id']); ?></label><?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-weight">重量</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="weight" value="<?php echo ((isset($data['weight']) && ($data['weight'] !== ""))?($data['weight']):0); ?>" placeholder="重量" id="input-weight" class="form-control">
                                        <?php if(isset($message['errorInfo']['weight'])): ?><label for="input-weight" class="text-danger"><?php echo ($message['errorInfo']['weight']); ?></label><?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-weight_unit_id">重量单位</label>
                                    <div class="col-sm-10">
                                        <select name="weight_unit_id" id="input-weight_unit_id" class="form-control">
                                            <?php if(is_array($weight_unit_list)): $i = 0; $__LIST__ = $weight_unit_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$weight_unit): $mod = ($i % 2 );++$i;?><option value="<?php echo ($weight_unit['weight_unit_id']); ?>" <?php if($data['weight_unit_id'] == $weight_unit['weight_unit_id']): ?>selected<?php endif; ?> ><?php echo ($weight_unit['title']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                        <?php if(isset($message['errorInfo']['weight_unit_id'])): ?><label for="input-weight_unit_id" class="text-danger"><?php echo ($message['errorInfo']['weight_unit_id']); ?></label><?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-status">是否销售</label>
                                    <div class="col-sm-10">
                                        <input type="checkbox" name="status" value="1" id="input-status" <?php if($data['status'] OR !isset($data['status'])): ?>checked<?php endif; ?> placeholder="是否减少库存"  class="form-control">
                                        <?php if(isset($message['errorInfo']['status'])): ?><label for="input-status" class="text-danger"><?php echo ($message['errorInfo']['status']); ?></label><?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-sort_number">排序</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="sort_number" value="<?php echo ((isset($data['sort_number']) && ($data['sort_number'] !== ""))?($data['sort_number']):0); ?>" placeholder="排序" id="input-sort_number" class="form-control">
                                        <?php if(isset($message['errorInfo']['sort_number'])): ?><label for="input-sort_number" class="text-danger"><?php echo ($message['errorInfo']['sort_number']); ?></label><?php endif; ?>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane" id="tab-description">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-description">描述</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" placeholder="描述" id="input-description" class="form-control"><?php echo ($data['description']); ?></textarea>
                                        <?php if(isset($message['errorInfo']['description'])): ?><label for="input-description" class="text-danger"><?php echo ($message['errorInfo']['description']); ?></label><?php endif; ?>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane" id="tab-links">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-stock_status_id">库存状态</label>
                                    <div class="col-sm-10">
                                        <select name="stock_status_id" id="input-stock_status_id" class="form-control">
                                            <?php if(is_array($stock_status_list)): $i = 0; $__LIST__ = $stock_status_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$stock_status): $mod = ($i % 2 );++$i;?><option value="<?php echo ($stock_status['stock_status_id']); ?>" <?php if($data['stock_status_id'] == $stock_status['stock_status_id']): ?>selected<?php endif; ?> ><?php echo ($stock_status['title']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                        <?php if(isset($message['errorInfo']['stock_status_id'])): ?><label for="input-stock_status_id" class="text-danger"><?php echo ($message['errorInfo']['stock_status_id']); ?></label><?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-brand_id">品牌</label>
                                    <div class="col-sm-10">
                                        <select name="brand_id" id="input-brand_id" class="form-control">
                                            <?php if(is_array($brand_list)): $i = 0; $__LIST__ = $brand_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$brand): $mod = ($i % 2 );++$i;?><option value="<?php echo ($brand['brand_id']); ?>" <?php if($data['brand_id'] == $brand['brand_id']): ?>selected<?php endif; ?> ><?php echo ($brand['title']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                        <?php if(isset($message['errorInfo']['brand_id'])): ?><label for="input-brand_id" class="text-danger"><?php echo ($message['errorInfo']['brand_id']); ?></label><?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-category_id">分类</label>
                                    <div class="col-sm-10">
                                        <select name="category_id" id="input-category_id" class="form-control">
                                            <?php if(is_array($category_list)): $i = 0; $__LIST__ = $category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($i % 2 );++$i;?><option value="<?php echo ($category['category_id']); ?>" <?php if($data['category_id'] == $category['category_id']): ?>selected<?php endif; ?> ><?php echo str_repeat('&nbsp;', $category['level']*4); echo ($category['title']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                        <?php if(isset($message['errorInfo']['category_id'])): ?><label for="input-category_id" class="text-danger"><?php echo ($message['errorInfo']['category_id']); ?></label><?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab-seo">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-meta_title">SEO标题</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="meta_title" value="<?php echo ($data['meta_title']); ?>" placeholder="SEO标题" id="input-meta_title" class="form-control">
                                        <?php if(isset($message['errorInfo']['meta_title'])): ?><label for="input-meta_title" class="text-danger"><?php echo ($message['errorInfo']['meta_title']); ?></label><?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-meta_keywords">SEO关键字</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="meta_keywords" value="<?php echo ($data['meta_keywords']); ?>" placeholder="SEO关键字" id="input-meta_keywords" class="form-control">
                                        <?php if(isset($message['errorInfo']['meta_keywords'])): ?><label for="input-meta_keywords" class="text-danger"><?php echo ($message['errorInfo']['meta_keywords']); ?></label><?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-meta_description">SEO描述</label>
                                    <div class="col-sm-10">
                                        <textarea name="meta_description" placeholder="SEO描述" id="input-meta_description" class="form-control"><?php echo ($data['meta_description']); ?></textarea>
                                        <?php if(isset($message['errorInfo']['meta_description'])): ?><label for="input-meta_description" class="text-danger"><?php echo ($message['errorInfo']['meta_description']); ?></label><?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab-gallery">
                                <div class="table-responsive">
                                    <table id="table-gallery" class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <td class="text-left">图片</td>
                                            <td class="text-left">描述</td>
                                            <td class="text-right">排序</td>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php if(is_array($gallery_list)): $i = 0; $__LIST__ = $gallery_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gallery): $mod = ($i % 2 );++$i;?><tr id="gallery-row-<?php echo ($gallery['gallery_id']); ?>">
                                                <td class="text-center">
                                                    <img src="/daniu/php4/buyplus/Public/Thumb/<?php echo ($gallery['image_small']); ?>" alt="">
                                                    <input type="hidden" name="galleries[<?php echo ($gallery['gallery_id']); ?>][gallery_id]" value="<?php echo ($gallery['gallery_id']); ?>" >
                                                </td>
                                                <td class="text-left">
                                                    <input name="galleries[<?php echo ($gallery['gallery_id']); ?>][intro]" value="<?php echo ($gallery['intro']); ?>" placeholder="描述" class="form-control" type="text">
                                                </td>
                                                <td class="text-left">
                                                    <input name="galleries[<?php echo ($gallery['gallery_id']); ?>][sort_number]" value="<?php echo ($gallery['sort_number']); ?>" placeholder="排序" class="form-control" type="text">
                                                </td>
                                                <td class="text-left">
                                                    <button type="button" id="button-remove-<?php echo ($gallery['gallery_id']); ?>" data-toggle="tooltip" data-gallery_id="<?php echo ($gallery['gallery_id']); ?>" title="" class="btn btn-danger" data-original-title="移除"><i class="fa fa-minus-circle"></i>
                                                    </button>
                                                </td>
                                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td class="text-left">
                                                <span class="btn btn-success fileinput-button">
                                                    <i class="glyphicon glyphicon-plus"></i>
                                                    <span>选择图像</span>
                                                    <input id="input-galleries" type="file" name="galleriesAjax" multiple> <!-- $_FILES['files'] -->
                                                </span>
                                            </td>
                                            <td colspan="3"></td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab-attribute">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-type_id">商品类型</label>
                                    <div class="col-sm-1 text-center control-label">货品选项</div>
                                    <div class="col-sm-9">
                                        <select name="type_id" id="input-type_id" class="form-control">
                                            <option value="0">请选择类型</option>
                                            <?php if(is_array($type_list)): $i = 0; $__LIST__ = $type_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type): $mod = ($i % 2 );++$i;?><option value="<?php echo ($type['type_id']); ?>" <?php if($type['type_id'] == $data['type_id']): ?>selected<?php endif; ?>><?php echo ($type['type_title']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                        <?php if(isset($message['errorInfo']['type_id'])): ?><label for="input-type_id" class="text-danger"><?php echo ($message['errorInfo']['type_id']); ?></label><?php endif; ?>
                                    </div>
                                </div>
                                <?php if(is_array($attribute_merge_list)): $i = 0; $__LIST__ = $attribute_merge_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$attribute_merge): $mod = ($i % 2 );++$i;?><div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-attribute-<?php echo ($attribute_merge['attribute_id']); ?>"><?php echo ($attribute_merge['attribute_title']); ?></label>
                                        <div class="col-sm-1 text-center">
                                            <label class="control-label">
                                                <input name="is_option[]" value="<?php echo ($attribute_merge['attribute_id']); ?>" class="form-control" type="checkbox" <?php if($attribute_merge['attribute_type_title'] != 'select-multi'): ?>disabled<?php endif; if($attribute_merge['product_option'] == '1'): ?>checked<?php endif; ?> >
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <?php switch($attribute_merge['attribute_type_title']): case "text": ?><input name="attribute[<?php echo ($attribute_merge['attribute_id']); ?>]" value="<?php echo ($attribute_merge['value']); ?>" placeholder="属性值" id="input-attribute-<?php echo ($attribute_merge['attribute_id']); ?>" class="form-control" type="text"><?php break;?>

                                                <?php case "select": ?><select name="attribute[<?php echo ($attribute_merge['attribute_id']); ?>]" id="input-attribute-<?php echo ($attribute_merge['attribute_id']); ?>" class="form-control">
                                                        <?php if(is_array($attribute_merge['optionList'])): $i = 0; $__LIST__ = $attribute_merge['optionList'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?><option value="<?php echo ($option['attribute_option_id']); ?>" <?php if(in_array($option['attribute_option_id'], $attribute_merge['checked_list'])): ?>selected<?php endif; ?> ><?php echo ($option['option_value']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </select><?php break;?>
                                                <?php case "select-multi": ?><select multiple name="attribute[<?php echo ($attribute_merge['attribute_id']); ?>][]" id="input-attribute-<?php echo ($attribute_merge['attribute_id']); ?>" class="form-control">
                                                        <?php if(is_array($attribute_merge['optionList'])): $i = 0; $__LIST__ = $attribute_merge['optionList'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?><option value="<?php echo ($option['attribute_option_id']); ?>" <?php if(in_array($option['attribute_option_id'], $attribute_merge['checked_list'])): ?>selected<?php endif; ?> ><?php echo ($option['option_value']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </select><?php break; endswitch;?>

                                        </div>
                                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                                
                            <div class="tab-pane" id="tab-attribute">
                            </div>

                            <div class="tab-pane" id="tab-discount">
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
  <script type="text/javascript" src="/daniu/php4/buyplus/Public/Back/jquery/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="/daniu/php4/buyplus/Public/Back/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/daniu/php4/buyplus/Public/Back/summernote/summernote.js"></script>
  <script src="/daniu/php4/buyplus/Public/Back/datetimepicker/moment.js" type="text/javascript"></script>
  <script src="/daniu/php4/buyplus/Public/Back/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
  <script src="/daniu/php4/buyplus/Public/Back/javascript/common.js" type="text/javascript"></script>

    <script src="/daniu/php4/buyplus/Public/Back/validate/jquery.validate.min.js"></script>
    <script src="/daniu/php4/buyplus/Public/Back/validate/additional-methods.min.js"></script>
    <script src="/daniu/php4/buyplus/Public/Back/validate/localization/messages_zh.min.js"></script>

    <script>
        $('.date').datetimepicker({
            pickTime: false,
            //日期格式化
            format: 'YYYY-MM-DD',
        });
    </script>
    <script>

    $(function() {
        // 自定义初始验证方法
        $('#form-set').validate({});
    });
    </script>

    <script src="/daniu/php4/buyplus/Public/Back/jqueryFileUpload/js/vendor/jquery.ui.widget.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="/daniu/php4/buyplus/Public/Back/jqueryFileUpload/js/jquery.iframe-transport.js"></script>
    <!-- The basic File Upload plugin -->
    <script src="/daniu/php4/buyplus/Public/Back/jqueryFileUpload/js/jquery.fileupload.js"></script>
    <script>
//        上传商品主图像
        $(function() {
            //请求地址
            var url = "<?php echo U('ajax', ['operate'=>'imageUpload']);?>";
            //获取上传域 的文件上传事件
            $('#input-image').fileupload({
                url: url,
                //数据格式
                dataType: 'json',
                //请求成功时调用的回调函数
                done: function(evt, data) {
//                    console.log(data);1
                    // 预览
                    if (data.result.error == 0) {  //没有错误
                        var thumbPath = '/daniu/php4/buyplus/Public/Thumb/'; //鱼片路径
                        //追加img标签
                        $('#image-preview').empty().append('<img src="' + thumbPath + data.result.imageAjax.thumbUrl + '" style="max-height: 50px;" alt="">');
                        //将路径信息赋值 便于php存储到数据库
                        $('#input-image-data').val(data.result.imageAjax.image);
                        $('#input-image_thumb-data').val(data.result.imageAjax.image_thumb);
                    }
                }
            });
        });
    </script>

    <script>
//        上传商品相册图像
        $(function(){
            var url = "<?php echo U('ajax', ['operate'=>'galleriesUpload']);?>";
            $('#input-galleries').fileupload({
                url: url,
                dataType: 'json',
                done: function(evt, data) {
//                    console.log(data);
                    // 利用多图像, 显示每个图像的信息列表
                    // 形成tr
                    var trHtml = '<tr id="gallery-row-' + data.result.key + '">';
                    trHtml += '<td class="text-center"><img src="/daniu/php4/buyplus/Public/Thumb/' + data.result.image_small + '" alt="">';
                    trHtml += '<input type="hidden" name="galleries[' + data.result.key +'][image]" value="' + data.result.image + '" >';
                    trHtml += '<input type="hidden" name="galleries[' + data.result.key +'][image_small]" value="' + data.result.image_small + '" >';
                    trHtml += '<input type="hidden" name="galleries[' + data.result.key +'][image_medium]" value="' + data.result.image_medium + '" >';
                    trHtml += '<input type="hidden" name="galleries[' + data.result.key +'][image_big]" value="' + data.result.image_big + '" >';
                    trHtml += '</td>'; 
                    trHtml += '<td class="text-left"><input type="text" name="galleries[' + data.result.key +'][intro]" placeholder="描述" class="form-control"></td>';
                    trHtml += '<td class="text-left"><input type="text" name="galleries[' + data.result.key +'][sort_number]" value="0" placeholder="排序" class="form-control"></td>';
                    trHtml += '<td class="text-left">' +
                            '<button type="button" id="button-remove-' + data.result.key + '" data-toggle="tooltip" data-key="' + data.result.key +'" data-ext="' + data.result.ext +'" data-savepath="'+data.result.savepath+'" title="移除" class="btn btn-danger">' +
                            '<i class="fa fa-minus-circle"></i>' +
                            '</button>' +
                            '</td>';
                    trHtml += '</tr>';

                    // 追加到table的tbody中
                    $('#table-gallery > tbody').append(trHtml);

//                    // 绑定事件
//                    $('#button-remove-' + data.result.key).click(function(evt) {
//                        console.log(this);
//                    });
                }
            });

            // 事件委派
            $('#table-gallery').delegate('button[id^=button-remove-]', 'click', function(evt) {
                var currTr = $(this).parents('tr[id^=gallery-row-]');
                // 删除一行
                currTr.remove();

                // 删除对应的服务器元素
                var url = "<?php echo U('ajax', ['operate'=>'galleryRemove']);?>";
                var data = {
                    gallery_id: $(this).data('gallery_id'),
                    key: $(this).data('key'),
                    ext: $(this).data('ext'),
                    savepath: $(this).data('savepath'),
                };
                $.post(url, data, function(resp) {}, 'json');
            });
        })
    </script>
    <script>
        $(function() {
            //获取属性下拉列表改变事件
            $('#input-type_id').change(function(evt) {
                //ajax方法 操作  获取属性列表
                var url = '<?php echo U('ajax', ['operate'=>'getAttrList']);?>';;
                //type_id等于当前下拉列表选中的值
                var data = {
                    type_id: $(this).val(),
                };
                //get请求  请求地址 携带数据 回掉函数（请求到的数据）
                $.get(url, data, function(resp) {

                    if (resp.error != 0) { //有错误输出到控制台 直接返回
                        console.log(resp.errorInfo);
                        return ;
                    }
                    // 拼属性输入列表
                    var fieldHtml = '';
                    //遍历resp[rows] 回掉函数参数1 数组成员索引 参数二 对应变量或内容
                    $.each(resp.rows, function(i, row){
//                        console.log(row);
                        fieldHtml += '<div class="form-group">';
                        fieldHtml += '<label class="col-sm-2 control-label" for="input-attribute-10">' + row.attribute_title + '</label>';
                        fieldHtml += '<div class="col-sm-1 text-center"><label class="control-label"><input name="is_option[]" value="'+row.attribute_id+'" class="form-control" type="checkbox" ';
                        if (row.attribute_type_title!='select-multi'){
                            fieldHtml+=' disabled';
                        }
                        console.log(fieldHtml);
                        fieldHtml += '></label></div>';
                        switch (row.attribute_type_title) {
                            case 'text':
                                fieldHtml += '<div class="col-sm-9"><input name="attribute['+row.attribute_id+']" value="" placeholder="属性值" id="input-attribute-'+row.attribute_id+'" class="form-control" type="text"></div>';
                                break;
                            case 'select':
                            case 'select-multi':
                                fieldHtml += '<div class="col-sm-9"><select name="attribute['+row.attribute_id+']';
                                if (row.attribute_type_title == 'select-multi') {
                                    fieldHtml += '[]';
                                }
                                fieldHtml +='" id="input-attribute-'+row.attribute_id+'" class="form-control"';
                                if (row.attribute_type_title == 'select-multi') {
                                    fieldHtml += ' multiple';
                                }
                                fieldHtml += '>';
                                $.each(row.optionList, function(ii, option) {
                                    fieldHtml += '<option value="'+option.attribute_option_id + '">' + option.option_value + '</option>';
                                });
                                fieldHtml += '</select></div>';
                                break;
                        }

                        fieldHtml += '</div>';
                    });
                    // 加入到列表编辑
                    $('#tab-attribute>div.form-group:gt(0)').remove();
                    $('#tab-attribute').append(fieldHtml);

                }, 'json');
            });
        });

    </script>

    <script type="text/javascript" src="/daniu/php4/buyplus/Public/Back/summernote/summernote.min.js"></script>

    <script>

        $(function(){
            $('#input-description').summernote({
                height: 400,
                callbacks: {
                    onImageUpload: function(files) {
//                        完成上传
                        console.log(files);
                        var data = new FormData();
                        data.append('imageAjax', files[0]);
                        // ajax请求
                        var url = '<?php echo U('ajax');?>';
                        data.append('operate', 'imageUpload');
                        $.ajax({
                            url: url,
                            data: data,
                            processData: false,// 不去编码数据 ------- ajax上传文件必要的
                            contentType: false,// 不去设置主体类型----
                            type: 'POST',
                            dataType: 'json',
                            success: function(resp)
                            {
                                // 显示上传的图像
                                $('#input-description').summernote('insertImage', '/daniu/php4/buyplus/Public/Thumb/' + resp.imageAjax.thumbUrl);
                            }
                        });
                    }
                }
            });
        });
    </script>

</body>
</html>