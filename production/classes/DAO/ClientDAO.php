<?php

class ClientDAO{

	private $db; 

	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}
	

	public function saveClient($Client){
		try
		{
			$stmt = $this->db->prepare("INSERT INTO client(first_name,last_name,gender, individual_registration, 
				state_registration, legal_person_registration, 
				type_person, company_fancy_name ) 
			VALUES(:fname, :lname, :gender, :individualRegistration,     
				:stateRegistration, :legalPersonRegistration,     
				:typeperson, :fancyName )");

			$stmt->bindparam(":fname",$Client->getFirstName());
			$stmt->bindparam(":lname",$Client->getLastName());
			$stmt->bindparam(":gender",$Client->getGender());
			$stmt->bindparam(":individualRegistration",$Client->getIndividualRegistration());
			$stmt->bindparam(":stateRegistration",$Client->getStateRegistration());
			$stmt->bindparam(":legalPersonRegistration",$Client->getLegalPersonRegistration());
			$stmt->bindparam(":typeperson",$Client->getTypePerson());
			$stmt->bindparam(":fancyName",$Client->getCompanyFancyName());
			$stmt->execute();

			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage(); 
			return false;
		}

	}

	public function updateClient($Client){
		try
		{
			$stmt = $this->db->prepare("UPDATE client SET  first_name = :fname,
				last_name = :lname,
				gender = :gender, 
				individual_registration = :individualRegistration, 
				state_registration = :stateRegistration, 
				legal_person_registration = :legalPersonRegistration, 
				type_person = :typeperson, 
				company_fancy_name = :fancyName 
				WHERE id_client =:id ");

			$stmt->bindparam(":fname",$Client->getFirstName());
			$stmt->bindparam(":lname",$Client->getLastName());
			$stmt->bindparam(":gender",$Client->getGender());
			$stmt->bindparam(":individualRegistration",$Client->getIndividualRegistration());
			$stmt->bindparam(":stateRegistration",$Client->getStateRegistration());
			$stmt->bindparam(":legalPersonRegistration",$Client->getLegalPersonRegistration());
			$stmt->bindparam(":typeperson",$Client->getTypePerson());
			$stmt->bindparam(":fancyName",$Client->getCompanyFancyName());
			$stmt->bindparam(":id",$Client->getIdClient());
			$stmt->execute(); 
			

			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage(); 
			return false;
		}    	
	}

	public function deleteClient($idClient){
		try
		{
			$stmt = $this->db->prepare(" DELETE FROM client WHERE id_client = :id ");
			$stmt->bindparam(":id",$idClient);		   
			$stmt->execute();

			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage(); 
			return false;
		}	
		
	}

	public function listClient(){
		$stmt = $this->db->prepare("SELECT * FROM client ");
		$stmt->execute();
		return $stmt;
	}

	public function returnClient($id){
		$stmt = $this->db->prepare("SELECT * FROM client WHERE id_client = :id ");
		$stmt->execute(array(":id"=>$id));
		$stmt->execute();
		return $stmt;
	}

	public function returnNextId(){
		$stmt = $this->db->prepare("SELECT MAX(id_client)+1 AS nextid FROM client ");
		$stmt->execute();
		return $stmt;
	}


}

?>