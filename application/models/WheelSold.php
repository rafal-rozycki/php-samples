<?php

class Application_Model_WheelSold
{
	protected $_id;

	protected $_sold_single;
	protected $_sold_date;
	protected $_sold_price;
	protected $_sold_name;
	protected $_sold_ebay_id;
	protected $_sold_email;
	protected $_sold_address;
	protected $_sold_phone;
	protected $_sold_sale_type;
	protected $_sold_sale_type_description;
	protected $_sold_paypal_fees;
	protected $_sold_paypal_transaction_id;
	protected $_sold_ebay_fees;
	protected $_sold_ebay_fees_verify;
	protected $_sold_ebay_auction_id;
	protected $_sold_shipping_cost;
	protected $_sold_shipping_cost_verify;
	protected $_sold_tracking_info;

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
			if (substr($method, 0, 3) == 'get') {
				$fieldName = Utilities::toLowerUnderscored(substr($method, 3));
				$result[$fieldName] = $this->$method();
			}
		}
		return $result;
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

	public function getSoldSingle()
	{
		return $this->_sold_single;
	}
	public function setSoldSingle($sold_single)
	{
		$this->_sold_single = (int) $sold_single;
		return $this;
	}
	public function getSoldDate()
	{
		return $this->_sold_date;
	}
	public function setSoldDate($sold_date)
	{
		$this->_sold_date = (string) $sold_date;
		return $this;
	}
	public function getSoldPrice()
	{
		return $this->_sold_price;
	}
	public function setSoldPrice($sold_price)
	{
		$this->_sold_price = (float) $sold_price;
		return $this;
	}
	public function getSoldName()
	{
		return $this->_sold_name;
	}
	public function setSoldName($sold_name)
	{
		$this->_sold_name = (string) $sold_name;
		return $this;
	}
	public function getSoldEbayId()
	{
		return $this->_sold_ebay_id;
	}
	public function setSoldEbayId($sold_ebay_id)
	{
		$this->_sold_ebay_id = (string) $sold_ebay_id;
		return $this;
	}
	public function getSoldEmail()
	{
		return $this->_sold_email;
	}
	public function setSoldEmail($sold_email)
	{
		$this->_sold_email = (string) $sold_email;
		return $this;
	}
	public function getSoldAddress()
	{
		return $this->_sold_address;
	}
	public function setSoldAddress($sold_address)
	{
		$this->_sold_address = (string) $sold_address;
		return $this;
	}
	public function getSoldPhone()
	{
		return $this->_sold_phone;
	}
	public function setSoldPhone($sold_phone)
	{
		$this->_sold_phone = (string) $sold_phone;
		return $this;
	}
	public function getSoldSaleType()
	{
		return $this->_sold_sale_type;
	}
	public function setSoldSaleType($sold_sale_type)
	{
		$this->_sold_sale_type = (int) $sold_sale_type;
		return $this;
	}
	public function getSoldSaleTypeDescription()
	{
		return $this->_sold_sale_type_description;
	}
	public function setSoldSaleTypeDescription($sold_sale_type_description)
	{
		$this->_sold_sale_type_description = (string) $sold_sale_type_description;
		return $this;
	}
	public function getSoldPaypalFees()
	{
		return $this->_sold_paypal_fees;
	}
	public function setSoldPaypalFees($sold_paypal_fees)
	{
		$this->_sold_paypal_fees = (float) $sold_paypal_fees;
		return $this;
	}
	public function getSoldPaypalTransactionId()
	{
		return $this->_sold_paypal_transaction_id;
	}
	public function setSoldPaypalTransactionId($sold_paypal_transaction_id)
	{
		$this->_sold_paypal_transaction_id = (string) $sold_paypal_transaction_id;
		return $this;
	}
	public function getSoldEbayFees()
	{
		return $this->_sold_ebay_fees;
	}
	public function setSoldEbayFees($sold_ebay_fees)
	{
		$this->_sold_ebay_fees = (float) $sold_ebay_fees;
		return $this;
	}
	public function getSoldEbayFeesVerify()
	{
		return $this->_sold_ebay_fees_verify;
	}
	public function setSoldEbayFeesVerify($sold_ebay_fees_verify)
	{
		if (!is_null($sold_ebay_fees_verify)) {
			$this->_sold_ebay_fees_verify = (boolean) $sold_ebay_fees_verify;
		}
		return $this;
	}
	public function getSoldEbayAuctionId()
	{
		return $this->_sold_ebay_auction_id;
	}
	public function setSoldEbayAuctionId($sold_ebay_auction_id)
	{
		$this->_sold_ebay_auction_id = (string) $sold_ebay_auction_id;
		return $this;
	}
	public function getSoldShippingCost()
	{
		return $this->_sold_shipping_cost;
	}
	public function setSoldShippingCost($sold_shipping_cost)
	{
		$this->_sold_shipping_cost = (float) $sold_shipping_cost;
		return $this;
	}
	public function getSoldShippingCostVerify()
	{
		return $this->_sold_shipping_cost_verify;
	}
	public function setSoldShippingCostVerify($sold_shipping_cost_verify)
	{
		if (!is_null($sold_shipping_cost_verify)) {
			$this->_sold_shipping_cost_verify = (boolean) $sold_shipping_cost_verify;
		}
		return $this;
	}
	public function getSoldTrackingInfo()
	{
		return $this->_sold_tracking_info;
	}
	public function setSoldTrackingInfo($sold_tracking_info)
	{
		$this->_sold_tracking_info = (string) $sold_tracking_info;
		return $this;
	}

}