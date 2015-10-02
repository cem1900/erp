<?php

class GoodEmpty extends Eloquent {

    protected $table = 'good_empty';

    public function good()
    {
        return $this->belongsTo('Good');
    }


}