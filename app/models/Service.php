<?php

class Service extends BaseModel {
	protected $guarded = array();
    public $primaryKey = 'ID';
    public $table = 'petpaws.Services';

	public static $rules = array();
}
