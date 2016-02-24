<?php

class Application_Model_Wheel
{
	protected $_id;

	protected $_name;
	protected $_status;
	protected $_status_description;
	protected $_needs_work;
	protected $_title;
	protected $_subtitle;
	protected $_folder;
	protected $_published;
	protected $_price;
	protected $_paypal_button_id;
	protected $_ebay_auction_id;
	protected $_ebay_start_time;
	protected $_ebay_end_time;
	protected $_photos;
	protected $_photos_array;
	protected $_photos_edited;
	protected $_notes;

	protected $_ship_weight;
	protected $_ship_length;
	protected $_ship_width;
	protected $_ship_height;
	protected $_bolt_pattern;
	protected $_bolt_pattern_description;
	protected $_part_number;
	protected $_part_number_rear;
	protected $_part_number_hollander;
	protected $_part_number_hollander_rear;
	protected $_front_diameter;
	protected $_front_width;
	protected $_front_offset;
	protected $_front_tire_width;
	protected $_front_tire_sidewall;
	protected $_front_tire_depth;
	protected $_front_tire_depth_percent;
	protected $_rear_diameter;
	protected $_rear_width;
	protected $_rear_offset;
	protected $_rear_tire_width;
	protected $_rear_tire_sidewall;
	protected $_rear_tire_depth;
	protected $_rear_tire_depth_percent;
	protected $_tire_description;
	protected $_tire_production_dates;
	protected $_mileage;
	protected $_tpms;
	protected $_center_caps;
	protected $_description;

	protected $_bought_date;
	protected $_bought_price;
	protected $_bought_name;
	protected $_bought_email;
	protected $_bought_address;
	protected $_bought_phone;

	protected $_wheels_sold = array();

	public function __construct(array $options = null)
	{
		if (is_array($options)) {
			$this->setOptions($options);
		}
	}
	public function __set($name, $value)
	{
		$method = 'set' . $name;
		if (!method_exists($this, $method)) {
			throw new Exception('Invalid wheel property');
		}
		$this->$method($value);
	}
	public function __get($name)
	{
		$method = 'get' . $name;
		if (!method_exists($this, $method)) {
			throw new Exception('Invalid wheel property');
		}
		return $this->$method();
	}
	public function setOptions(array $options)
	{
		$methods = get_class_methods($this);
		foreach ($options as $key => $value) {
			$method = 'set' . Utilities::toUpperCamelCase($key);
			if (in_array($method, $methods)) {
				$this->$method($value);
			}
		}
		return $this;
	}
	public function toArray() {
		$result = array();
		$methods = get_class_methods($this);
		foreach ($methods as $method) {
			if (substr($method, 0, 3) == 'get' && $method != 'getWheelSold') {
				$fieldName = Utilities::toLowerUnderscored(substr($method, 3));
				$result[$fieldName] = $this->$method();
			}
		}
		return $result;
	}
	public function getWheelsSold() {
		return $this->_wheels_sold;
	}
	public function getWheelSold($id) {
		return $this->_wheels_sold[$id];
	}
	public function setWheelSold($id, $wheelSold) {
		$this->_wheels_sold[$id] = $wheelSold;
		return $this;
	}
	public function getId()
	{
		return $this->_id;
	}
	public function setId($id)
	{
		$this->_id = (int) $id;
		return $this;
	}

	public function getSingles() {
		return count(json_decode($this->_photos))-1;
	}
	public function getNumPhotos($wheelNumber = 0) {
		$numPhotos = json_decode($this->_photos);
		return $numPhotos[$wheelNumber];
	}

	// wheels
	public function getName()
	{
		return $this->_name;
	}
	public function setName($name)
	{
		$this->_name = (string) $name;
		return $this;
	}
	public function getStatus()
	{
		return $this->_status;
	}
	public function setStatus($status)
	{
		$this->_status = (int) $status;
		return $this;
	}
	public function getStatusDescription()
	{
		return $this->_status_description;
	}
	public function setStatusDescription($status_description)
	{
		$this->_status_description = (string) $status_description;
		return $this;
	}
	public function getNeedsWork()
	{
		return $this->_needs_work;
	}
	public function setNeedsWork($needs_work)
	{
		if (!is_null($needs_work)) {
			$this->_needs_work = (boolean) $needs_work;
		}
		return $this;
	}	
	public function getTitle()
	{
		return $this->_title;
	}
	public function setTitle($title)
	{
		$this->_title = (string) $title;
		return $this;
	}
	public function getSubtitle()
	{
		return $this->_subtitle;
	}
	public function setSubtitle($subtitle)
	{
		$this->_subtitle = (string) $subtitle;
		return $this;
	}
	public function getFolder()
	{
		return $this->_folder;
	}
	public function setFolder($folder)
	{
		$this->_folder = (string) $folder;
		return $this;
	}
	public function getPublished()
	{
		return $this->_published;
	}
	public function setPublished($published)
	{
		if (!is_null($published)) {
			$this->_published = (boolean) $published;
		}
		return $this;
	}
	public function getPrice()
	{
		return $this->_price;
	}
	public function setPrice($price)
	{
		$this->_price = (float) $price;
		return $this;
	}
	public function getPaypalButtonId()
	{
		return $this->_paypal_button_id;
	}
	public function setPaypalButtonId($paypal_button_id)
	{
		$this->_paypal_button_id = (string) $paypal_button_id;
		return $this;
	}
	public function getEbayAuctionId()
	{
		return $this->_ebay_auction_id;
	}
	public function setEbayAuctionId($ebay_auction_id)
	{
		$this->_ebay_auction_id = (string) $ebay_auction_id;
		return $this;
	}
	public function getEbayStartTime()
	{
		return $this->_ebay_start_time;
	}
	public function setEbayStartTime($ebay_start_time)
	{
		if (!is_null($ebay_start_time)) {
			$this->_ebay_start_time = (string) $ebay_start_time;
		}
		return $this;
	}
	public function getEbayEndTime()
	{
		return $this->_ebay_end_time;
	}
	public function setEbayEndTime($ebay_end_time)
	{
		if (!is_null($ebay_end_time)) {
			$this->_ebay_end_time = (string) $ebay_end_time;
		}
		return $this;
	}
	public function getPhotos()
	{
		return $this->_photos;
	}
	public function setPhotos($photos)
	{
		$this->_photos = (string) $photos;
		return $this;
	}
	public function getPhotosArray()
	{
		return $this->_photos_array;
	}
	public function setPhotosArray($photos_array)
	{
		$this->_photos_array = (string) $photos_array;
		return $this;
	}
	public function getNotes()
	{
		return $this->_notes;
	}
	public function setNotes($notes)
	{
		$this->_notes = (string) $notes;
		return $this;
	}

	// wheels_detail
	public function getShipWeight()
	{
		return $this->_ship_weight;
	}
	public function setShipWeight($ship_weight)
	{
		$this->_ship_weight = (int) $ship_weight;
		return $this;
	}
	public function getShipLength()
	{
		return $this->_ship_length;
	}
	public function setShipLength($ship_length)
	{
		$this->_ship_length = (int) $ship_length;
		return $this;
	}
	public function getShipWidth()
	{
		return $this->_ship_width;
	}
	public function setShipWidth($ship_width)
	{
		$this->_ship_width = (int) $ship_width;
		return $this;
	}
	public function getShipHeight()
	{
		return $this->_ship_height;
	}
	public function setShipHeight($ship_height)
	{
		$this->_ship_height = (int) $ship_height;
		return $this;
	}
	public function getBoltPattern()
	{
		return $this->_bolt_pattern;
	}
	public function setBoltPattern($bolt_pattern)
	{
		$this->_bolt_pattern = (int) $bolt_pattern;
		return $this;
	}
	public function getBoltPatternDescription()
	{
		return $this->_bolt_pattern_description;
	}
	public function setBoltPatternDescription($bolt_pattern_description)
	{
		$this->_bolt_pattern_description = (string) $bolt_pattern_description;
		return $this;
	}
	public function getPartNumber()
	{
		return $this->_part_number;
	}
	public function setPartNumber($part_number)
	{
		$this->_part_number = (string) $part_number;
		return $this;
	}
	public function getPartNumberRear()
	{
		return $this->_part_number_rear;
	}
	public function setPartNumberRear($part_number_rear)
	{
		$this->_part_number_rear = (string) $part_number_rear;
		return $this;
	}	
	public function getPartNumberHollander()
	{
		return $this->_part_number_hollander;
	}
	public function setPartNumberHollander($part_number_hollander)
	{
		$this->_part_number_hollander = (string) $part_number_hollander;
		return $this;
	}	
	public function getPartNumberHollanderRear()
	{
		return $this->_part_number_hollander_rear;
	}
	public function setPartNumberHollanderRear($part_number_hollander_rear)
	{
		$this->_part_number_hollander_rear = (string) $part_number_hollander_rear;
		return $this;
	}	
	public function getFrontDiameter()
	{
		return $this->_front_diameter;
	}
	public function setFrontDiameter($front_diameter)
	{
		$this->_front_diameter = (int) $front_diameter;
		return $this;
	}
	public function getFrontWidth()
	{
		return $this->_front_width;
	}
	public function setFrontWidth($front_width)
	{
		$this->_front_width = (float) $front_width;
		return $this;
	}
	public function getFrontOffset()
	{
		return $this->_front_offset;
	}
	public function setFrontOffset($front_offset)
	{
		if (is_null($front_offset) || $front_offset == '') {
			$this->_front_offset = NULL;
		} else {
			$this->_front_offset = (int) $front_offset;
		}
		return $this;
	}
	public function getFrontTireWidth()
	{
		return $this->_front_tire_width;
	}
	public function setFrontTireWidth($front_tire_width)
	{
		$this->_front_tire_width = (int) $front_tire_width;
		return $this;
	}
	public function getFrontTireSidewall()
	{
		return $this->_front_tire_sidewall;
	}
	public function setFrontTireSidewall($front_tire_sidewall)
	{
		$this->_front_tire_sidewall = (int) $front_tire_sidewall;
		return $this;
	}
	public function getFrontTireDepth()
	{
		if ($this->_front_tire_depth == 0) {
			return '';
		} else {
			return $this->_front_tire_depth;
		}
	}
	public function setFrontTireDepth($front_tire_depth)
	{
		$this->_front_tire_depth = (int) $front_tire_depth;
		return $this;
	}
	public function getFrontTireDepthPercent()
	{
		if ($this->_front_tire_depth_percent == 0) {
			return '';
		} else {
			return $this->_front_tire_depth_percent;
		}
	}
	public function setFrontTireDepthPercent($front_tire_depth_percent)
	{
		$this->_front_tire_depth_percent = (int) $front_tire_depth_percent;
		return $this;
	}
	public function getRearDiameter()
	{
		return $this->_rear_diameter;
	}
	public function setRearDiameter($rear_diameter)
	{
		$this->_rear_diameter = (int) $rear_diameter;
		return $this;
	}
	public function getRearWidth()
	{
		return $this->_rear_width;
	}
	public function setRearWidth($rear_width)
	{
		$this->_rear_width = (float) $rear_width;
		return $this;
	}
	public function getRearOffset()
	{
		return $this->_rear_offset;
	}
	public function setRearOffset($rear_offset)
	{
		if (is_null($rear_offset) || $rear_offset == '') {
			$this->_rear_offset = NULL;
		} else {
			$this->_rear_offset = (int) $rear_offset;
		}
		return $this;
	}
	public function getRearTireWidth()
	{
		return $this->_rear_tire_width;
	}
	public function setRearTireWidth($rear_tire_width)
	{
		$this->_rear_tire_width = (int) $rear_tire_width;
		return $this;
	}
	public function getRearTireSidewall()
	{
		return $this->_rear_tire_sidewall;
	}
	public function setRearTireSidewall($rear_tire_sidewall)
	{
		$this->_rear_tire_sidewall = (int) $rear_tire_sidewall;
		return $this;
	}
	public function getRearTireDepth()
	{
		if ($this->_rear_tire_depth == 0) {
			return '';
		} else {
			return $this->_rear_tire_depth;
		}		
	}
	public function setRearTireDepth($rear_tire_depth)
	{
		$this->_rear_tire_depth = (int) $rear_tire_depth;
		return $this;
	}
	public function getRearTireDepthPercent()
	{
		if ($this->_rear_tire_depth_percent == 0) {
			return '';
		} else {
			return $this->_rear_tire_depth_percent;
		}
	}
	public function setRearTireDepthPercent($rear_tire_depth_percent)
	{
		$this->_rear_tire_depth_percent = (int) $rear_tire_depth_percent;
		return $this;
	}	
	public function getTireDescription()
	{
		return $this->_tire_description;
	}
	public function setTireDescription($tire_description)
	{
		$this->_tire_description = (string) $tire_description;
		return $this;
	}
	public function getTireProductionDates()
	{
		return $this->_tire_production_dates;
	}
	public function setTireProductionDates($tire_production_dates)
	{
		$this->_tire_production_dates = (string) $tire_production_dates;
		return $this;
	}	
	public function getMileage()
	{
		return $this->_mileage;
	}
	public function setMileage($mileage)
	{
		$this->_mileage = (int) $mileage;
		return $this;
	}
	public function getTpms()
	{
		return $this->_tpms;
	}
	public function setTpms($tpms)
	{
		if (!is_null($tpms)) {
			$this->_tpms = (boolean) $tpms;
		}
		return $this;
	}
	public function getCenterCaps()
	{
		return $this->_center_caps;
	}
	public function setCenterCaps($center_caps)
	{
		if (!is_null($center_caps)) {
			$this->_center_caps = (boolean) $center_caps;
		}
		return $this;
	}
	public function getDescription()
	{
		return $this->_description;
	}
	public function setDescription($tpms)
	{
		$this->_description = (string) $tpms;
		return $this;
	}

	// wheels_bought
	public function getBoughtDate()
	{
		return $this->_bought_date;
	}
	public function setBoughtDate($bought_date)
	{
		$this->_bought_date = (string) $bought_date;
		return $this;
	}
	public function getBoughtPrice()
	{
		return $this->_bought_price;
	}
	public function setBoughtPrice($bought_price)
	{
		$this->_bought_price = (float) $bought_price;
		return $this;
	}
	public function getBoughtName()
	{
		return $this->_bought_name;
	}
	public function setBoughtName($bought_name)
	{
		$this->_bought_name = (string) $bought_name;
		return $this;
	}
	public function getBoughtEmail()
	{
		return $this->_bought_email;
	}
	public function setBoughtEmail($bought_email)
	{
		$this->_bought_email = (string) $bought_email;
		return $this;
	}
	public function getBoughtAddress()
	{
		return $this->_bought_address;
	}
	public function setBoughtAddress($bought_address)
	{
		$this->_bought_address = (string) $bought_address;
		return $this;
	}
	public function getBoughtPhone()
	{
		return $this->_bought_phone;
	}
	public function setBoughtPhone($bought_phone)
	{
		$this->_bought_phone = (string) $bought_phone;
		return $this;
	}

}