<?php
class Model_Agent extends Model_Table{
	var $table="xagent";
	function init(){
		parent::init();
		$this->addField('name')->mandatory("This is a required field");
		$this->addField('mo_number')->mandatory("This is a required field");
		$this->addField('address')->mandatory("This is a required field");

		$this->hasMany('Sale','agent_id');
		$this->hasMany('AgentCommission','agent_id');
		$this->addHook('beforeDelete',$this);
	}

	function beforeDelete(){
		if($this->ref('Sale')->count()->getOne()>0)
			throw $this->exception("You can not Delete this Agent, It contains Sale");
			
	}

	function payCommission($sales, $amount_deposited, $amount, $type='emi'){
		if($type=='emi') 
			$this->payEmiCommission($sales, $amount_deposited, $amount);
		else
			$this->payDownPaymentCommission($sales, $amount_deposited, $amount);

	}

	function payDownPaymentCommission($sales, $amount_deposited_m, $amount){
		$amount_for_this_amount = $sales['direct_commission_to_agent'];
		if(strpos("%", $amount_for_this_amount)!==false){
			$amount_percentage = trim($sales['direct_commission_to_agent'],"%");
		}else{
			$amount_percentage = $sales['direct_commission_to_agent'] / $sales['down_payment'] * 100;
		}

		$agent_commission = $this->add('Model_AgentCommission');
		$agent_commission['commission'] = $amount * $amount_percentage / 100;
		$agent_commission['agent_id'] = $this->id;
		$agent_commission['amount_deposited_id'] = $amount_deposited_m->id;
		$agent_commission->save();

	}

	function payEmiCommission($sales, $amount_deposited, $amount){

	}

}