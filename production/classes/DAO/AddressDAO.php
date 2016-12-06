<?php

class AddressDAO {

	private $db; 

	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}

	public function saveAddress($Address)
	{
		try
		{
			$stmt = $this->db->prepare("INSERT INTO address(id_client, description, street, city, state, cep) 
				VALUES(:idClient, :description, :street, :city, :state, :cep)");

			$stmt->bindparam(":idClient",$Address->getIdClient());
			$stmt->bindparam(":description",$Address->getDescription());
			$stmt->bindparam(":street",$Address->getStreet());
			$stmt->bindparam(":city",$Address->getCity());
			$stmt->bindparam(":state",$Address->getState());
			$stmt->bindparam(":cep",$Address->getCep());
			
			$stmt->execute();

			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage(); 
			return false;
		}
	}

	public function saveListAddress($listAddress)
	{
		
		foreach($listAddress as $address)
		{
			try
			{
				$stmt = $this->db->prepare("INSERT INTO address(id_client, description, street, city, state, cep) 
					VALUES(:idClient, :description, :street, :city, :state, :cep)");

				$stmt->bindparam(":idClient",$address->getIdClient());
				$stmt->bindparam(":description",$address->getDescription());
				$stmt->bindparam(":street",$address->getStreet());
				$stmt->bindparam(":city",$address->getCity());
				$stmt->bindparam(":state",$address->getState());
				$stmt->bindparam(":cep",$address->getCep());
				
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

	public function listAddress($idAddress){
		try
		{
			$stmt = $this->db->prepare(" SELECT * FROM address WHERE id_client = :id ");
			$stmt->bindparam(":id",$idAddress);		   
			$stmt->execute();

			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage(); 
			return false;
		}		
	}


	public function DeleteAddress($idClient){
		try
		{
			$stmt = $this->db->prepare(" DELETE FROM address WHERE id_client = :id ");
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