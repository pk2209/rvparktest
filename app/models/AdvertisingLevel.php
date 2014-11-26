<?php

class AdvertisingLevel extends BaseModel {
	protected $guarded = array();
    public $primaryKey = 'ID';
    public $table = 'petpaws.AdvertisingLevels';

	public static $rules = array();
}
