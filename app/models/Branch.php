<?php

class Branch extends Eloquent {

    protected $table = 'branch';

    public static $rules = array(
        'name'    => 'required|min:2|unique:branch',
        'contact' => 'required|min:2',
        'mobile'  => 'required|min:2',
        // 'address' => 'required|min:5',
        'stock'   => 'integer',
        // 'code'    => 'required|unique:branch'
    );

    // 区域
    //
    public function area()
    {
        return $this->belongsTo('Area');
    }

    // 线路
    //
    public function line()
    {
        return $this->belongsTo('Line');
    }

    // 客户类型
    //
    public function type()
    {
        return $this->belongsTo('Type');
    }

    // 客户
    //
    public function user()
    {
        return $this->belongsTo('User');
    }

}
