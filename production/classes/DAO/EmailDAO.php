<?php

class EmailDAO{

	private $db; 

	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}

	public function saveEmail($Email)
	{
		try
		{
			$stmt = $this->db->prepare("INSERT INTO email(id_email, description, email, Id_client) 
				VALUES(:idEmail, :description, :email, :idClient)");

			$stmt->bindparam(":idEmail",$Email->getIdEmail());
			$stmt->bindparam(":description",$Email->getDescription());
			$stmt->bindparam(":email",$Email->getEmail());
			$stmt->bindparam(":idClient",$Email->getIdClient());
			
			$stmt->execute();

			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage(); 
			return false;
		}
	}

	public function saveListEmail($listEmail)
	{
		
		foreach($listEmail as $email)
		{
			try
			{
				$stmt = $this->db->prepare("INSERT INTO email(id_email, description, email, Id_client) 
				VALUES(:idEmail, :description, :email, :idClient)");

				$stmt->bindparam(":idEmail",$email->getIdEmail());
				$stmt->bindparam(":description",$email->getDescription());
				$stmt->bindparam(":email",$email->getEmail());
				$stmt->bindparam(":idClient",$email->getIdClient());
				
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

	public function listEmails($idClient){
		try
		{
			$stmt = $this->db->prepare(" SELECT * FROM email WHERE id_client = :id ");
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

	public function DeleteEmails($idClient){
		try
		{
			$stmt = $this->db->prepare(" DELETE FROM email WHERE id_client = :id ");
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