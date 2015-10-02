<?php

class Line extends Eloquent
{
    protected $table = 'line';

    public static $rules = array(
        'name' => 'required|min:2|unique:line',
        'code' => 'required|unique:line'
    );

}