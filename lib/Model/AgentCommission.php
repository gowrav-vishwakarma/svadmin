<?php
class Model_AgentCommission extends Model_Table{
	var $table="xagent_commission";
	function init(){
		parent::init();
		$this->hasOne('Agent','agent_id');
		$this->hasOne('Deposite','amount_deposite_id');
		$this->addfield('commission');

	}
}