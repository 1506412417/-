<?php
namespace Back\Controller;
use Think\Controller;
use Think\Page;

class CategoryController extends Controller
{
	//添加
	public function addAction(){
		$model = D('Category');//自定义模块
		if(IS_POST){  //判断是否提交了表单
			
			if($model->create()){ //校验
				$model->add();//添加
				// 初始缓存配置
				S([
					'type' => 'Memcache',
					'host'  => '192.168.245.128',
					'port'  => '11211',
				]);
				// 删除
				S('category_tree', null);
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

		 	// 分类列表
			$this->assign('list', $model->getTreeList());
			$this->display('set'); //展示添加表单页面
		}
	}



	//更新
	public function editAction(){

		$model = D('Category');
		if(IS_POST){
			if($model->create()){//校验
				$model->save(); //更新
				// 初始缓存配置
                S([
                    'type' => 'Memcache',
                    'host'  => '192.168.245.128',// CC('MEMCACHE_HOST')
                    'port'  => '11211',
                ]);
                // 删除
                S('category_tree', null);
				$this->redirect('list');//重定向到列表
			}else{
				// 将错误信息存储到session中, 便于下个页面输出错误消息
				session('message',['error'=>1,'errorInfo'=>$model->getError()]);
				session('data', $_POST);
				$this->redirect('edit', ['category_id'=>I('post.category_id')]); // 重定向到添加
			} 
		}else{
			$this->assign('message',session('message'));
			session('message',null);
			// 获取当前编辑的内容, 如果是编辑错误,则显示错误的内容, 如果是没有错误, 则显示原始数据内容
			 $this->assign('data', is_null(session('data')) ? $model->find(I('get.category_id')) : session('data'));
			 session('data',null);
		}
		// 分类列表
		$this->assign('list', $model->getTreeList());
		//展示
		$this->display('set');
	}


	/**
     * 删除
     */
    public function deleteAction()
    {	
        $model=M('Category');
        //获取当前分类id
        $category_id=I('request.category_id');
        //查询父级id等于当前id的 只需要一条足以
        $leaf=$model->where(['parent_id'=>$category_id])->find();

        //判断有无叶子分类
        if($leaf){
        	//有子分类
           	$this->error('分类下有子类不能删除','',1);
        }else{
        	//echo '查询分类下的商品 放置到未分类 删除分类';
        	$delete=$model->delete($category_id);

        	// 初始缓存配置
			S([
				'type' => 'Memcache',
				'host'  => '192.168.245.128',
				'port'  => '11211',
			]);
			// 删除
			S('category_tree', null);
			//跳转到上一个页面 等待时间为1
        	$this->success('删除成功', '',1);
        }
    }

	/**
	 * 分类列表
	 */
	public function listAction()
	{

		$modelCategory = D('Category');

		$this->assign('list', $modelCategory->getTreeList());

		$this->display();
	}

	//提供批量处理的操作
	public function multiAction(){

		$operate = I('post.operate',null);

		//先处理删除
		$operate='delete';
		switch ($operate) {
			case 'delete':
				$model=M('Category');
				$model->where(['category_id'=>['in',I('post.selected')]])->delete();

				// 初始缓存配置
				S([
					'type' => 'Memcache',
					'host'  => '192.168.245.128',
					'port'  => '11211',
				]);
				// 删除
				S('category_tree', null);
				break;
		}

		$this->redirect('list');
	}
}