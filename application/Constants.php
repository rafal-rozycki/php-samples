<?php

class Constants
{
	const FIELD_GROUPS			= 'INFO,DETAIL,TIRE,DESCRIPTION,BOUGHT,SOLD,SHIP';

	const INFO_FIELDS			= 'name,status,needs_work,title,subtitle,folder,photos,photos_array,notes';
	const DETAIL_FIELDS			= 'bolt_pattern,part_number,front_diameter,front_width,front_offset,rear_diameter,rear_width,rear_offset,part_number,part_number_rear,part_number_hollander,part_number_hollander_rear,tpms,center_caps';
	const TIRE_FIELDS			= 'front_tire_width,front_tire_sidewall,front_tire_depth,front_tire_depth_percent,rear_tire_width,rear_tire_sidewall,rear_tire_depth,rear_tire_depth_percent,tire_description,tire_production_dates,mileage';
	const DESCRIPTION_FIELDS	= 'description';
	const BOUGHT_FIELDS			= 'bought_date,bought_price,bought_name,bought_email,bought_address,bought_phone';
	const SOLD_FIELDS			= 'sold_single,sold_date,sold_price,sold_name,sold_ebay_id,sold_email,sold_address,sold_phone,sold_sale_type,sold_paypal_fees,sold_paypal_transaction_id,sold_ebay_fees,sold_ebay_fees_verify,sold_ebay_auction_id';
	const SHIP_FIELDS			= 'ship_weight,ship_length,ship_width,ship_height,sold_shipping_cost,sold_shipping_cost_verify,sold_tracking_info';
}