<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected function _initDoctype()
	{
		$this->bootstrap('view');
		$view = $this->getResource('view');
		$view->doctype('XHTML1_STRICT');
	}

	protected function _initCache()
	{
		$frontend = array('lifetime' => 7200, 'automatic_serialization' => true);
		$backend = array();
		$cache = Zend_Cache::factory('core', 'File', $frontend, $backend);
		Zend_Registry::set('cache', $cache);
	}

}