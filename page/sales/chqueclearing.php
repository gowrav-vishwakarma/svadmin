<?php
class page_sales_chqueclearing extends Page{
	function page_index(){

		$form=$this->add('Form',null,null,array('form_horizontal'));

		$form->addField('DatePicker','from_date');
		$form->addField('DatePicker','to_date');
		$form->addField('dropdown','status')->setEmptyText("All")->setValueList(array("Cleared"=>"Cleared",
																				"UnCleared"=>"UnCleared",
																				"Bounced"=>"Bounced"));
	
		$form->addSubmit("Get List");

		$cheque_details=$this->add('Model_ChequeDetails');
		$sj=$cheque_details->join('xsales.id','sales_id');
		$sj->hasOne('Customer','customer_id');
		$sj->hasOne("Plot",'plot_id');

		$grid=$this->add('Grid');
		$grid->setModel($cheque_details,array('customer','plot','Cheque_No','Amount','For_Master_Emi','Created_at','Cheque_Date','Cleared_On','Bounced_On','Bank'));
		$cheque_details = $grid->dq;
		if($_GET['filter']){
			switch($_GET['status']){
				case "Cleared":
					if($_GET['from_date']) $cheque_details->where('Cleared_On','>=',$_GET['from_date']);
					if($_GET['to_date']) $cheque_details->where('Cleared_On','<',$_GET['to_date']);
					break;
				case "UnCleared":
					$grid->addColumn('expander','clear','Mark Clear');
					$grid->addColumn('expander','bounced','Mark Bounced');
					if($_GET['from_date'])
						$cheque_details->where('Cheque_Date','>=',$_GET['from_date']);
					if($_GET['to_date'])
						$cheque_details->where('Cheque_Date','<',$_GET['to_date']);
					$cheque_details->where('Cleared_On',null);
					$cheque_details->where('Bounced_On',null);
					break;
				case "Bounced":
					$cheque_details->where('Bounced_On','>=',$form->get('from_date'));
					$cheque_details->where('Bounced_On','<',$form->get('to_date'));
					break;
			}
		}

		// $grid->addColumn('expander','clear','Mark Cleared');
		// $grid->addColumn('expander','bounced','Mark Bounced');


		if($form->isSubmitted()){

			$grid->js()->reload(array("status"=>$form->get('status'),
										"from_date"=>($form->get('from_date')==null)? 0 : $form->get('from_date'),
										"to_date"=> ($form->get('to_date') == null)?0:$form->get('to_date'),
										"filter"=>1))->execute();
		}
	}

	function page_clear(){
		$this->api->stickyGET('xcheque_details_id');
		$cheque_details = $this->add('Model_ChequeDetails')->load($_GET['xcheque_details_id']);

		if(strtotime($cheque_details['Cheque_Date']) > strtotime(date('Y-m-d')))
			$this->add('View_Error')->set('You are clearing a post dated cheque, Are you confirm?');

		$form=$this->add('Form',null,null,array('form_horizontal'));
		$form->addField('line','cheque_number','Fill Cheque Number Again')->validateNotNull();
		$form->addField('DatePicker','cleared_date')->set($cheque_details['Cheque_Date'])->validateNotNull();
		$form->addSubmit('Mark Cleared');
		if($form->isSubmitted()){
			if($form->get('cheque_number') != $cheque_details['Cheque_No'])
				$form->displayError('cheque_number',"This is a wrong cheque number submitted");
			if($cheque_details['Cleared_On'] != null) 
				$form->displayError('cheque_number','This cheque is already cleared');
			
			try{
				$form->api->db->beginTransaction();
				$cheque_details->ref('sales_id')->depositAmount( $cheque_details['Amount'], $form->get('cleared_date') , $cheque_details['For_Master_Emi'] );
				$cheque_details['Cleared_On']= $form->get('cleared_date');
				$cheque_details->save();
			}catch(Exception $e){
			$form->api->db->rollback();
				// $form->js()->univ()->errorMessage($e->getMessage())->execute();
				throw $e;
			}
			$form->api->db->commit();
			$form->js()->univ()->successMessage("Done")->closeExpander()->execute();
		}
	}
}