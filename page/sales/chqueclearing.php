<?php
class page_sales_chqueclearing extends Page{
	function init(){
		parent::init();

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
		$grid->setModel($cheque_details,array('customer','plot','Cheque_No','Amount','Created_at','Cheque_Date','Cleared_On','Bounced_On','Bank'));
		$cheque_details = $grid->dq;
		if($_GET['filter']){
			switch($_GET['status']){
				case "Cleared":
					$cheque_details->where('Cleared_On','>=',$form->get('from_date'));
					$cheque_details->where('Cleared_On','<',$form->get('to_date'));

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
}