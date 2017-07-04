<?php
namespace Back\Controller;

use Think\Page;
use Think\Upload;
use Think\Image;


class GoodsController extends CommonController
{
	//添加
	public function addAction(){

//        //校验是否登录    已有公共方法做初始化动作
//        rbac::checkLogin();
//
//        //校验是否有权限
//        if(!Rbac::AccessDecision()){
//            //没有权限跳转到登陆
//            $this->errpr('没有权限',U('Admin\login'));
//        }

		$model = D('Goods');//自定义模块
		if(IS_POST){  //判断是否提交了表单
			
			if($model->create()){ //校验
				$goods_id=$model->add();//添加

				// 添加商品相册数据
                $modelGallery = M('Gallery');
                // 形成带有goods_id字段的每条记录数据
                $galleryList = [];
                foreach(I('post.galleries') as $value) {
                    $value['goods_id'] = $goods_id;
                    $galleryList[] = $value;
                }
                // 批量插入
                $modelGallery->addAll($galleryList);

                //处理商品属性数据
                //typ_id自动处理
                $modelAttribute = M('Attribute');
                $modelAttributeType=M('AttributeType');
                $modelGoodsAttribute = M('GoodsAttribute');
                $modelGoodsAttributeOption = M('GoodsAttributeOption');
                foreach(I('post.attribute', []) as $attribute_id => $value) {
                    // 判断当前的属性类型
                    $attribute_type_id = $modelAttribute->where(['attribute_id'=>$attribute_id])->getField('attribute_type_id'); //属性表获取 属性输入类型ID
                    $attributeType = $modelAttributeType->where(['attribute_type_id'=>$attribute_type_id])->getField('attribute_type_title'); //根据上面得到的ID 获取属性输入类型

                    //根据不同输入类型 进行不同的插入处理
                    switch ($attributeType) {
                        case 'text':// 文本输入
                            $data = [
                                'goods_id'  => $goods_id,
                                'attribute_id'  => $attribute_id,
                                'value' => $value,
                            ];
                            //crea()创建数据
                            if ($modelGoodsAttribute->create($data)) {  //需要验证 还未作验证
                                $modelGoodsAttribute->add(); //插入文本框输入的值
                            }
                            break;
                        case 'select': // 单选
                            // 先插入goods_attribute
                            $data = [
                                'goods_id'  => $goods_id,
                                'attribute_id'  => $attribute_id,
                            ];
                            if ($modelGoodsAttribute->create($data)) {
                                $goods_attribute_id = $modelGoodsAttribute->add();
                                // 插入goods_attribute_option表
                                $data = [
                                    'goods_attribute_id'  => $goods_attribute_id,
                                    'attribute_option_id'  => $value,
                                ];
                                $modelGoodsAttributeOption->add($data);
                            }
                            break;
                        case 'select-multi':// 多选
                            // 先插入goods_attribute
                            $data = [
                                'goods_id'  => $goods_id,
                                'attribute_id'  => $attribute_id,
                                //判断是否存在于is_option数组中
                                'product_option' => in_array($attribute_id, I('post.is_option', [])) ? 1 : 0,
                            ];
                            if ($modelGoodsAttribute->create($data)) {
                                $goods_attribute_id = $modelGoodsAttribute->add();
                                // 插入goods_attribute_option表
                                $rows = array_map(function($v) use($goods_attribute_id) {
                                    return [
                                        'goods_attribute_id'    =>$goods_attribute_id,
                                        'attribute_option_id'   => $v,
                                    ];
                                }, $value);

                                $modelGoodsAttributeOption->addAll($rows);
                            }
                            break;

                    }
                }
				$this->redirect('list');//重定向到列表
			}else{
				//将错误保存 到session中,便于下个页面显示错误信息
				session('message',['error'=>1,'errorIfo'=>$model->getError()]);
				session('data',$_POST);
				$this->redirect('add');//重定向到添加

			}
		}else{
			//获取分配到模版，删除，一次性session会话数据
		 	$this->assign('message',session('message'));
		 	session('message',null);
		 	$this->assign('data',is_null(session('data')) ? $model->find(I('get.goods_id')) : session('data'));
		 	session('data',null);

		 	// 获取对应的数据
           	$this->assign('sku_list', M('Sku')->select());//分配库存单位列表
           	$this->assign('tax_list', M('Tax')->select());//分配税类型列表
           	$this->assign('stock_status_list', M('StockStatus')->select());//库存状态列表
           	$this->assign('length_unit_list', M('LengthUnit')->select());//长度单位列表
           	$this->assign('weight_unit_list', M('WeightUnit')->select());//重量单位列表
           	$this->assign('brand_list', M('Brand')->select());//品牌列表
           	$this->assign('category_list', D('Category')->getTreeList());//分类列表
            $this->assign('type_list',M('Type')->select());//类型列表

			$this->display('set'); //展示添加表单页面
		}
	}



	//更新
	public function editAction(){

		$model = D('Goods');
		if(IS_POST){
			if($model->create()){//校验
				$model->save(); //更新

				 // 新相册图像的添加
//                旧相册图像相关信息的更新
                $modelGallery = M('Gallery');
                // 形成带有goods_id字段的每条记录数据
                $newGalleryList = [];
                foreach(I('post.galleries') as $key=>$value) {
                    // 判断当前的相册新增还是更新
                    if(isset($value['gallery_id'])) {
                        // 是gallery_id, 是更新
                        $modelGallery->save($value);
                    } else {
                        $value['goods_id'] = I('post.goods_id');
                        $newGalleryList[] = $value;
                    }
                }
                // 批量插入
                $modelGallery->addAll($newGalleryList);

                // 处理商品属性数据
                // type_id自动处理
                $goods_id = I('post.goods_id');
                $modelAttribute = M('Attribute');
                $modelAttributeType = M('AttributeType');
                $modelGoodsAttribute = M('GoodsAttribute');
                $modelGoodsAttributeOption = M('GoodsAttributeOption');
                // 删除已有的属性值
                $modelGoodsAttributeOption->where([
                    'goods_attribute_id' => ['in', $modelGoodsAttribute->where(['goods_id'=>$goods_id])->getField('goods_attribute_id', true)]
                ])->delete();
                $modelGoodsAttribute->where(['goods_id'=>$goods_id])->delete();

                foreach(I('post.attribute', []) as $attribute_id => $value) {
                    // 判断当前的属性类型
                    $attribute_type_id = $modelAttribute->where(['attribute_id'=>$attribute_id])->getField('attribute_type_id');
                    $attributeType = $modelAttributeType->where(['attribute_type_id'=>$attribute_type_id])->getField('attribute_type_title');

                    switch ($attributeType) {
                        case 'text':// 文本输入
                            $data = [
                                'goods_id'  => $goods_id,
                                'attribute_id'  => $attribute_id,
                                'value' => $value,
                            ];
                            if ($modelGoodsAttribute->create($data)) {
                                $modelGoodsAttribute->add();
                            }
                            break;
                        case 'select': // 单选
                            // 先插入goods_attribute
                            $data = [
                                'goods_id'  => $goods_id,
                                'attribute_id'  => $attribute_id,
                            ];
                            if ($modelGoodsAttribute->create($data)) {
                                $goods_attribute_id = $modelGoodsAttribute->add();
                                // 插入goods_attribute_option表
                                $data = [
                                    'goods_attribute_id'  => $goods_attribute_id,
                                    'attribute_option_id'  => $value,
                                ];
                                $modelGoodsAttributeOption->add($data);
                            }
                            break;
                        case 'select-multi':// 多选
                            // 先插入goods_attribute
                            $data = [
                                'goods_id'  => $goods_id,
                                'attribute_id'  => $attribute_id,
                                //判断是否存在于is_option数组中
                                'product_option' => in_array($attribute_id, I('post.is_option', [])) ? 1 : 0,
                            ];
                            if ($modelGoodsAttribute->create($data)) {
                                $goods_attribute_id = $modelGoodsAttribute->add();
                                // 插入goods_attribute_option表
                                $rows = array_map(function($v) use($goods_attribute_id) {
                                    return [
                                        'goods_attribute_id'    =>$goods_attribute_id,
                                        'attribute_option_id'   => $v,
                                    ];
                                }, $value);

                                $modelGoodsAttributeOption->addAll($rows);
                            }
                            break;

                    }
                }

				$this->redirect('list');//重定向到列表
			}else{
				// 将错误信息存储到session中, 便于下个页面输出错误消息
				session('message',['error'=>1,'errorInfo'=>$model->getError()]);
				session('data', $_POST);
				$this->redirect('edit', ['goods_id'=>I('post.goods_id')]); // 重定向到添加
			} 
		}else{
			$this->assign('message',session('message'));
			session('message',null);
			// 获取当前编辑的内容, 如果是编辑错误,则显示错误的内容, 如果是没有错误, 则显示原始数据内容
            $data = is_null(session('data')) ? $model->find(I('get.goods_id')) : session('data');
            $this->assign('data', $data);
			session('data',null);

			// 获取对应的数据
           	$this->assign('sku_list', M('Sku')->select());
           	$this->assign('tax_list', M('Tax')->select());
           	$this->assign('stock_status_list', M('StockStatus')->select());
           	$this->assign('length_unit_list', M('LengthUnit')->select());
           	$this->assign('weight_unit_list', M('WeightUnit')->select());
           	$this->assign('brand_list', M('Brand')->select());
           	$this->assign('category_list', D('Category')->getTreeList());
           	// 商品相册图像
           	$this->assign('gallery_list', M('Gallery')->where(['goods_id'=>I('get.goods_id')])->select());
            $this->assign('type_list',M('Type')->select());//类型列表

            // 商品类型下全部的商品属性 包含输入类型和属性选项
            /*array(4) {
                [0] => array(7) {
                    ["attribute_type_id"] => string(1) "2"
                    ["attribute_id"] => string(1) "2"
                    ["attribute_title"] => string(9) "处理器"
                    ["type_id"] => string(1) "1"
                    ["sort_number"] => string(1) "0"
                    ["attribute_type_title"] => string(6) "select"
                    ["optionList"] => array(3) {
                        [0] => array(3) {
                            ["attribute_option_id"] => string(1) "5"
                            ["attribute_id"] => string(1) "2"
                            ["option_value"] => string(9) "骁龙888"
                            }
                        [1] => array(3) {
                            ["attribute_option_id"] => string(1) "6"
                            ["attribute_id"] => string(1) "2"
                            ["option_value"] => string(9) "骁龙999"
                            }
                        [2] => array(3) {
                            ["attribute_option_id"] => string(1) "7"
                            ["attribute_id"] => string(1) "2"
                            ["option_value"] => string(9) "骁龙666"
                            }
                    }
                }*/
            $attribute_list = D('Attribute')
                ->alias('a')
                ->join('left join __ATTRIBUTE_TYPE__ at using(attribute_type_id)')
                ->relation(true)
                ->where(['type_id'=>$data['type_id']])
                ->select();
            // 当前商品的以选的属性或者填写的值
            /*
             array(4) {
                [0] => array(6) {
                    ["goods_attribute_id"] => string(1) "1"
                    ["goods_id"] => string(1) "2"
                    ["attribute_id"] => string(1) "2"
                    ["product_option"] => string(1) "0"
                    ["value"] => string(0) ""
                    ["GoodsOptionList"] => array(1) {
                        [0] => array(3) {
                            ["goods_attribute_option_id"] => string(1) "1"
                            ["goods_attribute_id"] => string(1) "1"
                            ["attribute_option_id"] => string(1) "5"
                        }
                    }
                }

            */
            $goods_attribute_list = D('GoodsAttribute')
                ->alias('ga')
                ->relation(true)
                ->where(['goods_id'=>$data['goods_id']])
                ->select();
            //dump($goods_attribute_list);
            // 合并
            $attribute_merge_list = [];
            foreach($attribute_list as $attribute ) {
                foreach($goods_attribute_list as $goods_attribute) {
                    if ($attribute['attribute_id'] == $goods_attribute['attribute_id']) {
                        // 获取被选中的id的集合
                        $goods_attribute['checked_list'] = array_map(function($v) {
                            return $v['attribute_option_id'];
                        },$goods_attribute["GoodsOptionList"] );
                        $attribute_merge_list[$attribute['attribute_id']] = array_merge($attribute, $goods_attribute);
                        break ;
                    }
                }
            }
            //dump($attribute_merge_list);
            $this->assign('attribute_merge_list', $attribute_merge_list);


			 //展示
			$this->display('set');
		}
	}
	


	//brand 列表
	public function listAction(){
		$model = M('Goods');

		//查询条件
		$cond = [];//初始化查询条件
		$filter = [];//初始化一个用于记录查询条件的数组，分配到视图模板中
		//自己完成的部分，特殊业务逻辑
		//继续判断其他字段，入$cond和$filter数组即可
        // 所有检索结束, 分配搜索条件
        $this->assign('filter',$filter);
      
        //分页
        $pagesize=4;
        //计算总页数
        $total= $model->where($cond)->count();//所有符合条件的记录
        $totalPage=ceil($total/$pagesize);// 计算总页数 celi向上取整
        $p = C('VAR_PAGE')?C('VAR_PAGE'):'p';//当前的翻页参数
        $page = I('get.'.$p,'1','intval'); //默认为 第1页
        //是否越界
        if($page<1){ //页数小于1
        	$page=1;
        }
        if ($page > $totalPage) { // 页数大于总页数
            $page = $totalPage;
        }
        //参数1  偏移量 参数2 显示数量
        $model->page("$page,$pagesize");

        //形成翻页操作接口 参数1 满足要求的总记录数 参数2 每页显示的记录数
        $toolPage = new Page($total,$pagesize);
        //定制样式结构 
   		$toolPage->rollPage=3;
   		$toolPage->lastSuffix=false;
        $toolPage->setConfig('header','显示开始 %FIRST_NUM% 到 %LAST_NUM% 之 %TOTAL_ROW% (总 %TOTAL_PAGE% 页)');
        $toolPage->setConfig('prev','&lt');//上一页样式设置
        $toolPage->setConfig('next','&gt');//下一页样式设置
        $toolPage->setConfig('first','|&lt'); //首页样式设置
        $toolPage->setConfig('last','&gt;|');//尾页样式设置
        //分页主题描述信息 

        $toolPage->setConfig('theme', "<div class='col-sm-6 text-right'><ul class='pagination'>%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%</ul></div><div class='col-sm-6 text-right'>%HEADER%</div>");
        $this->assign('pageHtml',$toolPage->show());

        //排序
        $sort = [ // 存储需要排序的字段 和排序类型 默认的排序方式  升序
        	'field'=>I('get.sort_field',null), //I函数 第二参数为默认值
       		'type'=>I('get.sort_type','asc'),
        ];
        //确定排序字符串
        if(!empty($sort['field'])){ //判断是否为空
            //拼接排序sql语句
            $sortString = $sort['field'].' '.$sort['type'];
            //进行排序
            $model->order($sortString);
        }

        //将当前排序方式分配到模板
        $this->assign('sort',$sort);

        //执行查询
        $list = $model->where($cond)->select();
        $this->assign('list',$list);

        //展示
        $this->display();
	}

	//提供批量处理的操作
	public function multiAction(){

		$operate = I('post.operate',null);

		//先处理删除
		$operate='delete';
		switch ($operate) {
			case 'delete':
				$model=M('Goods');
				$model->where(['goods_id'=>['in',I('post.selected')]])->delete();
				break;
		}

		$this->redirect('list');
	}


	 public function ajaxAction()
    {

        switch (I('request.operate', '')) {
            case 'getAttrList':
                $rows = D('Attribute')
                    ->alias('a')
                    ->join('left join __ATTRIBUTE_TYPE__ at using(attribute_type_id)')
                    ->relation(true)
                    ->where(['type_id'=>I('request.type_id')])
                    ->select();
                if ($rows) {
                    $this->ajaxReturn(['error'=>0, 'rows'=>$rows]);
                } else {
                    $this->ajaxReturn(['error'=>1,'errorInfo'=>'没有属性']);
                }
                break;
            case 'imageUpload':
                $toolUpload = new Upload();
                $toolUpload->exts = ['png', 'jpeg', 'jpg', 'gif'];// 允许类型
                $toolUpload->maxSize = 1 * 1024 * 1024;// 1M
                $toolUpload->rootPath = APP_PATH . 'Upload/';// 上传的根目录
                $toolUpload->savePath = 'Goods/';// 保证目录存在
                // 执行上传
                $uploadInfo = $toolUpload->uploadOne($_FILES['imageAjax']);
                if ($uploadInfo) {
                    // 成功, 按照需要的格式进行响应
                    $image = $uploadInfo['savepath'] . $uploadInfo['savename'];
//                    创建public/Thumb/日期
                    $toolImage = new Image();
                    if (! is_dir ('./Public/Thumb/' . $uploadInfo['savepath'])) {
                        mkdir ('./Public/Thumb/' . $uploadInfo['savepath'], 0764, true);
                    }
                    $toolImage
                        ->open(APP_PATH . 'Upload/' . $image)
                        // 出现对图像的操作(裁剪, 缩略图, 水纹)
                        ->thumb(300, 340)// 缩略图
                        ->save('./Public/Thumb/' . $image);
                    // 原始文件名, 缩略图文件名
                    // 制作响应数据
                    $this->ajaxReturn(['error'=>0, 'imageAjax'=>['image'=>$image, 'image_thumb'=>$image, 'thumbUrl'=>$image]]);
                }
                break;

            case 'galleriesUpload':
                $toolUpload = new Upload();
                $toolUpload->exts = ['png', 'jpeg', 'jpg', 'gif'];// 允许类型
                $toolUpload->maxSize = 1 * 1024 * 1024;// 1M
                $toolUpload->rootPath = APP_PATH . 'Upload/';// 上传的根目录
                $toolUpload->savePath = 'Gallery/';// 保证目录存在
                // 执行上传
                $uploadInfo = $toolUpload->uploadOne($_FILES['galleriesAjax']);
                if ($uploadInfo) {
                    // 成功, 按照需要的格式进行响应
                    $image = $uploadInfo['savepath'] . $uploadInfo['savename'];
//                    创建public/Thumb/日期
                    $toolImage = new Image();
                    if (! is_dir ('./Public/Thumb/' . $uploadInfo['savepath'])) {
                        mkdir ('./Public/Thumb/' . $uploadInfo['savepath'], 0764, true);
                    }
                    // 创建大中小三种缩略图
                    $toolImage->open(APP_PATH . 'Upload/' . $image);
                    // 大缩略图 填充
                    $bigImage = $uploadInfo['savepath'] . 'big-' . $uploadInfo['savename'];
                    $toolImage->thumb(800, 800, Image::IMAGE_THUMB_FILLED)->save('./Public/Thumb/' . $bigImage);
                    // 中缩略图 填充
                    $mediumImage = $uploadInfo['savepath'] . 'medium-' . $uploadInfo['savename'];
                    $toolImage->thumb(300, 300, Image::IMAGE_THUMB_FILLED)->save('./Public/Thumb/' . $mediumImage);
                    // 小缩略图 填充
                    $smallImage = $uploadInfo['savepath'] . 'small-' . $uploadInfo['savename'];
                    $toolImage->thumb(60, 60, Image::IMAGE_THUMB_FILLED)->save('./Public/Thumb/' . $smallImage);
                    // 原始文件名, 缩略图文件名
                    // 制作响应数据
                    $this->ajaxReturn([
                        'error'=>0,
                        'image'=>$image,
                        'image_small'=>$smallImage,
                        'image_medium'=>$mediumImage,
                        'image_big'=>$bigImage,
                        'key'=>strchr($uploadInfo['savename'], '.', true),
                        'savepath'=>$uploadInfo['savepath'],
                        'ext' => strrchr($uploadInfo['savename'], '.'),
                    ]);
                }
                break;

                case 'galleryRemove':
                    // 判断当前是否传输了gallery_id
                    $gallery_id = I('request.gallery_id', null);
                    if (is_null($gallery_id)) {
                        $image = I('request.key') . I('request.ext');
                        $savepath = I('request.savepath');
                    } else {
                        // gallery_ID传递
                        $imageLong = M('Gallery')->where(['gallery_id'=>$gallery_id])->getField('image');
                        //sub没有指定截取个数则默认截取到字符串末尾
                        $image = substr($imageLong, strrpos($imageLong, '/')+1);
                        $savepath = substr($imageLong, 0, strrpos($imageLong, '/')+1);

                        // 删除记录
                        M('Gallery')->delete($gallery_id);
                    }
                    //删图像文件
                    @unlink(APP_PATH . 'Upload/' . $savepath . $image);// 上传的原图
                    @unlink('./Public/Thumb/' . $savepath . 'big-' . $image);// 大图
                    @unlink('./Public/Thumb/' . $savepath . 'medium-'. $image);// 中图
                    @unlink('./Public/Thumb/' . $savepath . 'small-' . $image);// 小图

                    $this->ajaxReturn(['error'=>0]);
                break;
            case 'addProduct':
                // 先生成product记录
                $modelProduct = M('Product');
                $product_id = $modelProduct->add(I('request.')); //插入获取到的所有值

                // 生成product_goods_attribute_option 货品与已知商品的属性对应关系表
                $modelPGAO = M('ProductGoodsAttributeOption');
                $rows = array_map(function($goods_attribute_option_id)  use($product_id) {
                    return [
                        'product_id' => $product_id, //货品id
                        'goods_attribute_option_id' => $goods_attribute_option_id, //商品属性选项id
                    ];
                }, I('request.option', []));
                $modelPGAO->addAll($rows);

                $product['product_id'] = $product_id;
                $product = array_merge($product, I('request.'));//array_merge合并数组 添加了货品Id 的所有数据
                // 通过所选的选项ID获取选项内容  商品属性选项表
                $modelGAO = M('GoodsAttributeOption');
                //遍历可选属性值 就是$goods_attribute_option_id
                foreach($product['option'] as $goods_attribute_option_id) {
                    //链接属性选项表 拿到该ID对应的属性选项信息 --- 属性id 属性标题
                    $row = $modelGAO
                        ->join('left join __ATTRIBUTE_OPTION__ using(attribute_option_id)')
                        ->find($goods_attribute_option_id);
                    $product['optionList'][] = $row; //添加到数组
                }
                //得到所有信息  分配到页面
                $this->assign('product', $product);
                //分配价格浮动列表  + - =
                $this->assign('priceDriftList', M('PriceDrift')->select());
                //显示货品行 相当与返回到js中
                $this->display('product_row');
                break;
            default:
                $this->ajaxReturn(['error'=>1, 'errorInfo'=>'操作错误']);
                break;
        }
    }
    /**
     * 货品操作
     */
    public function productAction()
    {
        // 获取当前商品的货品选项属性列表
        $goods_id = I('get.goods_id');
        $modelGoodsAttribute = M('GoodsAttribute');
        //拿到为选项的属性信息
        $optionList = $modelGoodsAttribute
            ->alias('ga')
            ->join('left join __ATTRIBUTE__ a using(attribute_id)')
            ->where(['goods_id'=>$goods_id, 'product_option'=>'1'])
            ->select();

        // 遍历当前的商品货品属性, 获取当前货品属性对应已选的属性选项值
        $modelGoodsAttributeOption = M('GoodsAttributeOption');
        foreach($optionList as $key=>$option) {
            $valueList = $modelGoodsAttributeOption
                ->alias('gao')
                ->join('left join __ATTRIBUTE_OPTION__ ao using(attribute_option_id)')
                ->where(['goods_attribute_id'=>$option['goods_attribute_id']])
                ->select();
            $optionList[$key]['valueList'] = $valueList;
        }

        $this->assign('optionList', $optionList);//选项列表

        $this->assign('priceDriftList', M('PriceDrift')->select());//价格增减确定

        $this->assign('goods_id', I('get.goods_id'));//商品id

        // 已有货品列表即可
        $productList = M('Product')
            ->where(['goods_id'=>I('get.goods_id')])
            ->select();
        //遍历货品信息
        foreach($productList as $key=>$product) {
            // 货品与已知商品的属性对应关系表 最终得到货品中的 属性选项值
            $rows = M('ProductGoodsAttributeOption')
                //链接商品属性选项表
                ->join('left join __GOODS_ATTRIBUTE_OPTION__ using(goods_attribute_option_id)')
                //链接属性选项表
                ->join('left join __ATTRIBUTE_OPTION__ using(attribute_option_id)')
                ->where(['product_id'=>$product['product_id']])
                ->select();
            //存入到分配数据数组中
            $productList[$key]['optionList'] = $rows;
        }
        $this->assign('productList', $productList);

        $this->display();
    }
}