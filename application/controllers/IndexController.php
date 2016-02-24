<?php

class IndexController extends Zend_Controller_Action
{

	public function init()
	{

	}

	public function indexAction()
	{
		$wheel = new Application_Model_WheelMapper();
		$this->view->wheels = $wheel->fetchAll();
	}

}