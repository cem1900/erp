<?php

// 首页
//
class HomeController extends BaseController {

    // 站点首页
    //
    public function getIndex()
    {
        if (Auth::user()->grade == 1)
        {
            $branch = Branch::take(10)->get();
        }
        else
        {
            $branch = Branch::where('user_id', Auth::user()->id)->take(10)->get();
        }

        // 提醒
        //
        $notice = Notice::where('user_id', Auth::user()->id)->where('read', '0')->orderBy('timeline', 'desc')->take(10)->get();

        return View::make('index')->with('goods', Good::orderBy('store')->take(10)->get())->with('branch', $branch)->with('notice', $notice);
    }
}
