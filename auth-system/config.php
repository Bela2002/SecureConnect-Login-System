<?php

#host
$host = "localhost";
#dbname
$dbname = "auth-sys";
#username
$user = "root";
#password
$pass = "";

#connection
$conn = new PDO("mysql:host=$host;dbname=$dbname;" , $user , $pass);

#check connection
/*if($conn == true){
    echo "It's working fine.";
}
else{
    echo "Connection is wrong.: err";
}*/


?>