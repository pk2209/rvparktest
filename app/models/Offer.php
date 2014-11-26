<?php

class Offer extends BaseModel {
	protected $guarded = array();
    public $primaryKey = 'id';
    public $table = 'petpaws.Offers';

	public static $rules = array();

    public function type(){
        return $this->hasOne('OfferType', 'id', 'OfferTypeID');
    }

    public function provider(){
        return $this->belongsTo('Provider', 'ProviderID', 'ID');
    }

    public function purchases(){
        return $this->hasMany('Purchase');
    }
}
