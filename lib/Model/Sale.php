<?php
class Model_Sale extends Model_Table{
	var $table ="xsales";

	function init() {
		parent::init();
		$this->hasOne( 'Plot', 'plot_id' )->mandatory( "This is a Mandatory Field" );
		$this->hasOne( 'Customer', 'customer_id' )->mandatory( "This is a Mandatory Field" );
		$this->hasOne( 'Agent', 'agent_id' )->mandatory( "This is a Mandatory Field" );
		$this->addField( 'RatePerSqUnit' )->mandatory( "This is a Mandatory Field" )->caption( "Rate/sqUnit" );
		$this->addField( 'salespolicy_name' )->mandatory( "This Field is Required" )->caption( "sales policy" );
		$this->addField( 'down_payment' )->mandatory( "This Field is Required" );
		$this->addField( 'total_cost' )->mandatory( "This Field is Required" );
		$this->addField( 'emi_pattern' )->type( 'text' )->mandatory( "This Field is Required" );
		$this->addField( 'emi_mode' )->mandatory( "This Field is Required" );
		$this->addField( 'master_emi' )->mandatory( "This Field is Required" );
		$this->addField( 'no_of_master_emi' )->mandatory( "This Field is Required" )->caption( "NoOfMasterEMI" );
		$this->addField( 'master_emi_mode' )->enum( array( 'Half-Yearly', "Yearly" ) )->mandatory( "This Field is Required" );
		$this->addField( 'direct_commission_to_agent' )->mandatory( "This Field is Required" )->caption( "Direct Commision" );
		$this->addField( 'emi_commission_to_agent' )->mandatory( "This Field is Required" )->caption( "Emi Commission" );
		$this->addField( 'down_payment_submitted' )->mandatory( "This Field is Required" );
		$this->addField( 'sales_date' )->type('date')->defaultValue(date('Y-m-d'));
		$this->addField( 'is_current' )->type('boolean')->defaultValue(true);
		$this->addField( 'Name_Of_Nominee' )->mandatory( "This Field is Required" );
		$this->addField( 'Relation_With_Applicant' )->mandatory( "This Field is Required" );
		$this->addField( 'Nominee_PAN_NO' )->mandatory( "This Field is Required" );
		$this->addField( 'Nominee_Age' )->mandatory( "This Field is Required" );
		$this->addField( 'Nominee_Address' )->mandatory( "This Field is Required" );

		$this->hasMany( 'Emi', 'sales_id' );
		$this->hasMany( 'Deposite', 'sales_id' );
		$this->hasMany( 'ChequeDetails', 'sales_id' );

		$this->addExpression( "name" )->set( function ( $m, $q ) {
				return $m->dsql()->expr( 'concat([plot]," ",[customer])' )
				->setCustom( 'plot', $m->refSQL( 'plot_id' )->fieldQuery( 'name' ) )
				->setCustom( 'customer', $m->refSQL( 'customer_id' )->fieldQuery( 'name' ) )
				;
			} );

		$this->addHook( 'beforeSave', $this );

	}

	function beforeSave() {
		$this->validate();
	}

	function validate() {

		$calculated_cost=$this['down_payment'];

		$calculated_cost += $this['master_emi']* $this['no_of_master_emi'];

		foreach ( explode( ';', $this['emi_pattern'] ) as $pattern ) {
			$tmp=explode( "x", $pattern );
			$calculated_cost += ( $tmp[0]*$tmp[1] );
		}

		if ( $this['total_cost'] != $calculated_cost )
			throw $this->exception( "Total Cost is not Equal to calculated emi pattern ".$this['total_cost']."calculated_cost" .$calculated_cost );
	}

	function create_emis( $emistartdate ) {
		switch ( $this['emi_mode'] ) {
		case "Yearly":
			$toAdd = " +1 year";
			$YearlyMasterEmiAfterEntries = 1;
			break;
		case "Half-Yearly":
			$toAdd = " +6 month";
			$YearlyMasterEmiAfterEntries = 2;
			break;
		case "Quarterly":
			$toAdd = " +3 month";
			$YearlyMasterEmiAfterEntries = 4;
			break;
		default:
		case "Monthly":
			$toAdd = " +1 month";
			$YearlyMasterEmiAfterEntries = 12;
			break;
		case "Fortnightly":
			$toAdd = " +15 day";
			$YearlyMasterEmiAfterEntries = 24;
			break;
		}

		if ( $this['master_emi_mode'] == 'Half-Yearly' ) {
			$YearlyMasterEmiAfterEntries = $YearlyMasterEmiAfterEntries / 2;
			if ( $this['emi_mode'] == "Yearly" )
				throw $this->exception( "This is not possible to submit Master Emi every half-year while emis are set Yearly" );
		}

		$today=$emistartdate;
		$nextDate = $today;//date( "Y-m-d", strtotime( date( "Y-m-d", strtotime( $today ) ) . $toAdd ) );
		foreach ( explode( ';', $this['emi_pattern'] ) as $pattern ) {
			$tmp=explode( 'x', $pattern );
			for ( $i=1;$i<=$tmp[1];$i++ ) {

				$emi=$this->add( 'Model_Emi' );
				$emi['due_date']= $nextDate;
				$emi['paid_date']=null;
				$emi['EMIAmount']=$tmp[0];
				$emi['AmountPaid']=0;
				$emi['sales_id']=$this->id;
				$emi->save();

				if ( $i % $YearlyMasterEmiAfterEntries == 0 ) {
					$emi=$this->add( 'Model_Emi' );
					$emi['due_date']= $nextDate;
					$emi['paid_date']=null;
					$emi['EMIAmount']=$this['master_emi'];
					$emi['AmountPaid']=0;
					$emi['sales_id']=$this->id;
					$emi['is_master_emi']=true;
					$emi->save();
				}

				$today = $nextDate;
				$nextDate = $nextDate = date( "Y-m-d", strtotime( date( "Y-m-d", strtotime( $today ) ) . $toAdd ) );
			}
		}
	}

	function depositAmount( $AmountPaid, $date=null, $adjustMasterEmiFirst=false ) {
		if ( $date==null ) $date = date( 'Y-m-d' );

		$deposit = $this->add( 'Model_Deposite');
		$deposit['sales_id']=$this->id;
		$deposit['Amount']=$AmountPaid;
		$deposit['paid_date']=$date;
		$deposit->save();

		//+++ If first deposit is done right above and plot is sold in EMMIPlan give IntroducerIncome to Introducer
		if($this->ref('Deposite')->count()->getOne() ==1 and $this->ref('plot_id')->get( 'status' ) == 'EMISold'){
			$distributor = $this->ref('customer_id')->ref('Distributor')->tryLoadANy();
			$introducer = $distributor->ref('introducer_id');
			if($introducer->loaded()){
				if(strpos("%",$this['direct_commission_to_agent']) !== false) throw $this->exception('This sales policy contain % sign in direct agent commisison, This Sales Policy is made for Direct Sale and cannot be used for EMIplan sale');
				$introducer['Introduction_Income'] = $introducer['Introduction_Income'] + $this['direct_commission_to_agent'];
				$introducer->save();
			}
		}

		if($adjustMasterEmiFirst){
			//+++ NO COMMISSION IS ALLOTED FOR MASTER EMI's
			$emi=$this->ref( 'Emi' )
					->addCondition('is_master_emi',true)
					->addCondition('AmountPaid',0)
					->tryLoadAny();
			if($AmountPaid < $emi['EMIAmount']) throw $this->exception('Master EMI cannot be adjusted, requirs '. $emi['EMIAmount']. " Rs minimum");
			$emi['AmountPaid'] = $emi['EMIAmount'];
			$emi['paid_date']=$date;
			$AmountPaid -= $emi['AmountPaid'];
			$emi->saveAs('Emi');
		}

		if ( ( $this['down_payment'] - $this['down_payment_submitted'] ) > $AmountPaid ) {
			$amount_for_downpayment = $AmountPaid;
			$amount_for_emi=0;
		}else {
			$amount_for_downpayment = $this['down_payment'] - $this['down_payment_submitted'];
			$amount_for_emi = $AmountPaid - $amount_for_downpayment;
		}

		//+++ Down Payment for DIrect Sale is directly submitted here 
		$this['down_payment_submitted'] = $this['down_payment_submitted'] + $amount_for_downpayment;
		$this->save();

		//+++ Distributor Agent Commission here for DIRECT Sale for EMIPlan it is in emai->pay()
		if ( $this['agent_id'] and $amount_for_downpayment > 0 )
			$this->ref( 'agent_id' )->payCommission( $this, $deposit, $amount_for_downpayment, 'downpayment' );

		if ( $amount_for_emi == 0 ) return;

		foreach ( $emi=$this->ref( 'Emi' )->addCondition('is_master_emi',false) as $junk ) {
			if ( ( $emi['EMIAmount']-$emi['AmountPaid'] ) > $amount_for_emi ) {
				$amount_for_this_emi = $amount_for_emi;
			}else {
				$amount_for_this_emi = $emi['EMIAmount']-$emi['AmountPaid'];
			}

			$emi->pay( $amount_for_this_emi, $date );

			//+++ Distributor Agent Commission here for DIRECT Sale for EMIPlan it is in emai->pay()
			if ( $this['agent_id'] )
				$this->ref( 'agent_id' )->payCommission( $this, $deposit, $amount_for_this_emi, 'emi' , $emi['EMIAmount'] );

			$amount_for_emi = $amount_for_emi - $amount_for_this_emi;
			if ( $amount_for_emi == 0 ) break;
		}

	}
}
