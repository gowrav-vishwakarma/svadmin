<?php
class page_sales extends Page{
	function init(){
		parent::init();

		$tabs=$this->add('Tabs');
		$tabs->addtabUrl('sales_direct','Direct Plot Sale');
		$tabs->addtabUrl('sales_emi','EMI Plot Sale');
		$tabs->addtabUrl('sales_return','Sale Return');
		$tabs->addtabUrl('sales_transfer','Sale Transfer');
		$tabs->addtabUrl('sales_payment','Payment Deposite');
	}
}