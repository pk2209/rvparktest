<?php

class Purchase extends \Eloquent {
	protected $guarded = array();
    protected $table = 'petpaws.Purchases';
    protected $primaryKey = 'ID';
}
