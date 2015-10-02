<?php

class Type extends Eloquent {
    protected $table = 'type';

    public static $rules = array(
        'name' => 'required|min:2|unique:type',
        'code' => 'required|unique:type'
    );

}