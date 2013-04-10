<?php
class page_marketing extends Page{
	function init(){
		parent::init();

		$tabs=$this->add('Tabs');
		$tabs->addtabUrl('plan_payouts','Payouts');
		$tabs->addtabUrl('plan_closing','Closing');
		$tabs->addtabUrl('mrkt_pins','Pin Management');
	}
}