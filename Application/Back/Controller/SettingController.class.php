<?php
namespace Back\Controller;

use Think\Controller;

class SettingController extends Controller
{

    /**
     * 设置页面
     */
    public function setAction(){

        S(['type'=>'File']);//初始化缓存 文件类型
        if(! $groupList = S('groupList')) {
            //没有缓存
            //一：获取所有的配置项分组
            $modelGroup = M('SettingGroup');
            $groupList = $modelGroup->order('sort_number')->select();
            // 生成缓存
            S('groupList', $groupList);
        }
        $this->assign('groupList',$groupList);


        if (! $settingGroupList = S('settingGroupList')) {
            //二：获取所有的配置项，依据分组管理（数据整理成，可以找到某个分组内的全部配置的格式
            //1，获取所有配置项
            $modelSetting = D('Setting');
            $settingList = $modelSetting
                ->alias('s')//alia别名
                ->join('left join __SETTING_TYPE__ st using(setting_type_id)')//setting_type 别名st 关联字段为 setting_type_id
                ->order('sort_number')//排序字段
                ->relation(true)//开启关联查询
                ->select(); //查询所有

            //2，整理成分组格式
            /*[
                   'group_id'=>[当前组内的所有配置项]
               ]*/
            foreach ($settingList as $setting) {
                //$setting是一行数据存储到他所属的分组id里 得到一个二位数组$settingGroupList
                $settingGroupList[$setting['setting_group_id']][] = $setting;
            }
            // 生成缓存
            S('settingGroupList', $settingGroupList);
        }
        $this->assign('settingGroupList',$settingGroupList);
        $this->display();
    }



    /**
     * 更新配置项
     */
    public function updateAction()
    {
        //获取所有配置项的修改值  默认空数组
        $settingList = I('post.setting', []);

        $model = M('Setting'); //获取配置列表模型
        // 找到所有的配置项ID  getField（）获取字段值  第二个参数为true 返回所有满足条件的数组
        $allSettingList = $model->getField('setting_id', true);
        //遍历所有的提交修改的的配置项
        foreach ($allSettingList as $setting_id) {
            // 判断当前setting_id是否出现在从post获取的配置项列表中
            // 存在, 有更新数据, 使用更新数据, 不存在使用''空字符串 （多选中如果不选则不提交表单）
            $value = isset($settingList[$setting_id]) ? $settingList[$setting_id] : '';
            //使用模型完成更新
            // 使用模型完成更新
            $model->save([
                'setting_id' => $setting_id,
                // 判断是否多选的数组, 如果是数组, 则使用逗号连接成字符串
                'value' => is_array($value) ? implode(',', $value) : $value,
            ]);


            // 删除缓存
            S(['type'=>'File']);// 初始化文件缓存
            S('groupList', null);
            S('settingGroupList', null);


            // 重定向到set页面
            $this->redirect('set');
        }

    }

    /**
     * ajax单项更新
     */
    public function ajaxAction(){
        // 处理 id和值
        $data['setting_id'] = I('request.setting_id');
        //获取选项值
        $value = I('request.value');
        //判断多选框内是否是（数组）多选 是数组以逗号合并成字符串
        $data['value'] = is_array($value) ? implode(',', $value) : $value;
        //获取模型
        $model = M('Setting');


        // 删除缓存
        S(['type'=>'File']);// 文件缓存
        S('groupList', null);
        S('settingGroupList', null);

        //更新并判断是否更新成功
        if ($model->save($data)) {
            $this->ajaxReturn(['error'=>0]);
        } else {
            $this->ajaxReturn(['error'=>1, 'errorInfo'=>$model->getError()]);
        }
    }
}