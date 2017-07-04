<?php
namespace Back\Controller;
use Think\Controller;
use Think\Page;

class TypeController extends Controller
{
	//添加
	public function addAction(){
		$model = D('Type');//自定义模块
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

		$model = D('Type');
		if(IS_POST){
			if($model->create()){//校验
				$model->save(); //更新
				$this->redirect('list');//重定向到列表
			}else{
				// 将错误信息存储到session中, 便于下个页面输出错误消息
				session('message',['error'=>1,'errorInfo'=>$model->getError()]);
				session('data', $_POST);
				$this->redirect('edit', ['type_id'=>I('post.type_id')]); // 重定向到添加
			} 
		}else{
			$this->assign('message',session('message'));
			session('message',null);
			// 获取当前编辑的内容, 如果是编辑错误,则显示错误的内容, 如果是没有错误, 则显示原始数据内容
			 $this->assign('data', is_null(session('data')) ? $model->find(I('get.type_id')) : session('data'));
			 session('data',null);

			//展示
			$this->display('set');
		}
	}
	


	//brand 列表
	public function listAction(){
		$model = M('Type');

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
				$model=M('Type');
				$model->where(['type_id'=>['in',I('post.selected')]])->delete();
				break;
		}

		$this->redirect('list');
	}
}