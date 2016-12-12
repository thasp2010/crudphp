<?php

if(isset($_POST['mail']))
{
	$listaemail = '';

	$_checkbox = $_POST['mail'];
	foreach($_checkbox as $email){
		$listaemail .=  $email .';';
		
	}

	$texto = "Email de teste.";

	$remetente = "thais.informatica@yahoo.com";
	$destino = $listaemail;
	$assunto = "E-mail de teste";


	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: <$remetente>';


	$enviaremail = mail($destino, $assunto, $texto, $headers);
	echo "enviou";
	if($enviaremail){
		$mgm = "E-MAIL ENVIADO COM SUCESSO! <br> O link será enviado para o e-mail fornecido no formulário";
		echo " <meta http-equiv='refresh' content='10;URL=contato.php'>";
		header("location:/");
	} else {
		$mgm = "ERRO AO ENVIAR E-MAIL!";
		echo "";
		header("location:/");
	}
	
}

echo "ola";
?>