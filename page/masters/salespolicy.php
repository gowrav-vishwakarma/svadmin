<?php
class page_masters_salespolicy extends Page{
	function init(){
		parent::init();
	
		$crud=$this->add('CRUD');
		$crud->setModel('SalesPolicy');
	}
}