<?php

class Model_Customer extends Model_Table {
	var $table= "xcustomer";
	function init(){
		parent::init();

		$this->addField('name');
		$this->addField('Address');
		$this->addField('City');

		$this->hasMany('Distributor','customer_id');
		$this->hasMany('Sale','customer_id',null,'Purchases');
	}
}