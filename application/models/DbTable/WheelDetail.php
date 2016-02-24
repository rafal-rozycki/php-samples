<?php

class Application_Model_DbTable_WheelDetail extends Zend_Db_Table_Abstract
{

	protected $_name			= 'wheels_detail';
	protected $_primary			= 'id';
	protected $_dependentTables	= array('Application_Model_DbTable_BoltPattern');
	protected $_referenceMap	= array(
		'Id' => array(
			'columns'		=> 'id',
			'refTableClass'	=> 'Application_Model_DbTable_Wheel',
			'refColumns'	=> 'id'
		)
	);

}
