<?php

class Allocation extends Eloquent {

    protected $table = 'allocation';

    // 货品
    //
    public function good()
    {
        return $this->belongsTo('Good');
    }

    // 新批次
    //
    public function toProduct()
    {
        return $this->belongsTo('Product', 'to_product_id');
    }

    // 原始批次
    //
    public function fromProduct()
    {
        return $this->belongsTo('Product', 'from_product_id');
    }

    // 新仓
    //
    public function toWarehouse()
    {
        return $this->belongsTo('Warehouse', 'to_warehouse_id');
    }

    // 原始仓
    //
    public function fromWarehouse()
    {
        return $this->belongsTo('Warehouse', 'from_warehouse_id');
    }

}
