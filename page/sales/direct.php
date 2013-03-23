<?php
class page_sales_direct extends Page{
	function init(){
		parent::init();
		// $this->api->stickyGET('planning_id');
		// $this->api->stickyGET('plot_id');
		$plannigs=$this->add('Model_Planning');
		$plots=$this->add('Model_Plot');
		$plot_for_data = $this->add('Model_Plot');
		$sales_policy=$this->add('Model_SalesPolicy');

		$form=$this->add('Form');

		$plannigs_field=$form->addField('dropdown','planning')->setEmptyText("Select Any Plannig")->validateNotNull();
		$plannigs_field->setModel($plannigs);

		if($_GET['planning_id']) {
			$plannigs_field->set($_GET['planning_id']);
			$plots->addCondition('planning_id',$_GET['planning_id']);
		}
					
		$plot_field=$form->addField('dropdown','plot_id')->setEmptyText("Select Any Plot")->validateNotNull();
		$plot_field->setModel($plots);
		if($_GET['plot_id']){
			$plot_field->set($_GET['plot_id']);
			$plot_for_data->load($_GET['plot_id']);
			$sales_policy=$plot_for_data->ref('salespolicy_id');
		} 

		$form->addField('dropdown','customer')->setEmptyText('Select Any Customer')->validateNotNull()->setModel('Customer');

		$form->addField('line','rate_per_sq_unit')->set($plot_for_data['SqAreaCost']);

		$form->addField('line','sales_policy_name')->set($sales_policy['name']);
		
		$form->addField('line','down_payment')->set($sales_policy['down_payment']);
		
		$form->addField('line','emi_pattern')->set($sales_policy['emi_pattern']);
		
		$form->addField('line','master_emi')->set($sales_policy['master_emi']);
		
		$form->addField('line','master_emi_mode')->set($sales_policy['master_emi_mode']);
		
		$form->addField('line','direct_commission_to_agent')->set($sales_policy['direct_commission_to_agent']);
		
		$form->addField('line','emi_commission_to_agent')->set($sales_policy['emi_commission_to_agent']);
		
		$form->addSubmit(SALE);

		$plannigs_field->js('change',$form->js()->atk4_form('reloadField','plot_id',array($this->api->url(),'planning_id'=>$plannigs_field->js()->val())));
		$plot_field->js('change',$form->js()->reload(array('planning_id'=>$_GET['planning_id'],'plot_id'=>$plot_field->js()->val())));

		if($form->isSubmitted()){

			

		}

		if(!$_GET['planning_id']) $plot_field->model->_dsql()->where('planning_id',0);

	}
}