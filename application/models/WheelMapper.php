<?php

// Mapper
class Application_Model_WheelMapper
{
	protected $_dbTable;

	public function setDbTable($dbTable)
	{
		if (is_string($dbTable)) {
			$dbTable = new $dbTable();
		}
		if (!$dbTable instanceof Zend_Db_Table_Abstract) {
			throw new Exception('Invalid table data gateway provided');
		}
		$this->_dbTable = $dbTable;
		return $this;
	}

	public function getDbTable()
	{
		if ($this->_dbTable === null) {
			$this->setDbTable('Application_Model_DbTable_Wheel');
		}
		return $this->_dbTable;
	}

	public function save(Application_Model_Wheel $wheel)
	{
		if (($id = $wheel->getId()) === null) {
			$newWheelId = (int) $this->getDbTable()->insert(array());
			$this->setDbTable('Application_Model_DbTable_WheelDetail');
			$this->getDbTable()->insert(array('id' => $newWheelId));
			$this->setDbTable('Application_Model_DbTable_WheelBought');
			$this->getDbTable()->insert(array('id' => $newWheelId));
			return $newWheelId;
		} else {
			// Organize the info
			$wheelArray = $wheel->toArray();
			$wheelArrayBought = array();
			$wheelArraySold = array();
			foreach($wheelArray as $key => $value) {
				if (strpos($key, 'bought_') === 0) {
					$wheelArrayBought[str_replace('bought_', '', $key)] = $value;
				}
			}
			foreach($wheelArray as $key => $value) {
				if (strpos($key, 'sold_') === 0) {
					$wheelArraySold[str_replace('sold_', '', $key)] = $value;
				}
			}
			// Get all rows
			$currentWheel = $this->getDbTable()->find($id)->current();
			$currentWheelDetail = $currentWheel->findDependentRowset('Application_Model_DbTable_WheelDetail')->current();
			$currentWheelBoltPattern = $currentWheelDetail->findDependentRowset('Application_Model_DbTable_BoltPattern')->current();
			$currentWheelBought = $currentWheel->findDependentRowset('Application_Model_DbTable_WheelBought')->current();
			$currentWheelSold = $currentWheel->findDependentRowset('Application_Model_DbTable_WheelSold')->current();
			// Set them from the wheel object passed in
			$currentWheel->setFromArray($wheelArray);
			$currentWheel->save();
			$currentWheelDetail->setFromArray($wheelArray);
			$currentWheelDetail->save();
			$currentWheelBought->setFromArray($wheelArrayBought);
			$currentWheelBought->save();
			if ($currentWheelSold) {
				$currentWheelSold->setFromArray($wheelArraySold);
				$currentWheelSold->save();
			}
			// Return id
			return $id;
		}
	}

	public function find($id, Application_Model_Wheel $wheel)
	{
		$currentWheel = $this->getDbTable()->find($id)->current();
		$currentWheelArray = $currentWheel->toArray();
		$wheel->setOptions($currentWheelArray);
		$currentWheelStatus = $currentWheel->findDependentRowset('Application_Model_DbTable_Status')->current();
		if ($currentWheelStatus) {
			$currentWheelStatusArray = $currentWheelStatus->toArray();
			$wheel->setStatusDescription($currentWheelStatusArray['description']);
		}

		$currentWheelDetail = $currentWheel->findDependentRowset('Application_Model_DbTable_WheelDetail')->current();
		if ($currentWheelDetail) {
			$currentWheelDetailArray = $currentWheelDetail->toArray();
			$wheel->setOptions($currentWheelDetailArray);
			$currentWheelBoltPattern = $currentWheelDetail->findDependentRowset('Application_Model_DbTable_BoltPattern')->current();
			if ($currentWheelBoltPattern) {
				$currentWheelBoltPatternArray = $currentWheelBoltPattern->toArray();
				$wheel->setBoltPatternDescription($currentWheelBoltPatternArray['description']);
			}
		}

		$currentWheelBought = $currentWheel->findDependentRowset('Application_Model_DbTable_WheelBought')->current();
		$currentWheelBoughtArray = $currentWheelBought->toArray();
		foreach($currentWheelBoughtArray as $key => $value) {
			$currentWheelBoughtArray['bought_' . $key] = $value;
			unset($currentWheelBoughtArray[$key]);
		}
		$wheel->setOptions($currentWheelBoughtArray);

		$wheelSoldRowset = $currentWheel->findDependentRowset('Application_Model_DbTable_WheelSold');
		foreach ($wheelSoldRowset as $id => $currentWheelSold) {
			$currentWheelSoldArray = $currentWheelSold->toArray();
			$singleId = (int) $currentWheelSoldArray['single'];
			foreach($currentWheelSoldArray as $key => $value) {
				$currentWheelSoldArray['sold_' . $key] = $value;
				unset($currentWheelSoldArray[$key]);
			}
			$currentWheelSaleType = $currentWheelSold->findDependentRowset('Application_Model_DbTable_SaleType')->current();
			$currentWheelSaleTypeArray = $currentWheelSaleType->toArray();
			$wheelSold = new Application_Model_WheelSold();
			$wheelSold->setOptions($currentWheelSoldArray);
			$wheelSold->setSoldSaleTypeDescription($currentWheelSaleTypeArray['description']);
			$wheel->setWheelSold($singleId, $wheelSold);
		}
	}

	public function fetchAll()
	{
		$resultSet = $this->getDbTable()->fetchAll(null, 'id DESC');
		$wheels = array();
		foreach ($resultSet as $row) {
			$wheel = new Application_Model_Wheel();
			$wheel->setOptions($row->toArray());
			$wheel->setStatusDescription(Utilities::getStatus($wheel->getStatus()));
			$wheels[] = $wheel;
		}
		return $wheels;
	}

	public function fetchUnsold()
	{
		$resultSet = $this->getDbTable()->fetchAll(null, 'id DESC');
		$wheels = array();
		foreach ($resultSet as $row) {
			$wheel = new Application_Model_Wheel();
			$wheel->setOptions($row->toArray());
			if ($wheel->getTitle()) {
				$wheels[] = $wheel;
			}
		}
		return $wheels;
	}
}

