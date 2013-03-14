<?php

class Model_Plot extends Model_Table {
	var $table='xplots';
	
	function init(){
		parent::init();

		$this->addField('name')->mandatory('Plot Number is must')->caption('Plot Number');
		$this->addField('width')->mandatory('Width is required')->display(array('grid'=>'grid/inline'));
		$this->addField('height')->mandatory('Height is required')->display(array('grid'=>'grid/inline'));
		$this->addField('Area');
		$this->addField('status')->enum(array('Available','DirectSold','EMISold','AvailableReSale'))->defaultValue('Available')->system(true);
		$this->hasOne("Planning",'planning_id',null,'planning');
	}
}