<?php
class page_masters extends Page{
	function init(){
		parent::init();

		$tabs=$this->add('Tabs');
		$tabs->addtabUrl('masters_plannigs','Plannigs');
	}
}