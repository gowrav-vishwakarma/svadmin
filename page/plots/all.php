<?php
class page_plots_all extends Page{
	function init(){
		parent::init();

		$this->api->stickyGET('planning_id');
		$planning=$this->add('Model_Planning')->load($_GET['planning_id']);

		$crud=$this->add('CRUD');
		$crud->setModel($planning->ref('Plots'),array('name','block_number','SqAreaCost','Unit','is_corner','width','height','Area','status'),null);
	}
}