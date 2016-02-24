<?php

class Application_Model_DbTable_SaleType extends Zend_Db_Table_Abstract
{

	protected $_name			= 'sale_types';
	protected $_referenceMap	= array(
		'SaleType' => array(
			'columns'		=> 'id',
			'refTableClass'	=> 'Application_Model_DbTable_WheelSold',
			'refColumns'	=> 'sale_type',
		)
	);

}