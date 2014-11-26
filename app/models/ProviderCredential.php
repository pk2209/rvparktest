<?php

class ProviderCredential extends Cartalyst\Sentry\Users\Eloquent\User {
	protected $guarded = array();
    public $primaryKey = 'ID';
    public $table = 'petpaws.ProviderCredentials';

	public static $rules = array();

    public function groups(){
        return $this->belongsToMany(static::$groupModel, static::$userGroupsPivot, 'user_id');
    }

    public function providers(){
        return $this->hasMany('Provider','PCID');
    }
}
