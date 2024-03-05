<?php
// Connect to server and select database.
// define('servername', 'sql208.infinityfree.com');
// define('username', 'if0_36104274');
// define('password', 'TkPUUSQqzwn');
// define('dbname', 'if0_36104274_chat_app_db');
// $objCon = mysqli_connect(servername, username, password,dbname);


# server name
$sName = "sql208.infinityfree.com";
# user name
$uName = "if0_36104274";
# password
$pass = "TkPUUSQqzwn";

# database name
$db_name = "if0_36104274_chat_app_db";

#creating database connection
try {
    $conn = new PDO("mysql:host=$sName;dbname=$db_name", 
                    $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed : ". $e->getMessage();
}


?>
