<?php

class ZipService extends \Eloquent {
	protected $guarded = array();

    protected $table = 'petpaws.ZipServiced';
    protected $primaryKey = 'ProviderID';
    public $timestamps = false;
}
