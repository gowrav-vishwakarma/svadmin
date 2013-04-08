<?php
class View_Tree extends View{
	var $start_id;
	var $depth=5;
	function init(){
		parent::init();
	}

	function drawNode($parent_id,$id,$depth){
		if($depth == 0 ) return;

		$m=$this->add('Model_Distributor');
		$m->load($id);
		$clr=(/*$m['TotalUpgradationDeduction'] + $m['ClosingUpgradationDeduction'] >= 8000*/ true) ? "folder_green.gif" : "folder_blue.gif";
		
		// $leg_left=$this->add("Model_Distributor")->tryLoad($m['legA_id']);
		// $leg_right=$this->add("Model_Distributor")->tryLoad($m['legB_id']);
		// $leg_c=$this->add("Model_Distributor")->tryLoad($m['legA_id']);
		// $leg_d=$this->add("Model_Distributor")->tryLoad($m['legB_id']);

		$this->js(true,"addNode($id,$parent_id,'".$m['name']." [".$m['inLeg']."]', '$clr')");
		if($m['legA_id'] <> 0)
			$this->drawNode($id,$m['legA_id'],$depth-1);
		else if($depth-1 > 0)
			$this->js(true,"addNode(-${id}0001,$id,'A','question.gif')");

		if($m['legB_id'] <> 0)
			$this->drawNode($id,$m['legB_id'],$depth-1);
		else if($depth-1 > 0)
			$this->js(true,"addNode(-${id}0002,$id,'B','question.gif')");
		
		if($m['legC_id'] <> 0)
			$this->drawNode($id,$m['legC_id'],$depth-1);
		else if($depth-1 > 0)
			$this->js(true,"addNode(-${id}0002,$id,'C','question.gif')");
		
		if($m['legD_id'] <> 0)
			$this->drawNode($id,$m['legD_id'],$depth-1);
		else if($depth-1 > 0)
			$this->js(true,"addNode(-${id}0002,$id,'D','question.gif')");

		$m->unload();
		$m->destroy();
	}

	function render(){
		// $this->js(true,"addNode(-1,0,'".$a['name']."')");
		$this->drawNode(-1,$this->start_id,$this->depth);
		$this->js(true,"displayTree()");
		
		$a=$this->add('Model_Distributor');
		$a->load($this->start_id);
		$this->template->trySet('sponsor_id',$a['sponsor_id']);

		parent::render();
	}

	function defaultTemplate(){
		return array('view/tree');
	}
}