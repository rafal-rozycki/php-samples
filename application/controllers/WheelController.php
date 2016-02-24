<?php

class WheelController extends Zend_Controller_Action
{

    public function init()
    {

    }

    public function newAction()
    {
		$wheel = new Application_Model_Wheel();
		$wheelId = 0;
		if ($this->getRequest()->isPost()) {
			$wheelMapper = new Application_Model_WheelMapper();
			$wheelId = $wheelMapper->save($wheel);
			$this->getRequest()->setParam('id', $wheelId); // Update the request with the new wheel Id
			$this->updateInfoAction();
		}
		$this->_helper->json(array('id' => $wheelId));
    }

    public function updateinfoAction()
    {
		$fields = Utilities::getAllFields();
		$data = $this->sanitizeData();
		if ($this->getRequest()->isPost() && $data->isValid()) {
			$wheel = new Application_Model_Wheel();
			$wheelMapper = new Application_Model_WheelMapper();
			$wheelMapper->find($data->id, $wheel);
			$methods = get_class_methods($wheel);
			foreach ($fields as $field) {
				$method = 'set' . Utilities::toUpperCamelCase($field);
				if (!is_null($data->$field) && in_array($method, $methods)) {
					$wheel->$method($data->getUnescaped($field));
				}
			}
			$wheelMapper->save($wheel);
			$result = array('errorcode' => '0', 'id' => $data->id);
		} else {
			$result = array('errorcode' => '1');
		}
		$this->_helper->json($result);
    }

    public function editAction()
    {
		$data = $this->sanitizeData();
		if ($data->isValid()) {
			$wheel = new Application_Model_Wheel();
			$wheelMapper = new Application_Model_WheelMapper();
			$wheelMapper->find($data->id, $wheel);
			$this->view->wheel = $wheel;
		}

	}

	public function photosAction()
	{
		$data = $this->sanitizeData();
		if ($data->isValid()) {
			$wheel = new Application_Model_Wheel();
			$wheelMapper = new Application_Model_WheelMapper();
			$wheelMapper->find($data->id, $wheel);
			$this->view->wheel = $wheel;
		}
	}

	private function sanitizeData() {
		$filters = array(
			'*'		=> 'StringTrim',
			'id'	=> 'Digits',
		);
		$validators = array();
		$data = new Zend_Filter_Input($filters, $validators, $this->getRequest()->getParams());
		return $data;
	}

}