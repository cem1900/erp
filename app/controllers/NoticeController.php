<?php

// 通知类
//
class NoticeController extends BaseController {

    // 首页
    //
    public function getIndex()
    {
        $notice = Notice::where('user_id', Auth::user()->id)->orderBy('timeline', 'desc')->paginate();

        $count  = Notice::where('user_id', Auth::user()->id)->count();

        return View::make('notice')->with('notice', $notice)->with(compact('count'));
    }

    // 提醒阅读
    //
    public function getRead($NoticeId)
    {
        $notice       = Notice::find($NoticeId);
        $notice->read = '1';
        $notice->save();

        // 转跳到不同地址
        //
        switch ($notice->type)
        {
            case '1':
                break;
            case '2':
                break;
            case '3':
                break;
            case '4':
                break;
            case '5':
                $data = json_decode($notice->data);

                return Redirect::to('picking/view/' . $data->delivery_id)->with('warning', $notice->content);
                break;
        }

        return Redirect::to('notice');
    }
}
