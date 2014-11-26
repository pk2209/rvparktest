<?php

class SubscriptionLevel extends BaseModel {
	protected $guarded = array();
    public $primaryKey = 'ID';
    public $table = 'petpaws.SubscriptionLevels';

	public static $rules = array();
}
