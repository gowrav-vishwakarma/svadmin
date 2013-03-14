<?php

class Model_Plots_Available extends Model_Plot {
	function init(){
		parent::init();
		$this->addCondition('status','Available');
	}
}