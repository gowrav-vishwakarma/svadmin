<?php

class page_plan_payouts extends Page {
	function init(){
		parent::init();
		$this->api->stickyGET('closing_name');
		$c = $this->add('Model_Closing');
        $c_q = $c->dsql();
        $c_q->del('field')->field($c->dsql()->expr('DISTINCT(name) as name'))->order('id','desc');
        $c_a = array(null=>"Select Any Closing");
        $i=1;
        foreach ($c_q as $c_name) {
            $c_a[$i++] = $c_name['name'];
        }

		$form = $this->add('Form');
		$form->addField('DropDown','closing')->setValueList($c_a)->validateNotNull();
		$form->addSubmit("Get Details");

		$closing=$this->add('Model_Closing');

		if($_GET['closing_name']){
			$closing->addCondition('name',$c_a[$_GET['closing_name']]);
		}else
			$closing->addCondition('name','is', null);

		$closing->addCondition('Total_Amount' , '>',0);

		$grid = $this->add('Grid');
		$grid->add('misc/Export');
		$grid->setModel($closing);

		if($form->isSubmitted()){
			$grid->js()->reload(array('closing_name'=>$form->get('closing')))->execute();
			$form->js()->univ()->successMessage("Hi")->execute();
		}

	}
}