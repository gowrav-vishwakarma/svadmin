<?php
class Model_Emi extends Model_Table{
	var $table="xemis";
	function init(){
		parent::init();
		$this->hasOne('Sale','sales_id');
		$this->addField('due_date')->type('date');
		$this->addField('paid_date')->type('date');
		$this->addField('EMIAmount')->mandatory("This is a Mandatory Field");
		$this->addField('AmountPaid')->mandatory("This is a Mandatory Field")->defaultValue(0);
	}

	function pay($amount){
		if($amount == 0) return;
		if($this['AmountPaid'] + $amount > $this['EMIAmount']) throw $this->exception('Cannot Pay More then required for an EMI');
		$this['AmountPaid'] = $this['AmountPaid'] + $amount;
		$this['paid_date']=date('Y-m-d H:i:s');
		$this->save();

		if($this['AmountPaid'] == )
	}
}