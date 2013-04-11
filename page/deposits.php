<?php

class page_deposits extends Page {
	function init(){
		parent::init();
		$tabs = $this->add('Tabs');
		$tabs->addtabURL('deposit_edit',"Deposit Report");
	}
}