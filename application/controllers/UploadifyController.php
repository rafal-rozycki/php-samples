<?php

class UploadifyController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{
		// action body
	}

	public function uploadAction()
	{
		$logger = new Zend_Log();
		$writer = new Zend_Log_Writer_Stream('/var/www/zend-log.txt');
		$logger->addWriter($writer);

		$logger->log($_SERVER['REQUEST_METHOD'], Zend_Log::INFO);

		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
			$targetFile = str_replace('//', '/', $targetPath) . $_FILES['Filedata']['name'];

			$logger->log($tempFile, Zend_Log::INFO);
			$logger->log($targetPath, Zend_Log::INFO);
			$logger->log($targetFile, Zend_Log::INFO);

			move_uploaded_file($tempFile, $targetFile);
			echo str_replace($_SERVER['DOCUMENT_ROOT'], '', $targetFile);
		} else {
			echo 'Need to POST';
		}


	}

}