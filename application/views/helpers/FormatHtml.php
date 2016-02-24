<?php

class Zend_View_Helper_FormatHtml extends Zend_View_Helper_Abstract
{

	public function formatHtml($html)
	{
		$br = array("<br />", "<br/>", "<br>");
		$result = trim(str_ireplace($br, "\r\n", $html));
		return $result;
	}

}