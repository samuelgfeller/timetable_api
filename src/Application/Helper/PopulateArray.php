<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/model/entity/Location.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/entity/User.php';


class PopulateArray
{
	
	/**
	 * @param Location $location
	 * @return array
	 */
	public static function populateLocationArray(Location $location): array {
		return [
			'id' => $location->getId(),
			'user_id' => $location->getUserId(),
			'x' => $location->getX(),
			'y' => $location->getY(),
			'date' => $location->getDate(),
		];
	}
	
	
	/**
	 * @param User $user
	 * @return array
	 */
	public static function populateUserArray(User $user): array {
		return [
			'id' => $user->getId(),
			'date' => $user->getDate(),
		];
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
