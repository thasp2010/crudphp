<?php

class Address {

	private $idClient;
	private $idAddress;
	private $description;
	private $street;
	private $city;
	private $state;
	private $cep;

	public function __construct(){

	}

	public function setIdClient($id){
		$this->idClient = $id;
	} 

	public function setIdAddress($id){
		$this->idAddress = $id;
	} 

	public function setDescription($description){
		$this->description = $description;
	}

	public function setStreet($street){
		$this->street = $street;
	} 

	public function setCity($city){
		$this->city = $city;
	} 

	public function setState($state){
		$this->state = $state;
	} 

	public function setCep($Cep){
		$this->cep = $Cep;
	} 

	public function getIdClient(){
		return $this->idClient;
	}

	public function getIdAddress(){
		return $this->idAddress;
	}

	public function getDescription(){
		return $this->description;
	}

	public function getStreet(){
		return $this->street;
	}

	public function getCity(){
		return $this->city;
	}

	public function getState(){
		return $this->state;
	}

	public function getCep(){
		return $this->cep;
	}




}
?>