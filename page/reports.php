<?php
class page_reports extends Page{
	function init(){
		parent::init();

		$tabs=$this->add('Tabs');
		$tabs->addtabUrl('reports_sales','Sales Reports');
		$tabs->addtabUrl('reports_mrkt','Marketing Reports');

	}
}