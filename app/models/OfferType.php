<?php

class OfferType extends BaseModel {
	protected $guarded = array();
    public $primaryKey = 'id';
    public $table = 'petpaws.OfferTypes';

	public static $rules = array();
}
