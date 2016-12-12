<?php

$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "thais";
$DB_name = "crudphp";


try
{
	$DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
	$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

include_once "ClientDAO.php";
include_once "PhoneDAO.php";
include_once "AddressDAO.php";
include_once "EmailDAO.php";

$Dao = new ClientDAO($DB_con);
$PhoneDao = new PhoneDAO($DB_con);
$AddressDao = new AddressDAO($DB_con);
$EmailDao   = new EmailDAO($DB_con);

?>