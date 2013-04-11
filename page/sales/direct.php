<?php

class page_sales_direct extends Page{
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

		$form->addField('checkbox','new_customer')
			->js(true)->univ()->bindConditionalShow(array(
				''=>array('customer'),
				'*'=>array('customer_name','username','password','re_password','address','Occupation','Company_Name','Company_Address','PAN_No','Email_Id',
					'CoApplicant_Name','CoApplicant_Occupation','CoApplicant_Address','CoApplicant_Designation',
					'CoApplicantCompanyAddress','CoApplicant_PAN_No','CoApplicant_Contact_No',
					'CoApplicant_Email_Id','Name_Of_Nominee','Relation_With_Applicant',
					'Nominee_PAN_NO','Nominee_Age','Nominee_Address')
				),'div .atk-row');

		$form->addField('dropdown','customer')->setEmptyText('Select Any Customer')->setModel('Customer');


		$form->addField('dropdown','agent')->setEmptyText('Select Any Agent')->validateNotNull()->setModel('Agent');
		
		$form->addField('line','customer_name');

		$form->addField('line','username');

		$form->addField('password','password');
		
		$form->addField('password','re_password');


		$form->addField('text','address');
		
		$form->addField('line','Occupation');
		
		$form->addField('line','Company_Name');
		
		$form->addField('line','Company_Address');
		
		$form->addField('line','PAN_No');
		
		$form->addField('line','Email_Id');
		
		$form->addField('line','CoApplicant_Name');
		
		$form->addField('line','CoApplicant_Occupation');
		
		$form->addField('text','CoApplicant_Address');
		
		$form->addField('line','CoApplicant_Designation');
		
		$form->addField('text','CoApplicantCompanyAddress');
		
		$form->addField('line','CoApplicant_PAN_No');
		
		$form->addField('line','CoApplicant_Contact_No');
		
		$form->addField('line','CoApplicant_Email_Id');
		

		$form->addField('line','Name_Of_Nominee');

		$form->addField('line','Relation_With_Applicant');

		$form->addField('line','Nominee_PAN_NO');

		$form->addField('line','Nominee_Age');

		$form->addField('text','Nominee_Address');
		// $form->addField('line','city');

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

		$form->addField('DatePicker','emi_start_date')->set(date('Y-m-d'));
		
		$form->addField('line','master_emi')->set($sales_policy['master_emi']);
		
		$form->addField('line','no_of_master_emi')->set($sales_policy['no_of_master_emi']);
		
		$form->addField('dropdown','master_emi_mode')->setEmptyText("Select Any")->setValueList(array("Half-Yearly"=>"Half-Yearly",
																									"Yearly"=>"Yearly"))
																									->set($sales_policy['master_emi_mode']);
		
		$form->addField('line','direct_commission_to_agent')->set($sales_policy['direct_commission_to_agent']);
		
		$form->addField('line','emi_commission_to_agent')->set($sales_policy['emi_commission_to_agent']);
		
		$form->addSubmit(SALE);

		$plannigs_field->js('change',$form->js()->atk4_form('reloadField','plot_id',array($this->api->url(),'planning_id'=>$plannigs_field->js()->val())));
		$plot_field->js('change',$form->js()->reload(array('planning_id'=>$_GET['planning_id'],'plot_id'=>$plot_field->js()->val())));

		if($form->isSubmitted()){
			try{

				$form->api->db->beginTransaction();
				if($form->get('new_customer')){
					if($form->get('password')!= $form->get('re_password'))
					$form->displayError('password','password does not Match, Check Again');

					// TODO add a new customer
					$cust=$this->add('Model_Customer');
					$cust['name']=$form->get('customer_name');
					$cust['username']=$form->get('username');
					$cust['password']=$form->get('password');
					$cust['Address']=$form->get('address');
					$cust['Occupation']=$form->get('Occupation');
					$cust['Company_Name']=$form->get('Company_Name');
					$cust['Company_Address']=$form->get('Company_Address');
					$cust['PAN_No']=$form->get('PAN_No');
					$cust['Contact_No']=$form->get('Contact_No');
					$cust['Email_Id']=$form->get('Email_Id');
					$cust['CoApplicant_Name']=$form->get('CoApplicant_Name');
					$cust['CoApplicant_Occupation']=$form->get('CoApplicant_Occupation');
					$cust['CoApplicant_Address']=$form->get('CoApplicant_Address');
					$cust['CoApplicant_CompanyName']=$form->get('CoApplicant_CompanyName');
					$cust['CoApplicant_Designation']=$form->get('CoApplicant_Designation');
					$cust['CoApplicantCompanyAddress']=$form->get('CoAppCompanyAddress');
					$cust['CoApplicant_PAN_No']=$form->get('CoApplicant_PAN_No');
					$cust['CoApplicant_Contact_No']=$form->get('CoApplicant_Contact_No');
					$cust['CoApplicant_Email_Id']=$form->get('CoApplicant_Email_Id');
					// $cust['City']=$form->get('city');
					$cust->save();
					$customer=$cust->id;
				}else{
					if($form->get('customer')==null) $form->displayError('customer','This is must');
					$customer=$form->get('customer');
				}

				$plot=$this->add('Model_Plot');
				$plot->load($form->get('plot_id'));
				$sales_object=$plot->sale(
									$customer,
									$form->get('agent'),
									$form->get('rate_per_sq_unit'),
									$form->get('sales_policy_name'),
									$form->get('down_payment'),
									$form->get('total_cost'),
									$form->get('emi_pattern'),
									$form->get('emi_mode'),
									$form->get('emi_start_date'),
									$form->get('master_emi'),
									$form->get('no_of_master_emi'),
									$form->get('master_emi_mode'),
									$form->get('direct_commission_to_agent'),
									$form->get('emi_commission_to_agent'),
									'DirectSold'
										);

				$sales_object['Name_Of_Nominee'] = $form->get('Name_Of_Nominee');
				$sales_object['Relation_With_Applicant'] = $form->get('Relation_With_Applicant');
				$sales_object['Nominee_PAN_NO'] = $form->get('Nominee_PAN_NO');
				$sales_object['Nominee_Age'] = $form->get('Nominee_Age');
				$sales_object['Nominee_Address'] = $form->get('Nominee_Address');
				$sales_object->save();
			}catch(Exception $e){
					$form->api->db->rollback();
					// $form->js()->univ()->errorMessage($e->getMessage())->execute();
					throw $e;
			}
			$form->api->db->commit();
			$form->js(null,$this->js()->reload())->univ()->successMessage("plot Sale success fully ")->execute();


		}

		if(!$_GET['planning_id']) $plot_field->model->_dsql()->where('planning_id',0);

	}
}