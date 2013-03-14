<?php

class Model_Planning extends Model_Table {
	var $table='xplannings';
	function init(){
		parent::init();

		$this->addField('name')->mandatory("Planning must have a Name");
		$this->addField('Phase')->defaultValue("-")->mandatory("Planning must have a Phase");
		$this->addField('is_private')->type('boolean');

		$this->hasMany('Plot','planning_id',null,'Plots');
		$this->hasMany('Plots_Available','planning_id',null,'Available_Plots');
		$this->hasMany('Plots_Sold','planning_id',null,'Sold_Plots');
		$this->hasMany('Plots_DirectSold','planning_id',null,'DirectSold_Plots');
		$this->hasMany('Plots_EMISold','planning_id',null,'EMISold_Plots');

		$this->addHook('beforeDelete',$this);
	}


	function beforeDelete(){
		if($this->ref('Plots')->count()->getOne() > 0 ){
			throw $this->exception('This Planning has Plots, cannot continue ...');
		}
	}
} 


class Model_Plannings extends Model_planning {}