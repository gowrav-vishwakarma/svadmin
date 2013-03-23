<?php

class Model_Plot extends Model_Table {
	var $table='xplots';
	
	function init(){
		parent::init();

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
		$this->hasOne("Planning",'planning_id',null,'planning');

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

}

