<?php
class Model_ChequeDetails extends Model_Table{
	var $table="xcheque_details";
	function init(){
		parent::init();

		$this->hasOne('Sale','sales_id');
		$this->addField('Cheque_No')->mandatory("This is a Required Field");
		$this->addField('For_Master_Emi')->type('boolean');
		$this->addField('Amount')->mandatory("This is a Required Field");
		$this->addField('Cleared_On')->defaultValue(null)->type('date');
		$this->addField('Bounced_On')->defaultValue(null)->type('date');
		$this->addField('Bank')->mandatory("This is a Required Field");
		$this->addField('Cheque_Date')->defaultValue(date('Y-m-d'))->type('date');
		$this->addField('Created_at')->defaultValue(date('Y-m-d'))->type('date');

	}
	

}