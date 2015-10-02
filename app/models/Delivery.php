<?php

class Delivery extends Eloquent {

    protected $table = 'delivery';

    public static $rules = array(
        'bn'   => 'required|unique:bn',
    );

    public function items()
    {
        return $this->hasMany('DeliveryItems');
    }

    public function branch()
    {
        return $this->belongsTo('Branch');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function warehouse()
    {
        return $this->belongsTo('Warehouse');
    }


}