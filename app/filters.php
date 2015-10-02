<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function ($request)
{
    //
});


App::after(function ($request, $response)
{
    //
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function ()
{
    if (Auth::guest()) return Redirect::guest('users/signin');
});


Route::filter('auth.basic', function ()
{
    return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function ()
{
    if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function ()
{
    if (Session::token() != Input::get('_token'))
    {
        throw new Illuminate\Session\TokenMismatchException;
    }
});

// 单位数字换算
//
function h_unit($num, $unix = '12')
{
    $p = $num % $unix;
    $x = floor($num / $unix);
    $s = '';

    if ($x)
    {
        $s .= $x . '箱';
    }

    if ($p)
    {
        $s .= $p . '瓶';
    }

    if($s == ''){
        $s = '0箱';
    }

    return $s;
}

// 显示某一个时间相当于当前时间在多少秒前，多少分钟前，多少小时前
//
function time_format($time)
{
    $d = time() - strtotime($time);

    if ($d < 0)
    {
        return '';
    }
    else
    {
        if ($d < 60)
        {
            return $d . '秒前';
        }
        else
        {
            if ($d < 3600)
            {
                return floor($d / 60) . '分钟前';
            }
            else
            {
                if ($d < 86400)
                {
                    return floor($d / 3600) . '小时前';
                }
                else
                {
                    if ($d < 259200)
                    { //3天内
                        return floor($d / 86400) . '天前';
                    }
                    else
                    {
                        return $time;
                    }
                }
            }
        }
    }
}
