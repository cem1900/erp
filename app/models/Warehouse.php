<?php

class Warehouse extends Eloquent {
    protected $table = 'warehouse';

    public static $rules = array(
        'name'    => 'required|min:2|unique:warehouse',
        'user_id' => 'unique:warehouse',
    );

    public function user()
    {
        return $this->belongsTo('User');
    }

    public static function getUserWarehouseId($UserId)
    {
        $WarehouseId = self::where('user_id', $UserId)->first();

        return $WarehouseId->id;
    }

}