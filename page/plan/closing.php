<?php

class page_plan_closing extends Page {
	function init(){
		parent::init();

		$form= $this->add('Form',null,null,array('form_horizontal'));
		$form->addField("DatePicker",'closing_date')->validateNotNull()->set(null);
		$form->addField("password",'admin_password')->validateNotNull();
		$form->addSubmit("Generate Payouts");

		if($form->isSubmitted()){
			$c=$this->add('Model_Closing');
			try{
				$form->api->db->beginTransaction();
				$c->do_closing($form->get('closing_date'));
			}catch(Exception $e){
				$form->api->db->rollback();
				// $form->js()->univ()->errorMessage($e->getMessage())->execute();
				throw $e;
			}
			$form->api->db->commit();
			$form->js(null,$form->js()->univ()->successMessage("Payouts Generated"))->reload()->execute();
		}
	}
}