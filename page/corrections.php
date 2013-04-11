<?php

class page_corrections extends Page {
	function init(){
		parent::init();

		// EMI DUE DATE
		

		// Payment in distributor table as per new 

	}

	function query($q) {
        $this->api->db->dsql()->expr($q)->execute();
    }
}