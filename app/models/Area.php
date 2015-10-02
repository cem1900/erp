<?php

class Area extends Eloquent
{
    protected $table = 'area';

    public static $rules = array('name' => 'required|min:2|unique:area', 'code' => 'required|unique:area');

}