<?php

class Model_Distributor extends Model_Table {
	var $table= "xdistributors";
	function init(){
		parent::init();

		$this->hasOne('Customer','customer_id');
		$this->hasOne('Distributor','sponsor_distributor_id');
		$this->hasOne('Distributor','introducer_distributor_id');

		$this->hasMany('DistributorA','legA_id');
		$this->hasMany('DistributorB','legB_id');
		$this->hasMany('DistributorC','legC_id');
		$this->hasMany('DistributorD','legD_id');

	}
}