<?php
class page_masters_plannigs extends Page{
	function init(){
		parent::init();

		if($_GET['manage_plot']){
			$this->api->redirect('masters_plots',array('planning_id'=>$_GET['manage_plot']))->execute();;
		}


		$crud=$this->add('CRUD');
		$crud->SetModel('Planning');

		If(!$crud->isEditing()){
				$crud->grid->addColumn('Button','manage_plot');
		}

	}
}