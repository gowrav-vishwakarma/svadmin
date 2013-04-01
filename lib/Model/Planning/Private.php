<?php

class Model_Planning_Private extends Model_Planning {
	function init(){
		parent::init();
		$this->addCondition('is_private',true);
	}
}