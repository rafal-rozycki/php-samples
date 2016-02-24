<?php

class Application_Model_DbTable_Wheel extends Zend_Db_Table_Abstract
{

	protected $_name			= 'wheels';
	protected $_primary			= 'id';
	protected $_dependentTables = array('Application_Model_DbTable_Status','Application_Model_DbTable_WheelDetail','Application_Model_DbTable_WheelBought','Application_Model_DbTable_WheelSold');

}