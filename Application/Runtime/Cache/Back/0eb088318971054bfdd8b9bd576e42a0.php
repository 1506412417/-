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
                    <button type="submit" form="form-setting" data-toggle="tooltip" title="保存" class="btn btn-primary"> <i class="fa fa-save"></i>
                    </button>
                    <a href="<?php echo U('Manage/index');?>" data-toggle="tooltip" title="取消" class="btn btn-default"> <i class="fa fa-reply"></i>
                    </a>
                </div>
                <h1>系统设置</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="<?php echo U('Manage/index');?>">首页</a>
                    </li>
                    <li>
                        <a href="#">系统设置</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-pencil"></i>
                        编辑系统设置
                    </h3>
                </div>
                <div class="panel-body">
                    <form action="<?php echo U('update');?>" method="post" enctype="multipart/form-data" id="form-setting" class="form-horizontal">

                        <ul class="nav nav-tabs">
                            <!--遍历分组列表-->
                            <?php if(is_array($groupList)): $i = 0; $__LIST__ = $groupList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><!--$i表示当前遍历序号 如果等于1则给li添加样式-->
                                <li class="<?php if($i == 1): ?>active<?php endif; ?>">
                                <!--分组id和分组标题-->
                                <a href="#tab-group-<?php echo ($group['setting_group_id']); ?>" data-toggle="tab"><?php echo ($group['group_title']); ?></a>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>

                        <div class="tab-content">
                            <!--遍历分组后的配置列表-->
                            <?php if(is_array($settingGroupList)): $i = 0; $__LIST__ = $settingGroupList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$settingGroup): $mod = ($i % 2 );++$i;?><!--获取到分组id-->
                                <div class="tab-pane <?php if($i == 1): ?>active<?php endif; ?>" id="tab-group-<?php echo ($key); ?>">
                                <!--再次遍历，得到分组内的配置项数组-->
                                <?php if(is_array($settingGroup)): $i = 0; $__LIST__ = $settingGroup;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$setting): $mod = ($i % 2 );++$i;?><div class="form-group">
                                        <!--获取到每一组配置项的 下标，配置名称-->
                                        <label class="col-sm-2 control-label" for="input-<?php echo ($setting['key']); ?>"><?php echo ($setting['title']); ?></label>
                                        <div class="col-sm-9">
                                            <!-- 状态值分支 适合用switch-case  判断输出类型 输出相应的内容-->
                                            <?php switch($setting['type_title']): case "text": ?><input type="text" name="setting[<?php echo ($setting['setting_id']); ?>]" value="<?php echo ($setting['value']); ?>" placeholder="<?php echo ($setting['title']); ?>" id="input-<?php echo ($setting['key']); ?>" class="form-control" /><?php break;?>

                                                <?php case "textarea": ?><textarea rows="5" name="setting[<?php echo ($setting['setting_id']); ?>]" placeholder="<?php echo ($setting['title']); ?>" id="input-<?php echo ($setting['key']); ?>" class="form-control"><?php echo ($setting['value']); ?></textarea><?php break;?>

                                                <?php case "select": ?><!--单选-->
                                                    <select name="setting[<?php echo ($setting['setting_id']); ?>]" id="select-<?php echo ($setting['key']); ?>" class="form-control">
                                                        <!--遍历选项列表-->
                                                        <?php if(is_array($setting['optionList'])): $i = 0; $__LIST__ = $setting['optionList'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?><!--如果选项值等于 配置项里的value 则选中-->
                                                            <option <?php if($option['setting_option_id'] == $setting['value']): ?>selected<?php endif; ?> value="<?php echo ($option['setting_option_id']); ?>"><?php echo ($option['option_title']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </select><?php break;?>

                                                <?php case "select-multi": ?><!--多选  -->
                                                    <select multiple name="setting[<?php echo ($setting['setting_id']); ?>][]" id="select-<?php echo ($setting['key']); ?>" class="form-control">
                                                        <!--遍历选项列表 name需要设置成数组 -->
                                                        <?php if(is_array($setting['optionList'])): $i = 0; $__LIST__ = $setting['optionList'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?><!--如果配置项里value 数组(字符串形式以逗号炸开成数组)里 含有选项值  则默认选中  in_array(a,b) b数组中是否含有a-->
                                                            <option <?php if(in_array($option['setting_option_id'], explode(',', $setting['value']))): ?>selected<?php endif; ?> value="<?php echo ($option['setting_option_id']); ?>"><?php echo ($option['option_title']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </select><?php break; endswitch;?>
                                        </div>
                                        <div class="col-sm-1">
                                            <a href="javascript:;" class="btn btn-default" id="a-setting-update-<?php echo ($setting['setting_id']); ?>" data-setting_id="<?php echo ($setting['setting_id']); ?>" setting_id="<?php echo ($setting['setting_id']); ?>">更新</a>
                                        </div>
                                    </div><?php endforeach; endif; else: echo "" ;endif; ?>

                        </div><?php endforeach; endif; else: echo "" ;endif; ?>

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
            // 找到所有的id属性以a-setting-update-开头的a元素
            // 绑定click事件
            $('a[id^=a-setting-update-]').click(function(evt) {
                // 找到对应的表单元素
                var setting_id = $(this).data('setting_id');
//                var setting_id = $(this).attr('setting_id'); attr(属性名，设置值)返回或设置指定属性的值
                // 当前setting_id对表单元素  eq(index)找到集合里的索引所在位置的元素
                var settingElement = $('[name^="setting['+setting_id +']"]').eq(0);
//                console.log(settingElement.val()); val()返回或设置 选中元素的值 空表示获取
//                ajax更新
                var url = '<?php echo U('ajax');?>';
                var data = {
                    setting_id: setting_id,
                    value: settingElement.val(),
                };
                //提交数据 得到返回数组 进行弹窗提示
                $.post(url, data, function(resp) {
                    if (resp.error == 0) {
                        alert('更新成功');
                    } else {
                        alert('更新失败, ' + resp.errorInfo);
                    }
                }, 'json');
            });
        });

    </script>



</body>
</html>