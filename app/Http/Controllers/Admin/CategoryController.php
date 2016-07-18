<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entity\Category;
use App\Models\Data;

class CategoryController extends Controller
{
    
	//后台分类添加页面加载方法
	public function toCategoryAdd()
	{
		$categorys=Category::orderBy('order')->get();
		$data=new Data;
		$data=$data->tree($categorys,'name','id');
		return view('admin.categoryAdd')->with('categorys',$data);
	}

	//后台分类列表页加载方法
	public function toCategoryList()
	{
		$categorys=Category::orderBy('order')->get();
		$data=new Data;
		$data=$data->tree($categorys,'name','id');
		return view('admin.categoryList')->with('categorys',$data);
	}
	
	//后台分类Tab页加载方法
	public function toCategoryTab()
	{
		return view('admin.categoryTab');
	}

	//后台分类修改页面加载方法
	public function toCategoryEdit(Request $request,$id)
	{
		$sids=Category::where('pid',$id)->lists('id');
		$ids=[];
		foreach($sids as $k=>$v){
			$ids[]=$v;
		}
		$ids[]=$id;
		$categorys=Category::orderBy('order')->get();
		foreach($categorys as $k=>$v){
			if(in_array($v->id,$ids)){
				$v->_disabled='disabled';
			}else{
				$v->_disabled='';
			}

		}

		$category=Category::where('id',$id)->first();

		$data=new Data;
		$data=$data->tree($categorys,'name','id');
		return view('admin.categoryEdit')->with('category',$category)
			                             ->with('categorys',$data);
	}
}