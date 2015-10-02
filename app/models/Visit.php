<?php

class Visit extends Eloquent {

    protected $table = 'visit';

    public $timestamps = FALSE;

    public static $rules = array('comment' => 'required|min:2');

    public function branch()
    {
        return $this->belongsTo('Branch');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }
}