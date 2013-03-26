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
		$this->addField('down_payment_submitted')->mandatory("This Field is Required");
		$this->hasMany('Emi','sales_id');
		$this->hasMany('Deposite','sales_id');

		$this->addHook('beforeSave',$this);

	}

	function beforeSave(){
		$this->validate();
	}

	function validate(){
		
		$calculated_cost=$this['down_payment'];

		foreach(explode(';', $this['emi_pattern']) as $pattern){
			$tmp=explode("x", $pattern);
				$calculated_cost += ($tmp[0]*$tmp[1]); 
		}

		if($this['total_cost'] != $calculated_cost)
			throw $this->exception("Total Cost is not Equal to calculated emi pattern ".$calculated_cost);
	}

	function create_emis($emistartdate){
		switch($this['emi_mode']){
			case "Yearly":
				$toAdd = " +1 year";
				$YearlyMasterEmiAfterEntries = 1; 
				break;
			case "Half-Yearly":
				$toAdd = " +6 month";
				$YearlyMasterEmiAfterEntries = 2; 
				break;
			case "Quarterly":
				$toAdd = " +3 month";
				$YearlyMasterEmiAfterEntries = 4; 
				break;
			default:
			case "Monthly":
				$toAdd = " +1 month";
				$YearlyMasterEmiAfterEntries = 12; 
				break;
			case "Fortnightly":
				$toAdd = " +15 day";
				$YearlyMasterEmiAfterEntries = 24; 
				break;
		}

		if($this['master_emi_mode'] == 'Half-Yearly'){
			$YearlyMasterEmiAfterEntries = $YearlyMasterEmiAfterEntries / 2;
			if($this['emi_mode'] == "Yearly")
				throw $this->exception("This is not possible to submit Master Emi every half-year while emis are set Yearly");
		}

		$today=$emistartdate;
		$nextDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($today)) . $toAdd));
		foreach(explode(';', $this['emi_pattern']) as $pattern){
			$tmp=explode('x', $pattern);
			for($i=1;$i<=$tmp[1];$i++){

				$emi=$this->add('Model_Emi');
				$emi['due_date']= $nextDate;
				$emi['paid_date']=null;
				$emi['EMIAmount']=$tmp[0];
				$emi['AmountPaid']=0;
				$emi['sales_id']=$this->id;
				$emi->save();

				if($i % $YearlyMasterEmiAfterEntries == 0) {
					$emi=$this->add('Model_Emi');
					$emi['due_date']= $nextDate;
					$emi['paid_date']=null;
					$emi['EMIAmount']=$this['master_emi'];
					$emi['AmountPaid']=0;
					$emi['sales_id']=$this->id;
					$emi['is_master']=true;
					$emi->save();					
				}

				$today = $nextDate;
				$nextDate = $nextDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($today)) . $toAdd));
			}
		}	
	}

	function depositAmount($AmountPaid){

		// throw new Exception("Error Processing Request");

		if(($this['down_payment'] - $this['down_payment_submitted']) > $AmountPaid){
			$amount_for_downpayment = $AmountPaid; 
			$amount_for_emi=0;
		}else{
			$amount_for_downpayment = $this['down_payment'] - $this['down_payment_submitted'];
			$amount_for_emi = $AmountPaid - $amount_for_downpayment;
		}

		$this['down_payment_submitted'] = $this['down_payment_submitted'] + $amount_for_downpayment;
		$this->save();

		if($amount_for_emi == 0 ) return;

		foreach ($emi=$this->ref('Emi') as $junk) {
			if(($emi['EMIAmount']-$emi['AmountPaid']) > $amount_for_emi ){
				$amount_for_this_emi = $amount_for_emi;
			}else{
				$amount_for_this_emi = $emi['EMIAmount']-$emi['AmountPaid'];
			}

			$emi->pay($amount_for_this_emi);

			$amount_for_emi = $amount_for_emi - $amount_for_this_emi;
			if($amount_for_emi == 0) break;
		}

	}
}