<?php

class Model_Plots_Sold extends Model_Plot {
	function init(){
		parent::init();
		$this->addCondition('status','in',array('DirectSold','EMISold'));
	}
}