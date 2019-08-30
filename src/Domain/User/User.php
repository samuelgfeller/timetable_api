<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 03.05.2019
 * Time: 15:34
 */

class User
{
	private $id;
	private $date;
	
	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * @param mixed $id
	 */
	public function setId($id): void {
		$this->id = $id;
	}
	
	/**
	 * @return mixed
	 */
	public function getDate() {
		return $this->date;
	}
	
	/**
	 * @param mixed $date
	 */
	public function setDate($date): void {
		$this->date = $date;
	}
	
	
}
