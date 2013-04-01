<?php
class page_masters_customer extends Page{
	function init(){
		parent::init();

		$crud=$this->add('CRUD');
		$crud->setModel('Customer');
	}
}