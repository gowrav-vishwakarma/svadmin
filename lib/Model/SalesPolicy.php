<?php
class Model_SalesPolicy extends Model_Table{
	var $table="xsales_policies";
	
	function init(){
		parent::init();

		$this->addField('name')->mandatory("This Field is Required");
		$this->addField('down_payment')->mandatory("This Field is Required");
		$this->addField('emi_pattern')->type('text')->mandatory("This Field is Required");
		$this->addField('master_emi')->mandatory("This Field is Required");
		$this->addField('no_of_master_emi')->mandatory("This Field is Required");
		$this->addField('emi_mode')->enum(array("Fortnightly","Monthly","Quarterly","Half-Yearly","Yearly"))->mandatory("This Field is Required");
		$this->addField('master_emi_mode')->enum(array('Half-Yearly',"Yearly"))->mandatory("This Field is Required");
		$this->addField('direct_commission_to_agent')->mandatory("This Field is Required");
		$this->addField('emi_commission_to_agent')->mandatory("This Field is Required");

		$this->hasMany('Plot','salespolicy_id');
	}
}
