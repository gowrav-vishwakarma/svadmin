<?php

class page_masters_plots extends Page {
	function init(){
		parent::init();

		$this->api->stickyGET('planning_id');

		$planning=$this->add('Model_Planning')->load($_GET['planning_id']);

		$this->add('H1')->set('Plots for '.$planning['name']);
		$crud=$this->add('CRUD');
		$crud->setModel($planning->ref('Plots'),array('name','width','height','Area','status'),null);

	}
}