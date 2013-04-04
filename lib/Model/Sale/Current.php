<?php
class Model_Sale_Current extends Model_Sale{
	function init(){
		parent::init();
	$this->addCondition('is_current',true);
	}
}
