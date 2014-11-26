<?php

class ProviderLead extends BaseModel {
	protected $guarded = array();
    public $primaryKey = 'ID';
    public $table = 'petpaws.ProviderLeads';

	public static $rules = array();
}
