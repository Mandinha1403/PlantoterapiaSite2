<?php 

$conn = pg_connect(getenv("postgres://layrcwwccwepoy:019295c77e48ace2aa14e61028e66f9d937be8d5277d7587e6eca553dffe47c8@ec2-23-23-128-222.compute-1.amazonaws.com:5432/d7orfdv4son25g"));
	
	
//pdo - somente orientado objeto
$connect = pg_connect($host,$port,$db_name,$user,$password);

if(pg_connect_error()):
	echo "Falha na conexão: ".pg_connect_error();
endif;
