<?php

//生成后台字段链接的函数
// 路由，排序，字段，当前搜索字段
function UField($route,$sort,$field,$filter=[])
{
	$params = [];
	
	//是当前字段  field字段 params参数
	$params['sort_field'] = $field;
	//不是当前排序字段，生成当前字段的升序排序URL即可
	if ($sort['field'] != $field){
		$params['sort_type'] ='asc';
	}else{
		//判断新的排序方式，原来时asc则生成desc  strtolower()把字符串转换成小写
		if(strtolower($sort['type']=='asc')){
			$params['sort_type'] = 'desc';
		}else{
			$params['sort_type'] = 'asc';
		}
	}
	
	//使用U函数生成链接地址，将查询参数与排序参数合并 array_merge()数组合并
	return U($route, array_merge($filter, $params));
}


//生成排序的字段的升降类
function CField($sort,$field){
	if ($sort['field'] == $field){
		return $sort['type'];
	}else{
		return '';
	}
}