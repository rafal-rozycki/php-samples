<?php

class Application_Model_DbTable_WheelBought extends Zend_Db_Table_Abstract
{

	protected $_name			= 'wheels_bought';
	protected $_primary			= 'id';
	protected $_referenceMap	= array(
		'Id' => array(
			'columns'		=> 'id',
			'refTableClass'	=> 'Application_Model_DbTable_Wheel',
			'refColumns'	=> 'id'
		)
	);

}