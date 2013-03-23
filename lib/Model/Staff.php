<?php
class Model_Staff extends xavoc_acl\Model_ACLUser{
	var $table="users";
	function init(){
		parent::init();

		$this->addField('name');
		$this->addField('username');
		$this->addField('password');
		$this->addField('created_on')->defaultValue(date('Y-m-d H:i:s'))->type('date(format)');
		$this->addField('designation');
		$this->addField('is_active')->defaultValue(true)->type('boolean');
		$this->addField('is_system_admin')->defaultValue(true)->type('boolean');
		}
}