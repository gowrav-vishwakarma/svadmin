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
		$this->addField('total_cost')->mandatory("This Field is Required");
		$this->addField('emi_pattern')->type('text')->mandatory("This Field is Required");
		$this->addField('emi_mode')->mandatory("This Field is Required");
		$this->addField('master_emi')->mandatory("This Field is Required");
		$this->addField('master_emi_mode')->enum(array('Half-Yearly',"Yearly"))->mandatory("This Field is Required");
		$this->addField('direct_commission_to_agent')->mandatory("This Field is Required");
		$this->addField('emi_commission_to_agent')->mandatory("This Field is Required");
		$this->hasMany('Emi','sales_id');

		$this->addHook('beforeSave',$this);

	}

	function beforeSave(){
		$this->validate();
	}

	function validate(){
		
		$calculated_cost=$this['down_payment'];

		foreach(explode(';', $this['emi_pattern']) as $pattern){
				// echo"<pre>";
				// print_r($pattern);
				// echo "</pre>";
			$tmp=explode("x", $pattern);
				$calculated_cost += ($tmp[0]*$tmp[1]); 
		}

		if($this['total_cost'] != $calculated_cost)
			throw $this->exception("Total Cost is not Equal to calculated emi pattern".$calculated_cost);
	}

	function create_emis(){

		foreach(explode(';', $this['emi_pattern']) as $pattern){
			$tmp=explode('x', $pattern);
			for($i=1;$i<=$tmp[1];$i++){
				$emi=$this->add('Model_EMI');

				$emi['due_date']=
				$emi['paid_date']=null;
				$emi['EMIAmount']=$tmp[0];
				$emi['AmountPaid']=0;

				$emi->save();
			}
		}	
	}
}