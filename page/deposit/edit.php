<?php

class page_deposit_edit extends Page {
	function init(){
		parent::init();
		$emi = $this->add('Model_Emi');

		if($_GET['remove']){
			
			$emi->load();
			$emi->withDraw($amount, $date=null, $reason='Wrong entry done');	
		}
		$form = $this->add('Form',null,null,array('form_horizontal'));
		$customer_field = $form->addField('line','customer_username');
		$sales_field = $form->addField('dropdown','sales_id')->setEmptyText('Select Any Sales');

		$sales = $this->add('Model_Sale');

		if($_GET['sales_selected']) {
			$emi->addCondition('sales_id',$_GET['sales_selected']);
		// $emi->debug();
		}else{
			$emi->addCondition('sales_id',-1);
		}
		if($_GET['customer_username']){
			$customer = $this->add('Model_Customer')->loadBy('username',$_GET['customer_username']);
			$sales->addCondition('customer_id',$customer->id);
		}else{
			$sales->addCondition('customer_id',0);
		}

		$sales_field->setModel($sales);

		$grid=$this->add('Grid');

		$grid->setModel($emi);
		$grid->addColumn('Button','remove');

		$customer_field->js('change',$form->js()->atk4_form('reloadField','sales_id',array($this->api->url(),'customer_username'=>$customer_field->js()->val())));
		$sales_field->js('change',$grid->js()->reload(array('sales_selected'=>$sales_field->js()->val())));

		
	}
}