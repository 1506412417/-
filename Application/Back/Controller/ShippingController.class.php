<?php
namespace Back\Controller;
use Think\Controller;
use Think\Page;

class ShippingController extends Controller
{
	//添加
	public function addAction(){
		$model = D('Shipping');//自定义模块
		if(IS_POST){  //判断是否提交了表单
			
			if($model->create()){ //校验
				$model->add();//添加
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
		 	$this->assign('data',session('data'));
		 	session('data',null);

			$this->display('set'); //展示添加表单页面
		}
	}



	//更新
	public function editAction(){

		$model = D('Shipping');
		if(IS_POST){
			if($model->create()){//校验
				$model->save(); //更新
				$this->redirect('list');//重定向到列表
			}else{
				// 将错误信息存储到session中, 便于下个页面输出错误消息
				session('message',['error'=>1,'errorInfo'=>$model->getError()]);
				session('data', $_POST);
				$this->redirect('edit', ['shipping_id'=>I('post.shipping_id')]); // 重定向到添加
			} 
		}else{
			$this->assign('message',session('message'));
			session('message',null);
			// 获取当前编辑的内容, 如果是编辑错误,则显示错误的内容, 如果是没有错误, 则显示原始数据内容
			 $this->assign('data', is_null(session('data')) ? $model->find(I('get.shipping_id')) : session('data'));
			 session('data',null);

			//展示
			$this->display('set');
		}
	}
	


	//brand 列表
	public function listAction(){
		$model = M('Shipping');



        //排序
        $sort = [ // 存储需要排序的字段 和排序类型 默认的排序方式  升序
        	'field'=>I('get.sort_field','sort_number'), //I函数 第二参数为默认值
       		'type'=>I('get.sort_type','asc'),
        ];
        //确定排序字符串
        if(!is_null($sort['field'])){ //判断是否为空
            //拼接排序sql语句
            $sortString = $sort['field'].' '.$sort['type'];
            //进行排序
            $model->order($sortString);
        }

        //将当前排序方式分配到模板
        $this->assign('sort',$sort);

		// 二: 执行查询
		$rows = $model->select();
		foreach($rows as $k=>$row) {  //数据库有文件无 删数据库数据
			// 判断对应的文件是否存在
			if (! file_exists(APP_PATH . 'Common/Shipping/' . $row['key'] . '.class.php')) {
				// 已经被删除了
//                从数据表中也删除
				M('Shipping')->where(['key'=>$row['key']])->delete();
			} else {

				$list[$row['key']] = $row;//包含数据表中的一条记录 例$list['shunfeng']
			}
		}
		// 三: 从插件目录获取新的内容    文件有数据库无 存数据库
		$handle = opendir(APP_PATH . 'Common/Shipping'); //打开文件夹
		while(false !== $filename = readDir($handle)) { //遍历文件夹下子目录
			if ($filename == '.' || $filename == '..') continue; //维持原状
			// 从文件名截取类名 第三个参数为true截取之前
			$key = strchr($filename, '.', true);
			// 出现了一个目录中的插件名字
			// 判断 该方式, 是否在数据表中可以获取到.
			if (! isset($list[$key])) {
				// 出现了没有在数据表中的文件类
				$shippingName = 'Common\Shipping\\' . $key; //命名空间方法实例化类
				// 判断该类是否是合理的配送类, (通过反射来实现)
				$rc = new \ReflectionClass($shippingName);
				// 结构分析 判断是否实现了接口
				if ($rc->implementsInterface('Common\Interfaces\I_Shipping')) {
					$shipping = $rc->newInstance();// 代理执行实例化
					$list[$key] = ['key'=>$key, 'title'=>$shipping->title(), 'is_new'=>1];//存储到列表中
				}

			}
		}
		closedir($handle);  //关闭文件

        $this->assign('list',$list);

        //展示
        $this->display();
	}

	/**
	 * 安装配送方式
	 * 存储到数据表
	 * 是否开启字段在数据表中设计的默认为1不用添加
	 */
	public function installAction()
	{
		$key = I('get.key');
		$shippingName = 'Common\Shipping\\' . $key;
		$shipping = new $shippingName;
		$data = [
			'key' => $key,
			'title' => $shipping->title(),
		];
		M('Shipping')->add($data);

		$this->redirect('list');
	}

	//提供批量处理的操作
	public function multiAction(){

		$operate = I('post.operate',null);

		//先处理删除
		$operate='delete';
		switch ($operate) {
			case 'delete':
				$model=M('Shipping');
				$model->where(['shipping_id'=>['in',I('post.selected')]])->delete();
				break;
		}

		$this->redirect('list');
	}
}