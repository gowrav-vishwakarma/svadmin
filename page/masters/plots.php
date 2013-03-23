<?php

class page_masters_plots extends Page {
	function init(){
		parent::init();
		$this->api->stickyGET('planning_id');
		$planning=$this->add('Model_Planning')->load($_GET['planning_id']);
		$this->add('H1')->set('Plots for '.$planning['name']);

		$tabs=$this->add('Tabs');
		//TODO add a fix tabfor genral information About planning
		$tabs->addtabUrl($this->api->url('plots_all',array('planning_id'=>$_GET['planning_id'])),"All Plots");
		$tabs->addtabUrl($this->api->url('plots_available',array('planning_id'=>$_GET['planning_id'])),"Available Plots");
		$tabs->addtabUrl($this->api->url('plots_sold',array('planning_id'=>$_GET['planning_id'])),"All Sold Plots");
		$tabs->addtabUrl($this->api->url('plots_directsold',array('planning_id'=>$_GET['planning_id'])),"Direct Sold Plots");
		$tabs->addtabUrl($this->api->url('plots_emisold',array('planning_id'=>$_GET['planning_id'])),"EMI Sold Plots");


	}
}