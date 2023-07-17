<?php

//database to make constant(this is another way of connecting database)

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "cms";


//array for loops
foreach($db as $key => $value) {

    define(strtoupper($key), $value ); 
}

$connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$connect) {
    die('Database Connection Failed');
} 
    


?>