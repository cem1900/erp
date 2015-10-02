<?php

class DeliveryItems extends Eloquent {

    protected $table = 'delivery_items';

    // public $timestamps = FALSE;

    public function good()
    {
        return $this->belongsTo('Good');
    }

    public function warehouse()
    {
        return $this->belongsTo('Warehouse');
    }

}
