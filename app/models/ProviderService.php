<?php

class ProviderService extends BaseModel {
	protected $guarded = array();
    public $primaryKey = 'ID';
    public $table = 'petpaws.ProviderServices';

	public static $rules = array();
}
