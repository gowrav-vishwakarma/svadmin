<?php
class page_reports_directsale extends Page{
	function init(){
		parent::init();
		$tabs=$this->add('Tabs');
		$tabs->addtabUrl('emireport','EMI Due Reports');
	}
}