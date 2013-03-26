<?php

class Model_Plot extends Model_Table {
	var $table='xplots';
	
	function init(){
		parent::init();
		$this->hasOne("Planning",'planning_id',null,'planning');
		$this->hasOne("SalesPolicy",'salespolicy_id')->mandatory('This is a Required field');

		$this->addField('name')->mandatory('Plot Number is must')->caption('Plot Number');
		$this->addField('block_number')->mandatory('Plot Block Number is must');
		$this->addField('width')->mandatory('Width is required')->display(array('grid'=>'grid/inline'));
		$this->addField('height')->mandatory('Height is required')->display(array('grid'=>'grid/inline'));
		$this->addField('SqAreaCost');
		$this->addField('Unit');
		$this->addField('Area');
		$this->addField('is_corner')->type('boolean');
		$this->addField('date')->defaultValue(date('Y-m-d'))->type('date');
		$this->addField('status')->enum(array('Available','DirectSold','EMISold','AvailableReSale'))->defaultValue('Available')->system(false); //TODO system true
		$this->hasMany('Sale','plot_id');

		
		$this->addExpression('total_cost')->set('SqAreaCost*Area');


		$this->addHook('beforeSave',$this);

	}

	function beforeSave(){
		if($this->loaded()){
			$plot_old_entry=$this->add('Model_Plot')->load($this->id);
			if($plot_old_entry['SqAreaCost']!=$this['SqAreaCost']){
			$rate_change=$this->add('Model_Rate_Change');

			$rate_change['plot_id']=$this->id;
			$rate_change['previouse_SqAreaCost']=$plot_old_entry['SqAreaCost'];
			$rate_change['change_SqAreaCost']=$this['SqAreaCost'];
			$rate_change->save();
			}

		}

	}

	function sale($customer,$unitrate,$salespolicy,$downpayment,$totalcost,$emipattern,$emimode,$emistartdate,$masteremi,$masteremimode,$directcommission,$emicommission){
		
		$sales=$this->add('Model_Sale');
		$sales['plot_id']=$this->id;
		$sales['customer_id']=$customer;
		$sales['RatePerSqUnit']=$unitrate;
		$sales['salespolicy_name'] = $salespolicy;
		$sales['down_payment'] =$downpayment;
		$sales['total_cost'] =$totalcost;
		$sales['emi_pattern'] = $emipattern;
		$sales['emi_mode'] = $emimode;
		$sales['master_emi'] = $masteremi;
		$sales['master_emi_mode'] = $masteremimode;
		$sales['direct_commission_to_agent'] = $directcommission;
		$sales['emi_commission_to_agent'] = $emicommission;

		$sales->save();
		$sales->create_emis($emistartdate);

		$this['status'] ='DirectSold';
		$this->save();
	}

}

