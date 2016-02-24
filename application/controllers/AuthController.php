<?php

class AuthController extends Zend_Controller_Action
{

	public function init()
	{

	}

	public function indexAction()
	{
		$fields = Utilities::getAllFields();
		$filters = array();
		$validators = array();
		$data = new Zend_Filter_Input($filters, $validators, $this->getRequest()->getParams());
		if ($this->getRequest()->isPost() && $data->isValid()) {
			if ($this->_process($data->getUnescaped('username'), $data->getUnescaped('password'))) {
				$this->_helper->redirector('index', 'index');
			}
		}
	}

	protected function _process($username, $password)
	{
		$adapter = $this->_getAuthAdapter();
		$adapter->setIdentity($username);
		$adapter->setCredential($password);
		$auth = Zend_Auth::getInstance();
		$result = $auth->authenticate($adapter);
		if ($result->isValid()) {
			$user = $adapter->getResultRowObject();
			$auth->getStorage()->write($user);
			return true;
		}
		return false;
	}

	protected function _getAuthAdapter()
	{
		$dbAdapter = Zend_Db_Table::getDefaultAdapter();
		$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
		$authAdapter->setTableName('users')
					->setIdentityColumn('username')
					->setCredentialColumn('password')
					->setCredentialTreatment('SHA1(CONCAT(?, salt))');
		return $authAdapter;
	}

	public function logoutAction()
	{
		Zend_Auth::getInstance()->clearIdentity();
		$this->_helper->redirector('index'); // back to login page
	}

}