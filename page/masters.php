<?php
class page_masters extends Page{
	function init(){
		parent::init();

		$tabs=$this->add('Tabs');
		$tabs->addtabUrl('masters_plannigs','Plannigs');
		$tabs->addtabUrl('masters_salespolicy','Sales Policy Manager');
		$tabs->addtabUrl('masters_customer','Customers');
		$tabs->addtabUrl('masters_agent','Agent');
	}
}