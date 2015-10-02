<?php

class Good extends Eloquent {

    protected $table = 'goods';

    public static $rules = array(
        'name'            => 'required|min:2|unique:goods',
        'barcode'         => 'min:2|unique:goods',
        'store'           => 'required|integer',
        'cost'            => 'required|numeric',
        'price'           => 'required|numeric',
        'production_date' => 'required|date',
        'life'            => 'required|integer',
        'unit'            => 'required|integer',
    );


}