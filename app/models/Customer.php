<?php

class Customer extends BaseModel {
	protected $guarded = array();
    protected $table = 'petpaws.Customers';
    protected $primaryKey = 'ID';

	public static $rules = array();

    public function pets(){
        return $this->hasMany('CustomerPet', 'CustomerID', 'ID');
    }
}
