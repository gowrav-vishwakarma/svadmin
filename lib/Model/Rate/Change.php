<?php
class Model_Rate_Change extends Model_Table{
	var $table="rate_change";
	function init(){
		parent::init();
		$this->hasOne('Plot','plot_id',null,'plot');
		$this->addField('previouse_SqAreaCost');
		$this->addField('change_SqAreaCost');
		$this->addField('date')->defaultValue(date('Y-m-d H:i:s'));
	}

}