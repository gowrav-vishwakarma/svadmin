<?php
class page_sales_emi extends Page{
	function init(){
		parent::init();
		// $this->api->stickyGET('planning_id');
		// $this->api->stickyGET('plot_id');
		$plannigs=$this->add('Model_Planning');
		$plots=$this->add('Model_Plots_Available');
		$plot_for_data = $this->add('Model_Plots_Available');
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

		$form->addField('checkbox','existing_customer')
			->js(true)->univ()->bindConditionalShow(array(
				''=>array('customer_name'),
				'*'=>array('customer')
				),'div .atk-row');

		$form->addField('dropdown','customer')->setModel('Customer');

		$form->addField('dropdown','sponsor')->setEmptyText("Select Any Sponsor")->validateNotNull()->setModel("Distributor");

		$form->addField('dropdown','leg')->setEmptyText('Select any Leg')->validateNotNull()->setValueList(array('A'=>'Leg A','B'=>'Leg B','C'=>'Leg C','D'=>'Leg D'));

		$form->addField('dropdown','introducer')->setEmptyText("Select Any Sponsor")->validateNotNull()->setModel("Distributor");

		$form->addField('line','customer_name');

		$form->addField('line','rate_per_sq_unit')->set($plot_for_data['SqAreaCost']);

		$form->addField('line','sales_policy_name')->set($sales_policy['name']);
		
		$form->addField('line','down_payment')->set($sales_policy['down_payment']);
		
		$form->addField('line','total_cost')->set($plot_for_data['total_cost']);
		
		$form->addField('line','emi_pattern')->set($sales_policy['emi_pattern']);
		
		$form->addField('dropdown','emi_mode')->setEmptyText("Select Any")->setValueList(array("Fortnightly"=>"Fortnightly",
																	"Monthly"=>"Monthly",
																	"Quarterly"=>"Quarterly",
																	"Half-Yearly"=>"Half-Yearly",
																	"Yearly"=>"Yearly"))
																	->set($sales_policy['emi_mode']);

		$form->addField('DatePicker','emi_start_date')->set(date("Y-m-d", strtotime(date('Y-m-d')." +1 month" )));
		
		$form->addField('line','master_emi')->set($sales_policy['master_emi']);
		
		$form->addField('dropdown','master_emi_mode')->setEmptyText("Select Any")->setValueList(array("Half-Yearly"=>"Half-Yearly",
																									"Yearly"=>"Yearly"))
																									->set($sales_policy['master_emi_mode']);
		
		$form->addField('line','direct_commission_to_agent')->set($sales_policy['direct_commission_to_agent']);
		
		$form->addField('line','emi_commission_to_agent')->set($sales_policy['emi_commission_to_agent']);
		
		$form->addSubmit(SALE);

		$plannigs_field->js('change',$form->js()->atk4_form('reloadField','plot_id',array($this->api->url(),'planning_id'=>$plannigs_field->js()->val())));
		$plot_field->js('change',$form->js()->reload(array('planning_id'=>$_GET['planning_id'],'plot_id'=>$plot_field->js()->val())));

		if($form->isSubmitted()){

			// Check availability in Selected LEG
			$sponsor=$this->add('Model_Distributor');
			$sponsor->load($form->get('sponsor'));
			if($sponsor['leg' . $form->get('leg').'_id'] != 0 ){
				$form->displayError('leg','This Leg is already Filled');
			}


			if(!$form->get('existing_customer')){
				$dist=$this->add('Model_Distributor');
				// TODO check for existing username
				$dist['name']=$form->get('customer_name');
				$dist['sponsor_id']=$form->get('sponsor');
				$dist['introducer_id']=$form->get('introducer');
				$dist->memorize('leg',$form->get('leg'));
				$dist->save();
				$customer=$dist['customer_id'];
			}else{
				if($form->get('customer')==null) $form->displayError('customer','This is must');
				$dist=$this->add('Model_Customer')->load($form->get('customer'))->ref('Distributor')->tryLoadAny();
				// TODO check for existing username
				// $dist['name']=$form->get('customer_name');
				$dist['sponsor_id']=$form->get('sponsor');
				$dist['introducer_id']=$form->get('introducer');
				$dist->memorize('leg',$form->get('leg'));
				$dist->save();
				$customer=$form->get('customer');
			}

			$plot=$this->add('Model_Plot');
			$plot->load($form->get('plot_id'));
			$plot->sale($customer,
								$form->get('rate_per_sq_unit'),
								$form->get('sales_policy_name'),
								$form->get('down_payment'),
								$form->get('total_cost'),
								$form->get('emi_pattern'),
								$form->get('emi_mode'),
								$form->get('emi_start_date'),
								$form->get('master_emi'),
								$form->get('master_emi_mode'),
								$form->get('direct_commission_to_agent'),
								$form->get('emi_commission_to_agent')
									);
			
			$form->js(null,$form->js()->univ()->successMessage("Plot sold successfully"))->reload()->execute();

		}

		if(!$_GET['planning_id']) $plot_field->model->_dsql()->where('planning_id',0);

	}
}