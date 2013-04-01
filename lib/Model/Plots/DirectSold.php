<?php

class Model_Plots_DirectSold extends Model_Plots_Sold {
	function init(){
		parent::init();
		$this->addCondition('status','DirectSold');
	}
}