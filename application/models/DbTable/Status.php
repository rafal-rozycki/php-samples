<?php

class Application_Model_DbTable_Status extends Zend_Db_Table_Abstract
{

	protected $_name			= 'statuses';
	protected $_referenceMap	= array(
		'Status' => array(
			'columns'		=> 'id',
			'refTableClass'	=> 'Application_Model_DbTable_Wheel',
			'refColumns'	=> 'status',
		)
	);	

}