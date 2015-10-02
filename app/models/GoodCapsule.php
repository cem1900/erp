<?php

class GoodCapsule extends Eloquent {

    protected $table = 'good_capsule';

    public function good()
    {
        return $this->belongsTo('Good');
    }


}