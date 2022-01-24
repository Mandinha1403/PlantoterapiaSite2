<?php 

//$connect_url = getenv("postgres://layrcwwccwepoy:019295c77e48ace2aa14e61028e66f9d937be8d5277d7587e6eca553dffe47c8@ec2-23-23-128-222.compute-1.amazonaws.com:5432/d7orfdv4son25g");
$connect = pg_connect("postgres://layrcwwccwepoy:019295c77e48ace2aa14e61028e66f9d937be8d5277d7587e6eca553dffe47c8@ec2-23-23-128-222.compute-1.amazonaws.com:5432/d7orfdv4son25g");

echo gettype($connect);

?>
