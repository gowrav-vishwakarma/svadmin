<?php
class page_emireport extends Page{
	function init(){
		parent::init();

		// $actual_link='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

		// echo $actual_link;
		$plannings=$this->add('Model_Planning');
		
		$plot=$this->add('Model_Plots_Sold');

		$customer=$this->add('Model_Customer');

		$sales=$this->add('Model_Sale');

		$form=$this->add('Form',NULL,NULL,array('form_horizontal'));
		$palnnings_field= $form->addField('dropdown','planning')->setEmptyText("Select Any Planning");
		$palnnings_field->setModel($plannings);

		$plot_field=$form->addField('dropdown','plot')->setEmptyText("Select Any Plot");

		if($_GET['planning_id']){
			$plot->addCondition('planning_id',$_GET['planning_id']);
		}
		$plot_field->setModel($plot);
		$customer_field=$form->addField('dropdown','customer')->setEmptyText("Select Any Customer");
		
		if($_GET['plot_id']){
			$customer_plot= $customer->join('xsales.customer_id','id');
			$customer_plot->addField('plot_id');
			$customer->addCondition('plot_id',$_GET['plot_id']);
		}

		$customer_field->setModel($customer);
		// $palnnings= $form->addField('dropdown','agent')->setEmptyText("Select Any Agent");
		$sale_field=$form->addField('dropdown','sales')->setEmptyText("Select Any Sale");

		if($_GET['customer_id']){
			$sales->addCondition('customer_id',$_GET['customer_id']);
		}

		$sale_field->setModel($sales);

		$emi_type=$form->addField('dropdown','emitype')->setEmptyText("Select Any")->setValueList(array("paid"=>"Paid Emi",
																									"unpaid"=>"Un-Paid Emi"));

		$due_from_date=$form->addField('DatePicker','due_from_date');
		
		$paid_from_date=$form->addField('DatePicker','paid_from_date');
		$due_to_date=$form->addField('DatePicker','due_to_date');
		
		
		$paid_to_date =$form->addField('DatePicker','paid_to_date');
		
		$palnnings_field->js('change',$form->js()->atk4_form('reloadField','plot',array($this->api->url(),'planning_id' =>$palnnings_field->js()->val())));

		$customer_field->js('change',$form->js()->atk4_form('reloadField','sales',array($this->api->url(),'customer_id'=>$customer_field->js()->val())));
		
		$plot_field->js('change',$form->js()->atk4_form('reloadField','customer',array($this->api->url(),'plot_id' =>$plot_field->js()->val())));

		$form->addSubmit('GET Report');

		
		$emi  =$this->add('Model_Emi');
		$sj   =$emi->join('xsales.id','sales_id');
		$sj->hasOne('Customer','customer_id');
		$sj->addField('plot_id');
		// $sj->addField('name');
		
		$pj   =$sj->join('xplots.id','plot_id');
		$pj->addField('plot_number','name');
		$pj->addField('planning_id');
		
		$plj  =$pj->join('xplannings.id','planning_id');
		$plj->addField('planning_name','name');
		
		
		$grid =$this->add('Grid');

		if($_GET['filter']){
			echo $_GET['paid_to_date'];
			if($_GET['planning']) $emi->addCondition("planning_id",$_GET['planning']);

			if($_GET['plot']) $emi->addCondition('plot_id',$_GET['plot']);

			if($_GET['customer']) $emi->addCondition('customer_id',$_GET['customer']);
			
			if($_GET['emitype']){
				if($_GET['emitype'] == 'paid'){
					$emi->addCondition('AmountPaid','<>', 0);
				}else{
					$emi->addCondition('AmountPaid', 0);
				}
			} 

			if($_GET['sales']) $emi->addCondition('sales_id',$_GET['sales']);

			if($_GET['due_from_date']) $emi->addCondition('due_date','>=',$_GET['due_from_date']);
			
			if($_GET['due_to_date']) $emi->addCondition('due_date','<=',$_GET['due_to_date']);
			
			if($_GET['paid_from_date']) $emi->addCondition('paid_date','>=',$_GET['paid_from_date']);
			
			if($_GET['paid_to_date']) $emi->addCondition('paid_date','<=',$_GET['paid_to_date']);

		}else{
			$emi->addCondition('id',0);
		}


		$grid->setModel($emi);


		if($form->isSubmitted()){
			// $grid->js()->univ()->successMessage($form->get('paid_from_date'))->execute();
			$grid->js()->reload(array(
										"planning"=>$form->get('planning'),
										"plot"=>$form->get('plot'),
										"customer"=>$form->get('customer'),
										"emitype"=>$form->get('emitype'),
										"sales"=>$form->get('sales'),
										"due_from_date"=>($form->get('due_from_date')?$form->get('due_from_date'):0),
										"due_to_date"=>($form->get('due_to_date')?$form->get('due_to_date'):0),
										"paid_from_date"=>($form->get('paid_from_date')?$form->get('paid_from_date'):0),
										"paid_to_date"=>($form->get('paid_to_date')?$form->get('paid_to_date'):0),
											"filter"=>1))->execute();
		}
	}
}