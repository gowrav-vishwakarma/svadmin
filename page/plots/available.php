<?php
class page_plots_available extends Page{
	function init(){
		parent::init();

		$this->api->stickyGET('planning_id');
		$planning=$this->add('Model_Planning')->load($_GET['planning_id']);
		
		$grid=$this->add('Grid');
		$grid->setModel($planning->ref('Available_Plots'),array('name','width','height','Area','total_cost','status'),null);
	}
}