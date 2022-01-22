<?php
//Conexão com o banco de dados
$servername = "localhost"; //endereço do servidor
$username="root";
$password="usbw";
$db_name="plantoterapia";

//pdo - somente orientado objeto
$connect =mysqli_connect($servername,$username,$password,$db_name);

if(mysqli_connect_error()):
	echo "Falha na conexão: ". mysqli_connect_error();
endif;