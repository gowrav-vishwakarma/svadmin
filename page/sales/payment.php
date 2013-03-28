<?php
class page_sales_payment extends Page{
	function init(){
		parent::init();

		$customer=$this->add('Model_Customer');
		$sales=$this->add('Model_Sale');
		$view=$this->add('View_Info')->set('Select Sale to get Information');
		

		$form=$this->add('Form');
		$customer_field=$form->addField('dropdown','customer')->setEmptyText("Select Any")->validateNotNull();
		$customer_field->setModel($customer);

		$sales_field=$form->addField('dropdown','sales')->setEmptyText("Select Any")->validateNotNull();
		$form->addField('line','amount');
		$form->addField('line','narration');
		$form->addField('DatePicker','paid_date')->set(date('Y-m-d'));
		$form->addSubmit('Deposite');

		if($_GET['sales_id']){
			$sale=$this->add('Model_Sale');
			$sale->load($_GET['sales_id']);
			// echo $sale['down_payment'];

			$down_payment_due = $sale['down_payment'] - $sale['down_payment_submitted'];

			$emi_over_due = $sale->ref('Emi')->_dsql()->del('field')->field('SUM(EMIAmount-AmountPaid)')->where('due_date','<=' , date('Y-m-d'))->getOne();
			$emi_due = $sale->ref('Emi')->_dsql()->del('field')->field('SUM(EMIAmount-AmountPaid)')->getOne();


			$view->set("For Sale  ID  :: Due Down Payment Amount = $down_payment_due , Emi Over Due = $emi_over_due , Total EMI Amount Due = $emi_due");
		}


		if($_GET['customer_id']){
			$sales->addCondition('customer_id',$_GET['customer_id']);
		}

		$sales_field->setModel($sales);
		$sales_field->js('change',$view->js()->reload(array('sales_id'=>$sales_field->js()->val())));
		$customer_field->js('change',$form->js()->atk4_form('reloadField','sales',array($this->api->getDestinationURL(),'customer_id'=>$customer_field->js()->val())));
     		
		

	
		if($form->isSubmitted()){

			
			$sales=$this->add('Model_Sale');
			$sales->load($form->get('sales'));
			$sales->depositAmount($form->get('amount'),$form->get('paid_date'));

			$form->js(null,$form->js()->univ()->successMessage("Amount Submitted"))->reload()->execute();

			
		}
	}
}