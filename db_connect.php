<?php
//Conexão com o banco de dados
$host = "ec2-23-23-128-222.compute-1.amazonaws.com";
$port = "5432";
$db_name="d7orfdv4son25g";
$user = "layrcwwccwepoy";
$password="019295c77e48ace2aa14e61028e66f9d937be8d5277d7587e6eca553dffe47c8";

//pdo - somente orientado objeto
$connect = pg_connect($host,$port,$db_name,$user,$password);

if(pg_connect_error()):
	echo "Falha na conexão: ". pg_connect_error();
endif;
