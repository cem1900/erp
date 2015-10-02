<?php

// 员工类
//
class UsersController extends BaseController {

    // 不检查权限方法
    //
    protected $whitelist = array(
        'getSignin',
        'postSignin'
    );

    // 构造方法
    //
    public function __construct()
    {
        parent::__construct();
    }

    // 员工列表
    //
    public function getIndex()
    {
        return View::make('users.index')->with('users', User::all())->with('count', User::count());
    }

    // 添加新员工
    //
    public function getNewaccount()
    {
        return View::make('users.newaccount');
    }

    // 添加员工处理
    //
    public function postCreate()
    {

        $validator = Validator::make(Input::all(), User::$rules);

        if ($validator->fails())
        {
            return Redirect::to('users/newaccount')
                ->withErrors($validator)
                ->withInput();
        }

        $user           = new User;
        $user->username = Input::get('username');
        $user->password = Hash::make(Input::get('password'));
        $user->mobile   = Input::get('mobile');
        $user->grade    = Input::get('grade');
        $user->disable  = '0';
        $user->save();

        return Redirect::to('users')->with('success', '员工添加成功！');
    }

    // 员工编辑
    //
    public function getEdit($UserId)
    {
        return View::make('users.edit')->with('user', User::find($UserId));
    }

    // 员工编辑处理
    //
    public function postEdit($UserId)
    {
        User::$rules['username'] = 'required|min:2|alpha|unique:users,username,' . $UserId;

        if (Input::get('password') == '')
        {
            User::$rules['password'] = '';
        }

        $validator = Validator::make(Input::all(), User::$rules);

        if ($validator->fails())
        {
            return Redirect::to('users/edit/' . $UserId)
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find($UserId);

        if (Input::get('password') !== '')
        {
            $user->password = Hash::make(Input::get('password'));
        }

        $user->username = Input::get('username');
        $user->mobile   = Input::get('mobile');
        $user->grade    = Input::get('grade');
        $user->save();

        return Redirect::to('users')->with('success', Input::get('username') . '资料修改成功！');
    }

    // 修改个人资料
    //
    public function getChange()
    {
        return View::make('users.change')->with('user', User::find(Auth::user()->id));
    }

    // 修改个人资料处理
    //
    public function postChange()
    {
        User::$rules['username'] = '';

        if (Input::get('password') == '')
        {
            User::$rules['password'] = '';
        }

        $validator = Validator::make(Input::all(), User::$rules);

        if ($validator->fails())
        {
            return Redirect::to('users/change')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find(Auth::user()->id);

        if (Input::get('password') !== '')
        {
            $user->password = Hash::make(Input::get('password'));
        }

        $user->mobile = Input::get('mobile');
        $user->save();

        // 修改密码退出，重新登录
        //
        if (Input::get('password') !== '')
        {
            Auth::logout();

            return Redirect::to('users/signin')->with('success', '密码修改成功、请重新登录！');
        }

        return Redirect::to('/')->with('success', '资料修改成功！');
    }

    // 员工登录
    //
    public function getSignin()
    {
        return View::make('users.signin');
    }

    // 登录处理
    //
    public function postSignin()
    {
        // 登录验证
        //
        if (Auth::attempt(array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        ))
        )
        {

            // 登录时间
            //
            $dateTime = $this->__time();

            DB::table('users')
                ->where('id', Auth::user()->id)
                ->update(array('last_signin_at' => $dateTime));

            return Redirect::to('/')->with('success', '欢迎使用商品管理系统！');
        }

        return Redirect::to('users/signin')->with('error', '你的用户名或者密码错误， 请确认！');
    }

    // 员工退出
    //
    public function getSignout()
    {
        Auth::logout();

        return Redirect::to('users/signin')->with('success', '退出成功');
    }
}
