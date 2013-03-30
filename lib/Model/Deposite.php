<?php
class Model_Deposite extends Model_Table{
	var $table="xamount_deposited";

	function init(){
		parent::init();
		$this->hasOne('Sale','sales_id');
		$this->addField('Amount')->mandatory("This is a Required Field");
		$this->addField('paid_date')->mandatory("This is a Required Field");

		$this->hasMany('AgentCommission','amount_deposite_id');
	}
}