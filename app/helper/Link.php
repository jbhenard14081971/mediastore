<?php

namespace app\helper;

use \Pecee\SimpleRouter\RouterBase;

class Link
{
	public static function url($controller, $parameters = null, $getParams = null) {
    	return rtrim(RouterBase::getInstance()->getRoute($controller, $parameters, $getParams), '/');
	}
}
