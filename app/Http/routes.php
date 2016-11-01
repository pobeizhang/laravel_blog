<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

	//前台
	Route::group(['namespace'=>'Home'],function(){
		//加载前台首页
		Route::get('/', 'IndexController@toIndex');
		Route::get('article/{id}','IndexController@toNew');
		Route::get('category/{id}','IndexController@toNewList');
		Route::get('cate_two/{id}','IndexController@toTwoList');
		Route::group(['prefix'=>'home'],function(){
			Route::get('toNewList','IndexController@toNewList');
			Route::get('toNew','IndexController@toNew');

		});
	});




	//后台
    Route::group(['prefix'=>'admin'],function(){
        Route::get('login','Admin\LoginController@toLogin');
		Route::get('loginout','Admin\IndexController@loginout');

		
		Route::group(['prefix'=>'service'],function(){
	        Route::get('validate_code/create','Service\ValidateController@create');
			Route::post('member','Service\MemberController@member');
			Route::post('member/changPass','Service\MemberController@changPass');
			Route::post('cateOrder','Service\CategoryController@cateOrder');
			Route::post('cateAdd','Service\CategoryController@cateAdd');
			Route::post('cateDel','Service\CategoryController@cateDel');
			Route::post('catesDel','Service\CategoryController@catesDel');
			Route::post('cateEdit','Service\CategoryController@cateEdit');
			Route::post('uploadThumb','Service\ArticleController@uploadThumb');
			Route::post('articleAdd','Service\ArticleController@articleAdd');
			Route::post('articleEdit','Service\ArticleController@articleEdit');
			Route::post('articleDel','Service\ArticleController@articleDel');
			Route::post('articlesDel','Service\ArticleController@articlesDel');
			Route::post('friendLinksAdd','Service\FriendLinksController@friendLinksAdd');
			Route::post('friendLinksOrder','Service\FriendLinksController@friendLinksOrder');
			Route::post('friendLinksEdit','Service\FriendLinksController@friendLinksEdit');
			Route::post('friendLinkDel','Service\FriendLinksController@friendLinkDel');
			Route::post('friendLinksDel','Service\FriendLinksController@friendLinksDel');
			Route::post('navsAdd','Service\NavsController@navsAdd');
			Route::post('navsEdit','Service\NavsController@navsEdit');
			Route::post('navDel','Service\NavsController@navDel');
			Route::post('navsDel','Service\NavsController@navsDel');
			Route::post('navsOrder','Service\NavsController@navsOrder');
			Route::post('configAdd','Service\ConfigController@configAdd');
			Route::post('configOrder','Service\ConfigController@configOrder');
			Route::post('configDel','Service\ConfigController@configDel');
			Route::post('configsDel','Service\ConfigController@configsDel');
			Route::post('configEdit','Service\ConfigController@configEdit');
			Route::post('configContentEdit','Service\ConfigController@configContentEdit');
			Route::get('putConfig','Service\ConfigController@putConfig');
	    });
		
		Route::group(['middleware'=>'admin.check.login'],function(){
			Route::get('index','Admin\IndexController@toIndex');
			Route::get('info','Admin\IndexController@toInfo');

			Route::get('pass','Admin\IndexController@toPass');

			Route::get('toCategoryAdd','Admin\CategoryController@toCategoryAdd');
			Route::get('toCategoryList','Admin\CategoryController@toCategoryList');
			Route::get('toCategoryTab','Admin\CategoryController@toCategoryTab');
			Route::get('toCategoryEdit/{id}','Admin\CategoryController@toCategoryEdit');

			Route::get('toArticleAdd','Admin\ArticleController@toArticleAdd');
			Route::get('toArticleList','Admin\ArticleController@toArticleList');
			Route::get('toArticleEdit/{id}','Admin\ArticleController@toArticleEdit');

			Route::get('toFriendLinksAdd','Admin\FriendLinksController@toFriendLinksAdd');
			Route::get('toFriendLinksList','Admin\FriendLinksController@toFriendLinksList');
			Route::get('toFriendLinksEdit/{id}','Admin\FriendLinksController@toFriendLinksEdit');

			Route::get('toNavsAdd','Admin\NavsController@toNavsAdd');
			Route::get('toNavsList','Admin\NavsController@toNavsList');
			Route::get('toNavsEdit/{id}','Admin\NavsController@toNavsEdit');

			Route::get('toConfigAdd','Admin\ConfigController@toConfigAdd');
			Route::get('toConfigList','Admin\ConfigController@toConfigList');
			Route::get('toConfigEdit/{id}','Admin\ConfigController@toConfigEdit');

			Route::group(['prefix'=>'service'],function(){
	        	
	    	});
		});
		
    });
    
