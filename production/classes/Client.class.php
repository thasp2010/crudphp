<?php

class Client {
	
    private $idClient;
    private $firstName;
    private $lastName;
    private $gender;
    private $typePerson;
	private $individualRegistration;
    private $legalPersonRegistration;
    private $stateRegistration;
    private $companyFancyName;


    public function __construct(){

    }

    public function setIdClient($pIdClient){
        $this->idClient = $pIdClient;
    }

    public function setFirstName($pFirstName){
        $this->firstName = $pFirstName;
    }

    public function setLastName($pLastName){
        $this->lastName = $pLastName;
    }

    public function setGender($pGender){
        $this->gender = $pGender;
    }

    public function setTypePerson($pTypePerson){
        $this->typePerson = $pTypePerson;
    }

    public function setIndividualRegistration($pIndividualRegistration){
        $this->individualRegistration = $pIndividualRegistration;
    }

    public function setLegalPersonRegistration($pLegalPersonRegistreation){
        $this->legalPersonRegistration = $pLegalPersonRegistreation; 
    }

    public function setStateRegistration($pStateRegistration){
        $this->stateRegistration = $pStateRegistration;
    }

    public function setCompanyFancyName($pCompanyFancyName){
        $this->companyFancyName = $pCompanyFancyName;
    }

    public function getIdClient(){
        return $this->idClient;
    }

    public function getFirstName(){
        return $this->firstName;
    }

    public function getLastName(){
        return $this->lastName;
    }

    public function getGender(){
        return $this->gender;
    }

    public function getTypePerson(){
        return $this->typePerson;
    }

    public function getIndividualRegistration(){
        return $this->individualRegistration;
    } 
    public function getLegalPersonRegistration(){
        return $this->legalPersonRegistration;
    }
    
    public function getStateRegistration(){
        return $this->stateRegistration;
    }

    public function getCompanyFancyName(){
        return $this->companyFancyName;
    }

}

?>