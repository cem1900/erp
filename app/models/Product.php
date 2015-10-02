<?php

class Product extends Eloquent {

    protected $table = 'products';

    // 区域
    //
    public function good()
    {
        return $this->belongsTo('Good');
    }

    public function warehouse()
    {
        return $this->belongsTo('Warehouse');
    }

}
