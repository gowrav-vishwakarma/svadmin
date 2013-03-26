<?php

class page_index extends Page {
	function init(){
		parent::init();
		$this->add('Text')->set("Hello World");
		$this->add('jqgrid/jqGrid')->setModel('Planning');
	}
}