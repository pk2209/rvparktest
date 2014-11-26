<?php

class RedeemedOffer extends BaseModel {
	protected $guarded = array();
    public $primaryKey = 'id';
    public $table = 'petpaws.RedeemedOffers';

	public static $rules = array();
}
