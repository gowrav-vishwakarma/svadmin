<?php

class Model_Customer extends Model_Table {
	var $table= "xcustomer";
	function init(){
		parent::init();

		$this->addField('name')->mandatory("This is a required field");
		$this->addField('username')->mandatory("This is a required field");
		$this->addField('password')->mandatory("This is a required field");
		$this->addField('Address')->mandatory("This is a required field");
		$this->addField('Occupation')->mandatory("This is a required field");
		$this->addField('Company_Name')->mandatory("This is a required field");
		$this->addField('Company_Address')->type('text')->mandatory("This is a required field");
		$this->addField('PAN_No')->mandatory("This is a required field");
		$this->addField('Contact_No')->mandatory("This is a required field");
		$this->addField('Email_Id')->mandatory("This is a required field");
		$this->addField('CoApplicant_Name')->mandatory("This is a required field");
		$this->addField('CoApplicant_Occupation')->mandatory("This is a required field");
		$this->addField('CoApplicant_Address')->type('text')->mandatory("This is a required field");
		$this->addField('CoApplicant_CompanyName')->mandatory("This is a required field");
		$this->addField('CoApplicant_Designation')->mandatory("This is a required field");
		$this->addField('CoApplicantCompanyAddress')->mandatory("This is a required field");
		$this->addField('CoApplicant_PAN_No')->mandatory("This is a required field");
		$this->addField('CoApplicant_Contact_No')->mandatory("This is a required field");
		$this->addField('CoApplicant_Email_Id')->mandatory("This is a required field");

		$this->hasMany('Distributor','customer_id');
		$this->hasMany('Sale','customer_id',null,'Purchases');

		$this->addExpression('is_distributor')->set(function($m,$q){
			return $m->refSQL('Distributor')->count();
		})->type('boolean');

		$this->addHook('beforeSave',$this);
	}

	function beforeSave(){
		$old_customer=$this->add('Model_Customer');
		$old_customer->addCondition('username',$this['username']);
		if($this->loaded()){
			$old_customer->addCondition('id','<>',$this->id);	
		}
		$old_customer->tryLoadAny();
		if($old_customer->loaded())
			throw $this->exception("This username is Already used, try another");
	}

}