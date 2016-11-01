<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Friendlinks;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FriendLinksController extends Controller
{
    //加载友情链接添加页面
    public function toFriendLinksAdd()
    {
        return view('admin.friendLinksAdd');
    }

    //加载友情链接修改页面
    public function toFriendLinksList()
    {
        $friendLinks=Friendlinks::orderBy('order')->get();
        return view('admin.friendLinksList')->with('friendLinks',$friendLinks);
    }

    //加载友情链接修改页面
    public function toFriendLinksEdit(Request $request,$id)
    {
        $friendLinks=Friendlinks::where('id',$id)->first();

        return view('admin.friendLinksEdit')->with('friendLinks',$friendLinks);
    }
}
