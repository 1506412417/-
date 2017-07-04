<?php

namespace Back\Controller;
use Think\Controller;

class CodeController extends Controller
{
	//生成CRUD动作，table 和 field 两个步骤，分开进行处理
	public function crudAction(){
		//确定当前步骤，没有传递，当前进入第一步
		$step = I('get.step','table');
        //判断是否在第一步,session=table
		if('table' == $step){
			if(IS_POST){
				//检测表是否存在
				//记录当前表名，中文名，到session中
				session('crud',['table'=>I('post.table'),'title'=>I('post.title')]);
				//进入到步骤二
				$this->redirect('crud',['step'=>'field']);
			}else{
				$this->assign('setp','table'); //分配步骤一
				$this->display();
			}
		}elseif('field'==$step){ //判断是否进入第二步
			//步骤二
			//先获取模型
			$model = M(session('crud.table'));
			// getDbFields获取表的字段列表, 利用模型即可完成  
			$fieldList = $model->getDbFields(); 
			if(IS_POST){
				// 生成代码
                // 〇: 生成需要替换的数据
                // 1, 模型和控制器 名
                // 表名 使用_拆分后,首字母大写, 再连接
                // explode, 拆分一个字符串为数组
                // array_map, 针对数组元素, 调用特定的函数, 返回每个元素执行函数后的结果数组
                // ucfirst, 首字母大写
                // implode, 数组元素连接成一个字符串
                //ucfirst首字母大写  uc（uppercase）大写字母
                $controllerName = $modelName = implode(array_map('ucfirst',explode('_',$model->getModelName())));
                //getPk() 获取主键字段名(存在一个独立的主键字段)
                $pkField = $model->getPk();
                //获取当前字段列表 Collection采集
                $fieldCollection= I('post.field');//包含配置信息的全部字段
               
                //获取表对应的展示标题
                $tableTitle = session('crud.title');


                //一:生成控制器代码
                //利用控制器模板，完成控制器代码生成 
                $template = APP_PATH.'Back/Code/controller.template';//APP_PATH当前项目的地址
                //将整个文件读取成字符串
                $content = file_get_contents($template);
                //记录需要替换的对应内容
                $search  = ['__CONTROLLER__','__MODEL__','__PK_FIELD__'];
                //替换后的对应内容
                $replace = [$controllerName,$modelName,$pkField];
                //替换 str_replace（a,b,c）把c字符串里的a替换b
                $content = str_replace($search,$replace,$content);
                //存储生成文件地址
                $file = APP_PATH.'Back/Controller/'.$controllerName.'Controller.class.php';
                //将字符串写成文件 参数1 文件路径 参数2 字符串
                file_put_contents($file, $content);
                echo '控制器文件：',$file,'生成成功',"\n<br>";

                //生成模型代码
                $template = APP_PATH .'Back/Code/model.template';
                $content = file_get_contents($template);
                //记录需要替换的对应内容
                $search = ['__CONTROLLER__','__MODEL__','__PK_FIELD__'];
                $replace=[$controllerName,$modelName,$pkField];
                $content=str_replace($search,$replace,$content);
                $file=APP_PATH .'Back/Model/'.$modelName.'Model.class.php';
                file_put_contents($file, $content);
                echo '模型文件：',$file,'生成成功',"\n<br>";

                //三：生成模版
                $theadTdList = $tbodyTdList = $setFieldList = '';
                //$fieldCollection包含所有选项信息 
                /*
                array(2) {
                    ["event_id"] => array(4) {
                        ["title"] => string(0) ""
                        ["is_set"] => string(1) "1"
                        ["is_list"] => string(1) "1"
                        ["is_sort"] => string(1) "1"
                    }
                    ["title"] => array(4) {
                        ["title"] => string(0) ""
                        ["is_set"] => string(1) "1"
                        ["is_list"] => string(1) "1"
                        ["is_sort"] => string(1) "1"
                    }
                }
                */
                foreach($fieldCollection as $field => $option) {
                //形成字段相关的查找替换 字段 字段标题
                $search = ['__FIELD__', '__FIELD_TITLE__',];
                //替换的内容  字段名 ，展示的字段名（如果没填为空则用字段名代替） 
                $replace = [$field, $option['title']!=='' ? $option['title'] : $field];


                //为list模版生成：字段和选项
                //判断‘是否列表’是否设置 （checkbox类型 选中才会提交，不选中不会提交）
                //只要有其他选项，就必须显示，所以先进行判断
                if (isset($option['is_list'])) {
                	//需要在列表中显示 
                	//处理thead，判断是否排序 采用不同模板
                	if (isset($option['is_sort'])) {
                		$template = APP_PATH . 'Back/Code/listTheadTdSortView.template';
                	}else{
                		//不需要排序
                		$template = APP_PATH . 'Back/Code/listTheadTdView.template';
                	}
                    //将模板转换成字符串
                	$content = file_get_contents($template);
                    //替换
                	$content = str_replace($search, $replace, $content);
                    //将循环出来的表头拼接 一个标题一个td
                	$theadTdList .= $content;
                	//处理Body部分
                	$template = APP_PATH . 'Back/Code/listTbodyTdView.template';
                	$content = file_get_contents($template);
                	$content = str_replace($search, $replace, $content);
                    $tbodyTdList .= $content;
                }

                //为set生成模板，生成字段
                if(isset($option['is_set'])){
                    if($field == $pkField) continue;

                	   $template = APP_PATH . 'Back/Code//setFieldView.template';
                	   $content = file_get_contents($template);
                	   $content = str_replace($search, $replace, $content);
                	   $setFieldList .=$content;
                    }
	 	        }
			    //替换list模板整体
			    $template = APP_PATH.'Back/Code/listView.template';
			    $content = file_get_contents($template);
			    //记录需要替换的对应内容
			    $search = ['__TITLE__','__THEAD_LIST__','__TBODY_LIST__','__PK_FIELD__'];
                $replace = [$tableTitle,$theadTdList,$tbodyTdList, $pkField];
			    $content = str_replace($search,$replace,$content);
			    $path= APP_PATH.'Back/View/'.$controllerName;
			    if(!is_dir($path)){
			    	mkdir($path);
			    }
			    $file = $path.'/list.html';
			    file_put_contents($file, $content);
			    echo '列表视图文件：',$file,'生成成功',"\n<br>";

			
			 // 替换set整体模板
            $template = APP_PATH . 'Back/Code/setView.template';
            $content = file_get_contents($template);
            // 记录需要替换的对应内容
            $search = ['__TITLE__', '__FIELD_LIST__', '__PK_FIELD__'];
            $replace = [$tableTitle, $setFieldList, $pkField];
            $content = str_replace($search, $replace, $content);
            $path = APP_PATH . 'Back/View/' . $controllerName;
            if (!is_dir($path)) {
                mkdir ($path);
            }
            $file = $path . '/set.html';
            file_put_contents($file, $content);
            echo 'set视图文件: ', $file, ' 生成成功', "\n<br>";
            //$this->redirect('crud',['step'=>''],1); //跳转到代码生成
            $this->redirect(session('crud.table').'/list','',2);//跳转到生成后列表
            }else{

                $this->assign('fieldList',$fieldList);
                $this->assign('step','field');
                $this->display();
            }
        }
	}
}