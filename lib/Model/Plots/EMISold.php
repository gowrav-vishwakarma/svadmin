<?php

class Model_Plots_EMISold extends Model_Plots_Sold {
	function init(){
		parent::init();
		$this->addCondition('status','EMISold');
	}
}