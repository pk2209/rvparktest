<?php

class Provider extends BaseModel {
	protected $guarded = array();
    public $primaryKey = 'ID';
    public $table = 'petpaws.Providers';

	public static $rules = array();

    public function services(){
        return $this->belongsToMany('Service', 'ProviderServices', 'ProviderID', 'ServiceID');
    }

    public function subscriptionLevel(){
        return $this->hasOne('SubscriptionLevel', 'ID', 'SubID')->first();
    }

    public function offer(){
        return $this->hasMany('Offer', 'ID', 'OfferID');
    }
}
