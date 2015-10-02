<?php

class BranchGoodItems extends Eloquent {

    protected $table = 'branch_good_items';

    public function good()
    {
        return $this->belongsTo('Good');
    }

}