<?php

class Model_Distributor extends Model_Table {
	var $table= "xdistributors";
	function init(){
		parent::init();

		$customer=$this->join('xcustomer.id','customer_id');
		$customer->addField('name');
		$customer->addField('Address');
		$customer->addField('City');
		
		$this->hasOne('Distributor','sponsor_id');
		$this->hasOne('Distributor','introducer_id');

		$this->addField('legA_id')->defaultValue(0);
		$this->addField('legB_id')->defaultValue(0);
		$this->addField('legC_id')->defaultValue(0);
		$this->addField('legD_id')->defaultValue(0);

		$this->addField('A_Commission')->defaultValue(0);
		$this->addField('B_Commission')->defaultValue(0);
		$this->addField('C_Commission')->defaultValue(0);
		$this->addField('D_Commission')->defaultValue(0);

		$this->addField('Path')->defaultValue(0);

		$this->addExpression('inLeg')->set('RIGHT(Path,1)');

		$this->addHook('beforeSave',$this);
		$this->addHook('afterSave',$this);

	}

	function beforeSave(){
		if(!$this->loaded()){
			$this->memorize('is_new',true);
			$sponsor=$this->ref('sponsor_id');
			$this['Path'] = $sponsor['Path']. $this->recall('leg');
		}
	}

	function afterSave(){
		if($this->recall('is_new',false)){
			$sponsor=$this->add('Model_Distributor')->load($this['sponsor_id']);
			$sponsor['leg'.$this->recall('leg').'_id']=$this->id;
			$sponsor->save();
		}
		$this->forget('is_new');
		$this->forget('leg');
	}

}