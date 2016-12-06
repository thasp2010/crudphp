<?php

class PhoneDAO {

	private $db; 

	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}

	public function savePhone($Phone)
	{
		try
		{
			$stmt = $this->db->prepare("INSERT INTO phone(id_client, description, phonenumber) 
				VALUES(:idClient, :description, :phoneNumber)");

			$stmt->bindparam(":idClient",$Phone->getIdClient());
			$stmt->bindparam(":description",$Phone->getDescription());
			$stmt->bindparam(":phoneNumber",$Phone->getPhoneNumber());
			
			$stmt->execute();

			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage(); 
			return false;
		}
	}

	public function saveListPhone($listPhone)
	{
		
		foreach($listPhone as $phone)
		{
			try
			{
				$stmt = $this->db->prepare("INSERT INTO phone(id_client, description, phone_number) 
					VALUES(:idClient, :description, :phoneNumber)");

				$stmt->bindparam(":idClient",$phone->getIdClient());
				$stmt->bindparam(":description",$phone->getDescription());
				$stmt->bindparam(":phoneNumber",$phone->getPhoneNumber());
				
				$stmt->execute();
				
			}
			catch(PDOException $e)
			{
				echo $e->getMessage(); 
				return false;
			}

		}

		return true;
	}

	public function listPhones($idClient){
		try
		{
			$stmt = $this->db->prepare(" SELECT * FROM phone WHERE id_client = :id ");
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

	public function DeletePhones($idClient){
		try
		{
			$stmt = $this->db->prepare(" DELETE FROM phone WHERE id_client = :id ");
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


}

?>