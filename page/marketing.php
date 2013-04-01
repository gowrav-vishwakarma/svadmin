<?php
class page_marketing extends Page{
	function init(){
		parent::init();

		$tabs=$this->add('Tabs');
		$tabs->addtabUrl('mrkt_payouts','Payouts');
		$tabs->addtabUrl('mrkt_pins','Pin Management');
	}
}