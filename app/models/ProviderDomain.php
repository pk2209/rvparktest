<?php

class ProviderDomain extends BaseModel {
	protected $guarded = array();
    public $primaryKey = 'ID';
    public $table = 'petpaws.ProviderDomains';

	public static $rules = array();
}
