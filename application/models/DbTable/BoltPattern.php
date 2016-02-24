<?php

class Application_Model_DbTable_BoltPattern extends Zend_Db_Table_Abstract
{

	protected $_name			= 'bolt_patterns';
	protected $_referenceMap	= array(
		'BoltPattern' => array(
			'columns'		=> 'id',
			'refTableClass'	=> 'Application_Model_DbTable_WheelDetail',
			'refColumns'	=> 'bolt_pattern',
		)
	);

}