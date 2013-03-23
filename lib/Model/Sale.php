<?php
class Model_Sale extends Model_Table{
	var $table ="xsales";
	function init(){
		parent::init();
		$this->hasOne('Plot','plot_id')->mandatory("This is a Mandatory Field");
		$this->hasOne('Customer','customer_id')->mandatory("This is a Mandatory Field");
		$this->addField('RatePerSqUnit')->mandatory("This is a Mandatory Field");
		$this->addField('salespolicy_name')->mandatory("This Field is Required");
		$this->addField('down_payment')->mandatory("This Field is Required");
		$this->addField('emi_pattern')->type('text')->mandatory("This Field is Required");
		$this->addField('master_emi')->mandatory("This Field is Required");
		$this->addField('master_emi_mode')->enum(array('Half-Yearly',"Yearly"))->mandatory("This Field is Required");
		$this->addField('direct_commission_to_agent')->mandatory("This Field is Required");
		$this->addField('emi_commission_to_agent')->mandatory("This Field is Required");


		$this->hasMany('Emi','sales_id');
	}
}