<?php

class Phone {

	private $id_phone;
	private $id_client;
	private $description;
	private $phonenumber;

	public function __construct(){

    }

	public function setIdPhone($id){
		$this->id_phone = $id;
	}

	public function setIdClient($idClient){
		$this->id_client = $idClient;
	}

	public function setDescription($description){
		$this->description = $description;
	}

	public function setPhoneNumber($phoneNumber){
		$this->phonenumber = $phoneNumber; 
	}

	public function getId(){
		return $this->id_phone;
	}

	public function getIdClient(){
		return $this->id_client;
	}

	public function getDescription(){
		return $this->description;
	}

	public function getPhoneNumber(){
		return $this->phonenumber;
	}

}

?>