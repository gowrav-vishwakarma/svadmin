<?php

class Model_Planning_Public extends Model_Planning{
	function init(){
		parent::init();
		$this->addCondition('is_private',false);
	}
}