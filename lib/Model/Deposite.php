<?php
class Model_Deposite extends Model_Table{
	var $table="xamount_deposite";

	function init(){
		parent::init();
		$this->hasOne('Sale','sales_id');
		$this->addField('amount')->mandatory("This is a Required Field");
		$this->addField('paid_date')->mandatory("This is a Required Field");

	}
}