<?php

class Email {

	private $id_email;
	private $description;
	private $email;
	private $id_client;

	public function setIdEmail($idEmail){
		$this->id_email = $idEmail;
	}

	public function setDescription($Description){
		$this->description = $Description;
	}

	public function setEmail($Email){
		$this->email = $Email;
	}

	public function setIdClient($IdClient){
		$this->id_client = $IdClient;
	}

	public function getIdEmail(){
		return $this->id_email;
	}

	public function getDescription(){
		return $this->description;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getIdClient(){
		return $this->id_client;
	}


}


?>