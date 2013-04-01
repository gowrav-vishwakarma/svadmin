<?php
class page_masters_agent extends Page{
	function init(){
		parent::init();

		$crud=$this->add('CRUD');
		$crud->setModel('Agent');
	}
}