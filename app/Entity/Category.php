<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table="category";
	protected $primaryKey="id";
	
	/**
	 * [getTree 数据树状化处理]
	 * @param  array   $data       [要处理的数据集合]
	 * @param  string  $field_name [具有树状结构的数据名称]
	 * @param  string  $field_id   [数据对应的数据表中的主键id字段名称]
	 * @param  string  $field_pid  [数据对应的数据表中的父级id字段名称]
	 * @param  integer $pid_start  [数据对应的数据表中的父级id的起始值]
	 * @return array               [返回的处理好的数据]
	 */
	/*public function getTree($data,$field_name,$field_id='id',$field_pid='pid',$pid_start=0)
	{
		$arr=[];
		foreach($data as $k=>$v){
			if($v[$field_pid] == $pid_start){
				$data[$k]['_'.$field_name]=$data[$k]['name'];
				$arr[]=$v;
				foreach($data as $kk=>$vv){
					if($v[$field_id] == $vv[$field_pid]){
						$data[$kk]['_'.$field_name]='├─'.$data[$kk]['name'];
						$arr[]=$data[$kk];
					}
				}
			}
		}
		return $arr;
	}*/
}
