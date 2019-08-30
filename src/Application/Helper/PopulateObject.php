<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/model/entity/Location.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/entity/User.php';


class PopulateObject
{
	
	/**
	 * If the value is empty return null otherwise the value
	 *
	 * @param $val
	 * @return null | $val
	 */
	public static function ckVal($val) {
		return !empty($val) ? $val : null;
	}
	
	
	
	
	/**
	 * @param $data
	 * @return bool|Location
	 */
	public static function populateLocation($data) {
		if ($data) {
			$location = new Location();
			$location->setId(self::ckVal($data['id'] ?? null));
			$location->setUserId(self::ckVal($data['user_id'] ?? null));
			$location->setX(self::ckVal($data['x'] ?? null));
			$location->setY(self::ckVal($data['y'] ?? null));
			$location->setDate(self::ckVal($data['date'] ?? null));
			return $location;
		}
		return false;
	}
	
	/**
	 * @param $data
	 * @return bool|User
	 */
	public static function populateUser($data) {
		if ($data) {
			$user = new User();
			$user->setId(self::ckVal($data['id'] ?? null));
			return $user;
		}
		return false;
	}
	
	
	
}
