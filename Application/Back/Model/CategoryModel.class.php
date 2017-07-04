<?php

namespace Back\Model;

use Think\Model;


class CategoryModel extends Model
{
    protected  $patchValidate = true; //开启批量验证
    //设置验证规则和验证时机 存在时验证  更新时验证
    protected $_validate = [
        ['parent_id', 'nonChild', '不能设置后代分类为上级分类', self::EXISTS_VALIDATE, 'callback', self::MODEL_UPDATE],
    ];


    /**
     * @param $parent_id 所选的新的上级分类ID
     * @return bool
     */
    protected function nonChild($parent_id)
    {
        
        // 如果选择的是顶级分类, 不存在自分类的判断问题
        if ($parent_id == 0) {
            return true;
        }
        
        // 获取当前正在编辑的分类ID
        $category_id = I('post.category_id');

        // 判断所选的上级分类与当前分类ID是否相等
        if ($parent_id == $category_id) {
            return false;
        }

        // 所选的上级分类向上找-递归
        return $this->checkParents($parent_id, $category_id);
    }

    protected function checkParents($parent_id, $category_id)
    {
        // 判断是否查找到顶级级分类
        if ($parent_id == 0) {
            return true;
        }
        // 利用parent_id找上级parent_id
        $parent_id = $this->where(['category_id'=>$parent_id])->getField('parent_id');
        // 发现相等, 验证失败
        if($parent_id == $category_id) {
            return false;
        } else {
            // 否则继续向上查找
            return $this->checkParents($parent_id, $category_id);
        }

    }
    public function getTreeList()
    {
        // 初始缓存配置
        S([
            'type' => 'Memcache',
            'host'  => '192.168.118.128',
            'port'  => '11211',
        ]);


        //G('start'); //获取这段代码执行时间
        if(! $tree = S('category_tree')) {
            // 缓存不存在
            // 获取所有的分类
            $list = $this->order('sort_number')->select();
            // 递归处理
            $tree = $this->tree($list);

            // 增加设置缓存
            S('category_tree', $tree);// 默认永久有效 
        }
       // echo G('start', 'end'), 's';

        return $tree;
    }

    protected function tree($list, $category_id=0, $level=0)
    {
        static $tree = [];//设置静态变量保存遍历出来的所有分类
        foreach($list as $row) {
            if ($row['parent_id'] == $category_id) {  //如果父级id等于0
                $row['level'] = $level; //赋值的等级
                $tree[] = $row;//保存到数组
                $this->tree($list, $row['category_id'], $level+1); //等级+1调用本身
            }
        }
        return $tree; //得到分配的能级后的数组
    }
}