<?php

class Application_Model_DbTable_WheelSold extends Zend_Db_Table_Abstract
{

	protected $_name			= 'wheels_sold';
	protected $_primary			= array('id','single');
	protected $_dependentTables = array('Application_Model_DbTable_SaleType');
	protected $_referenceMap	= array(
			'Id' => array(
				'columns'		=> 'id',
				'refTableClass'	=> 'Application_Model_DbTable_Wheel',
				'refColumns'	=> 'id'
		)
	);

}