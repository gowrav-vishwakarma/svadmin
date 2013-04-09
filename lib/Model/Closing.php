<?php

class Model_Closing extends Model_Table {
	function init(){
		parent::init();

		$this->hasOne('Distributor','distributor_id');
		$this->addField('name')->type('date');
		$this->addField('Introduction_Amount');
		$this->addField('Level_1_Amount');
		$this->addField('Level_2_Amount');
		$this->addField('Level_3_Amount');
		$this->addField('Level_4_Amount');
		$this->addField('Level_5_Amount');
		$this->addField('Level_6_Amount');
		$this->addField('Total_Amount');
		$this->addField('Service_Charge');
		$this->addField('TDS');
		$this->addField('Net_Amount');

	}

	function do_closing($date=null){
		if($date==null) $date=date('Y-m-d');

		// Calculate Payment in distributor table

		$q="UPDATE 
				xdistributors 
			SET 
				Total_Amount = Introduction_Income + Level_1_Commission + Level_2_Commission + Level_3_Commission + Level_4_Commission + Level_5_Commission + Level_6_Commission,
				Service_Charge = 0,
				TDS = Total_Amount * 10.0 / 100.00,
				Net_Amount = Total_Amount - (Service_Charge + TDS)				
			";

		$this->query($q);

		// Save closing data in closing table
		$q="INSERT INTO xclosing 
				(
					SELECT 
						0, 
						id, 
						'$date', 
						Introduction_Income, 
						Level_1_Commission, 
						Level_2_Commission, 
						Level_3_Commission,
						Level_4_Commission,
						Level_5_Commission,
						Level_6_Commission,
						Total_Amount,
						Service_Charge,
						TDS,
						Net_Amount
				)";
		$this->query($q);

		// Reset all amount fields
		$q="UPDATE
				xdistributors
			SET
				Introduction_Income = 0, 
				Level_1_Commission = 0, 
				Level_2_Commission = 0, 
				Level_3_Commission = 0,
				Level_4_Commission = 0,
				Level_5_Commission = 0,
				Level_6_Commission = 0,
				Total_Amount = 0,
				Service_Charge = 0 ,
				TDS = 0 ,
				Net_Amount = 0
			";
		$this->query($q);

	}

	function query($q) {
        $this->api->db->dsql()->expr($q)->execute();
    }

}