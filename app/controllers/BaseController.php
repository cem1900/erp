<?php

// 基础类
//
class BaseController extends Controller {

    // 不检查权限控制器方法
    //
    protected $whitelist = array();

    // 构造方法
    //
    public function __construct()
    {
        // $this->beforeFilter(function(){
        // 	// View::share('catnav', Category::all());
        // });

        // 检查权限
        //
        $this->beforeFilter('auth', array('except' => $this->whitelist));

        // 信息过滤
        //
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (!is_null($this->layout))
        {
            $this->layout = View::make($this->layout);
        }
    }

    /**
     *  生成时间
     *
     * @param string $format
     *
     * @return string
     */
    protected function __time($time = 'now', $format = 'Y-m-d H:i:s')
    {
        $dateTime = new DateTime($time);

        return $dateTime->format($format);
    }

    /**
     * 产生随机数
     *
     * @param        $length
     * @param int    $type
     * @param string $hash
     *
     * @return string
     */
    protected function random($length, $type = 0, $hash = '')
    {
        if ($type == 0)
        {
            $chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        }
        else if ($type == 1)
        {
            $chars = '0123456789';
        }
        else if ($type == 2)
        {
            $chars = 'abcdefghijklmnopqrstuvwxyz';
        }
        $max = strlen($chars) - 1;
        mt_srand(( double )microtime() * 1000000);
        for ($i = 0; $i < $length; $i++)
        {
            $hash .= $chars [mt_rand(0, $max)];
        }

        return $hash;
    }

    /**
     * 价格格式化
     *
     * @param $price
     *
     * @return float
     */
    protected function __price($price)
    {
        return round((float)$price, 2);
    }

    /**
     * 商品日志
     *
     * @param $good_id
     * @param $product_id
     * @param $status
     */
    protected  function __goodLog($good_id, $product_id, $status){

        $good_log             = new GoodLog();
        $good_log->good_id    = $good_id;
        $good_log->product_id = $product_id;
        $good_log->user_id    = Auth::user()->id;
        $good_log->user_name  = Auth::user()->username;
        $good_log->alttime    = $this->__time();
        $good_log->status     = $status;

        $good_log->save();
    }

}
