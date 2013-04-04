	<?php
class page_sales_payment extends Page{
	function init(){
		parent::init();

		$customer=$this->add('Model_Customer');
		$sales=$this->add('Model_Sale_Current');
		$view=$this->add('View_Info')->set('Select Sale to get Information');
		

		$form=$this->add('Form');
		$customer_field=$form->addField('dropdown','customer')->setEmptyText("Select Any")->validateNotNull();
		$customer_field->setModel($customer);

		$sales_field=$form->addField('dropdown','sales')->setEmptyText("Select Any")->validateNotNull();
		$form->addField('line','amount');
		$form->addField('checkbox','adjust_master_emi_first');
		$form->addField('line','narration');
		$form->addField('DatePicker','paid_date')->set(date('Y-m-d'));
		$form->addSubmit('Deposite');

		if($_GET['sales_id']){
			$sale=$this->add('Model_Sale_Current');
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

			try{
				
				$form->api->db->beginTransaction();

				$sales=$this->add('Model_Sale_Current');
				$sales->load($form->get('sales'));
				$sales->depositAmount($form->get('amount'),$form->get('paid_date'),$form->get('adjust_master_emi_first'));
				
			}catch(Exception $e){
				$form->api->db->rollback();
					// $form->js()->univ()->errorMessage($e->getMessage())->execute();
					throw $e;
			}
			$form->api->db->commit();
			$form->js(null,$this->js()->reload())->univ()->successMessage("Payment Deposite success fully ")->execute();
		}
	}
}