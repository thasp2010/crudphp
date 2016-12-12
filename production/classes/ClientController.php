<?php
/*
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once $root."/classes/Client.class.php";
include_once $root."/classes/Phone.class.php";
include_once $root."/classes/Address.class.php";
include_once $root."/classes/DAO/ConfigDB.php";
*/

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include_once $root."/crudphp/production/classes/Client.class.php";
include_once $root."/crudphp/production/classes/Phone.class.php";
include_once $root."/crudphp/production/classes/Address.class.php";
include_once $root."/crudphp/production/classes/DAO/ConfigDB.php";
include_once $root."/crudphp/production/classes/Email.class.php";

if(isset($_GET['option']))
{
  if (($_GET['option'] == 'save') || ($_GET['option'] == 'update')){

    $client = new Client; 
    $phones = new ArrayObject();
    $listAddress = new ArrayObject();
    $listEmail = new ArrayObject();

    $idClient = $_POST['idClient']; 

    $client->setFirstName($_POST['first-name']);
    $client->setLastName($_POST['last-name']);
    $client->setGender($_POST['gender']);
    $client->setIndividualRegistration($_POST['individualRegistration']);
    $client->setStateRegistration($_POST['stateRegistration']);
    $client->setLegalPersonRegistration($_POST['legalPersonRegistration']);
    $client->setTypePerson($_POST['typeperson']);
    $client->setCompanyFancyName($_POST['fancyName']);
    

    if (isset($_POST['descricaoHiden'])){ 

      $qtd = count( $_POST['descricaoHiden'] );     

      for( $i=0; $i<count( $_POST['descricaoHiden'] ); $i++ )
      {

        $phone  = new Phone; 
        
        $phone->setDescription($_POST['descricaoHiden'][$i]);
        $phone->setIdClient($idClient);
        $phone->setPhoneNumber($_POST['telefoneHiden'][$i]); 

        $phones-> append($phone);
      } 

    }

    if (isset($_POST['descriptionAddressHidden'])){

      for( $i=0; $i<count( $_POST['descriptionAddressHidden'] ); $i++ )
      {

        $address  = new Address; 

        $address->setDescription($_POST['descriptionAddressHidden'][$i]);
        $address->setIdClient($idClient);
        $address->setStreet($_POST['streetHidden'][$i]); 
        $address->setState($_POST['stateHidden'][$i]);
        $address->setCep($_POST['cepHidden'][$i]);
        $address->setCity($_POST['cityHidden'][$i]);

        $listAddress-> append($address);
      } 

    }   

    if (isset($_POST['descricaoEmailHidden'])){

      for( $i=0; $i<count( $_POST['descricaoEmailHidden'] ); $i++ )
      {

        $email  = new Email; 

        $email->setDescription($_POST['descricaoEmailHidden'][$i]);
        $email->setIdClient($idClient);
        $email->setEmail($_POST['emailHidden'][$i]); 
        

        $listEmail-> append($email);
      } 

    }  

    if ($_GET['option'] == 'save') {

      if ($Dao->saveClient($client)){

        if ( count($phones) >0){
         $PhoneDao->saveListPhone($phones);  
       }

       if (count($listAddress) > 0){
        $AddressDao->saveListAddress($listAddress);  
      }

      if(count($listEmail) > 0){
        $EmailDao->saveListEmail($listEmail);
      }
      
      //echo $qtd;
      print_r($phones); 
      header("location:/");
    }else{
      echo "fail";
      header("location:/");
    }

  }else{
   $client->setIdClient($idClient);

   if ($Dao->updateClient($client)){

    $PhoneDao->DeletePhones($idClient);
    $AddressDao->DeleteAddress($idClient);
    $EmailDao->DeleteEmails($idClient);

    if ( count($phones) >0){
     $PhoneDao->saveListPhone($phones);  
   }

   if (count($listAddress) > 0){
    $AddressDao->saveListAddress($listAddress);  
  }

  if(count($listEmail) > 0){
    $EmailDao->saveListEmail($listEmail);
  }


  header("location:/");
}else{
  echo "fail";
  header("location:/");
}

}     


}else
if (($_GET['option'] == 'delete')){

  $PhoneDao->DeletePhones($_GET['id_client']);
  $AddressDao->DeleteAddress($_GET['id_client']);
  $Dao->deleteClient($_GET['id_client']);

  header("location:/");
}

}

?>