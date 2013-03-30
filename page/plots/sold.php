<?php
class page_plots_sold extends Page{
	function page_index(){
		// parent::init();

		$this->api->stickyGET('planning_id');
		$planning=$this->add('Model_Planning')->load($_GET['planning_id']);
		
		$sold=$this->add('Model_Plots_Sold');

		// $sold->addExpression('customer_name')->set(function($m,$q){
		// 	return $m->refSQL('Sale')->fieldQuery('customer');
		// });

		$cust=$sold->join('xsales.plot_id','id')->join('xcustomer.id','customer_id');
		$cust->addField('customer_name','name');
		$cust->addField('Address');
		$cust->addField('City');

		// $sold->addExpression('Address')->set(function($m,$q){
		// 	return $m->refSQL('Sale')->fieldQuery('Address');
		// });
		
		$grid=$this->add('Grid');

		$grid->setModel($sold,array('name','customer_name','Address','City','width','height','Area','total_cost','status'),null);
		
		$grid->addColumn('Expander','sale','Sale Details');
		// $grid->addColumn('Expander','emi','EMI');
	}

	function page_sale(){

		$this->api->stickyGET('xplots_id');

		// $sale=$this->add('Model_Sale')->load($_GET['xplots_id']);
		// $sale->addCondition('plot_id',$_GET['xplots_id']);

		$plot=$this->add('Model_Plot')->load($_GET['xplots_id']);
		$grid=$this->add('Grid');
		$sale=$plot->ref('Sale');
		$grid->setModel($sale,array('RatePerSqUnit','salespolicy_name','down_payment','total_cost','emi_pattern','emi_mode','master_emi','no_of_master_emi','master_emi_mode','direct_commission_to_agent','emi_commission_to_agent'));
		
		$grid->addColumn('expander','deposite','Payment Details');
		$grid->addColumn('expander','emi','EMI Details');

	}

	function page_sale_deposite(){
		$this->api->stickyGET('xsales_id');

		$sale=$this->add('Model_Sale')->load($_GET['xsales_id']);
		$deposite=$sale->ref('Deposite');


		$grid=$this->add('Grid');
		$grid->setModel($deposite,array('Amount','paid_date'));
	}

	function page_sale_emi(){
	$this->api->stickyGET('xsales_id');
	$sale=$this->add('Model_Sale')->load($_GET['xsales_id']);
	$emi=$sale->ref('Emi');
	$grid=$this->add('Grid');
	$grid->setModel($emi,array('due_date','paid_date','is_master_emi','EMIAmount','AmountPaid'));


	}
}