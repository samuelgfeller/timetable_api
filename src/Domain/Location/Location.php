<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 03.05.2019
 * Time: 15:24
 */

class Location
{
	private $id;
	private $user_id;
	private $x;
	private $y;
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
	public function getUserId() {
		return $this->user_id;
	}
	
	/**
	 * @param mixed $user_id
	 */
	public function setUserId($user_id): void {
		$this->user_id = $user_id;
	}
	
	/**
	 * @return mixed
	 */
	public function getX() {
		return $this->x;
	}
	
	/**
	 * @param mixed $x
	 */
	public function setX($x): void {
		$this->x = $x;
	}
	
	/**
	 * @return mixed
	 */
	public function getY() {
		return $this->y;
	}
	
	/**
	 * @param mixed $y
	 */
	public function setY($y): void {
		$this->y = $y;
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
