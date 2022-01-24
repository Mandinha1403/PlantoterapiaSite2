<?php
//Conexão com o banco de dados
$servername = "
postgres://layrcwwccwepoy:019295c77e48ace2aa14e61028e66f9d937be8d5277d7587e6eca553dffe47c8@ec2-23-23-128-222.compute-1.amazonaws.com:5432/d7orfdv4son25g"; //endereço do servidor
$username="layrcwwccwepoy";
$password="019295c77e48ace2aa14e61028e66f9d937be8d5277d7587e6eca553dffe47c8";
$db_name="Plantoterapia";

//pdo - somente orientado objeto
$connect = pg_connect($servername,$username,$password,$db_name);

if(pg_connect_error()):
	echo "Falha na conexão: ". pg_connect_error();
endif;
