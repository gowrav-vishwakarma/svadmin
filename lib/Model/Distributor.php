<?php

class Model_Distributor extends Model_Table {
	var $table= "xdistributors";
	function init(){
		parent::init();

		$this->hasOne('Customer','customer_id');
		$customer=$this->join('xcustomer.id','customer_id');
		$customer->addField('name');
		
		$this->hasOne('Distributor','sponsor_id');
		$this->hasOne('Distributor','introducer_id');

		$this->addField('legA_id')->defaultValue(0);
		$this->addField('legB_id')->defaultValue(0);
		$this->addField('legC_id')->defaultValue(0);
		$this->addField('legD_id')->defaultValue(0);

		$this->addField('Introduction_Income')->defaultValue(0);
		$this->addField('Level_1_Commission')->defaultValue(0);
		$this->addField('Level_2_Commission')->defaultValue(0);
		$this->addField('Level_3_Commission')->defaultValue(0);
		$this->addField('Level_4_Commission')->defaultValue(0);
		$this->addField('Level_5_Commission')->defaultValue(0);
		$this->addField('Level_6_Commission')->defaultValue(0);

		$this->addField('Level_1_Count')->defaultValue(0);
		$this->addField('Level_2_Count')->defaultValue(0);
		$this->addField('Level_3_Count')->defaultValue(0);
		$this->addField('Level_4_Count')->defaultValue(0);
		$this->addField('Level_5_Count')->defaultValue(0);
		$this->addField('Level_6_Count')->defaultValue(0);
		$this->addField('Path')->defaultValue(0);

		$this->addExpression('inLeg')->set('RIGHT(Path,1)');

		$this->addHook('beforeSave',$this);
		$this->addHook('afterSave',$this);
		
		// $this->debug();

	}

	function beforeSave(){	
		if(!$this->loaded()){
			$this->memorize('is_new',true);
			$sponsor=$this->ref('sponsor_id');
			$this['Path'] = $sponsor['Path']. $this->recall('leg');
			$distributor=clone $this;
			for($i=1;$i<=6;$i++){
				if($distributor['sponsor_id']==0) break;
				$sponsor_count=$distributor->ref('sponsor_id');
				$sponsor_count['Level_'.$i.'_Count'] = $sponsor_count['Level_'.$i.'_Count'] +1;
				$sponsor_count->save();
				$distributor = $sponsor_count;
			}
		}
		// throw $this->exception('Hello '. $this['sponsor_id']);

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