<?php
class Model_Emi extends Model_Table{
	var $table="xemis";
	
	function init(){
		parent::init();
		$this->hasOne('Sale','sales_id');
		$this->addField('due_date')->type('date');
		$this->addField('paid_date')->type('date');
		$this->addField('is_master_emi')->type('boolean');
		$this->addField('EMIAmount')->mandatory("This is a Mandatory Field");
		$this->addField('AmountPaid')->mandatory("This is a Mandatory Field")->defaultValue(0);
	}

	function pay($amount,$date=null){
		if($amount == 0) return;

		if($date==null) $date=date('Y-m-d');

		if($this['AmountPaid'] + $amount > $this['EMIAmount']) throw $this->exception('Cannot Pay More then required for an EMI');
		
		$this['AmountPaid'] = $this['AmountPaid'] + $amount;
		$this['paid_date']=$date;
		$this->save();

		if($this['AmountPaid'] == $this['EMIAmount'] and $this->ref('sales_id')->ref('plot_id')->get('status') == 'EMISold'){
			// EMI is complete and if this belongs to EMI Sold then distribute the commission in tree 
			$customer = $this->ref('sales_id')->ref('customer_id');
			$distributor = $customer->ref('Distributor')->tryLoadAny();
			if(!$distributor->loaded()) throw $this->exception('There is some concurrency in this plot sold. Status is EMI sold while no distributor is available for this plot');
			$i=0;
			$distribute_array=explode(",",DISTRIBUTE);
			while($distributor['sponsor_id'] !=0 AND $i <= 5){
				$sponsor=$distributor->ref('sponsor_id');
				$sponsor[$distributor['inLeg'].'_Commission'] = $sponsor[$distributor['inLeg'].'_Commission'] + $distribute_array[$i];
				$sponsor->save();
				$distributor = $sponsor;
				$i++;
			}
		}
	}
}