<?php

class Utilities
{

	public static function getWebsiteUrl() {
		if (APPLICATION_ENV == 'development') {
			return 'http://192.168.2.99/factory-wheels.www/public/';
		} else {
			return 'http://www.factory-wheels.com/';
		}
	}

	public static function getAdminUrl() {
		if (APPLICATION_ENV == 'development') {
			return 'http://192.168.2.99/factory-wheels.admin/public/';
		} else {
			return 'http://admin.factory-wheels.com/';
		}
	}

	public static function getImagesUrl() {
		if (APPLICATION_ENV == 'development') {
			return 'http://192.168.2.99/factory-wheels.images/';
		} else {
			return 'http://images.factory-wheels.com/';
		}
	}

	public static function getImagesSrcPrefix() {
		if (APPLICATION_ENV == 'development') {
			return '/factory-wheels.images';
		} else {
			return '';
		}
	}

	// "this_method_name" -> "ThisMethodName"
	public static function toUpperCamelCase($string) {
		return preg_replace('/(?:^|_)(.?)/e',"strtoupper('$1')",$string);
	}

	// "this_method_name" -> "thisMethodName"
	public static function toLowerCamelCase($string) {
		return preg_replace('/_(.?)/e',"strtoupper('$1')",$string);
	}

	// "thisMethodName" -> "this_method_name", "ThisMethodName" -> "this_method_name"
	public static function toLowerUnderscored($string) {
		return strtolower(preg_replace('/([^A-Z])([A-Z])/', "$1_$2", $string));
	}

	public static function getDiameters() {
		$cache = Zend_Registry::get('cache');
		if (!$result = $cache->load('diameter')) {
			$result = array(14, 15, 16, 17, 18, 19, 20, 21, 22, 24);
			$cache->save($result, 'diameter');
		}
		return $result;
	}

	public static function getWidths() {
		$cache = Zend_Registry::get('cache');
		if (!$result = $cache->load('width')) {
			$result = array(4, 4.5, 5, 5.5, 6, 6.5, 7, 7.5, 8, 8.5, 9, 9.5, 10, 10.5, 11, 11.5, 12, 12.5, 13);
			$cache->save($result, 'width');
		}
		return $result;
	}

	public static function getTireWidths() {
		$cache = Zend_Registry::get('cache');
		if (!$result = $cache->load('tire_width')) {
			$result = array(145, 155, 165, 175, 185, 195, 205, 215, 225, 235, 245, 255, 265, 275, 285, 295, 305, 315, 325, 335, 345);
			$cache->save($result, 'tire_width');
		}
		return $result;
	}

	public static function getTireSidewalls() {
		$cache = Zend_Registry::get('cache');
		if (!$result = $cache->load('tire_sidewall')) {
			$result = array(20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75);
			$cache->save($result, 'tire_sidewall');
		}
		return $result;
	}
	
	public static function getBoltPatterns() {
		$cache = Zend_Registry::get('cache');
		if (!$result = $cache->load('bolt_pattern')) {
			$result = array();
			$boltPatterns = new Application_Model_DbTable_BoltPattern();
			$select = $boltPatterns->select()->order('id');
			$rows = $boltPatterns->fetchAll($select);
			foreach ($rows as $row) {
				$result[$row->id] = $row->description;
			}
			natsort($result);
			$cache->save($result, 'bolt_pattern');
		}
		return $result;
	}
	
	public static function getBoltPattern($id) {
		$boltPatterns = Utilities::getBoltPatterns();
		return $boltPatterns[$id];
	}	
	
	public static function getSaleTypes() {
		$cache = Zend_Registry::get('cache');
		if (!$result = $cache->load('sale_type')) {
			$result = array();
			$saleTypes = new Application_Model_DbTable_SaleType();
			$select = $saleTypes->select()->order('order_by');
			$rows = $saleTypes->fetchAll($select);
			foreach ($rows as $row) {
				$result[$row->id] = $row->description;
			}
			$cache->save($result, 'sale_type');
		}
		return $result;
	}

	public static function getSaleType($id) {
		$saleTypes = Utilities::getSaleTypes();
		return $saleTypes[$id];
	}
	
	public static function getStatuses() {
		$cache = Zend_Registry::get('cache');
		if (!$result = $cache->load('status')) {
			$result = array();
			$statuses = new Application_Model_DbTable_Status();
			$select = $statuses->select()->order('order_by');
			$rows = $statuses->fetchAll($select);
			foreach ($rows as $row) {
				$result[$row->id] = $row->description;
			}
			$cache->save($result, 'status');
		}
		return $result;
	}

	public static function getStatus($id) {
		$statuses = Utilities::getStatuses();
		return $statuses[$id];
	}

	public static function getAllFields() {
		$result = array();
		$fieldGroups = explode(',', Constants::FIELD_GROUPS);
		foreach ($fieldGroups as $fieldGroup) {
			$fieldList = explode(',', constant('Constants::' . $fieldGroup . '_FIELDS'));
			foreach ($fieldList as $field) {
				$result[] = $field;
			}
		}
		return $result;
	}

}