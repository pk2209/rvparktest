<?php

class DomainMember extends BaseModel {
	protected $guarded = array();
    public $primaryKey = 'ID';
    public $table = 'petpaws.DomainMembers';

	public static $rules = array();
}
