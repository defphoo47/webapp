<?php 
session_start();

if (isset($_SESSION['user_id'])) {
  header("Location: map.php");
   exit;
 }

if (isset($_SESSION['username'])) {
  include 'app/db.conn.php';
  $username = $_SESSION['username'];
  $sql = "DELETE FROM users WHERE name='nametest' AND username=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$username]);
  //echo 'ok';
  session_unset();
  session_destroy();
 }
 else{
    //echo 'no';
 }
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/style_start.css" />

    <style>
      a,
      button,
      input,
      select,
      h1,
      h2,
      h3,
      h4,
      h5,
      * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        border: none;
        text-decoration: none;
        appearance: none;
        background: none;

        -webkit-font-smoothing: antialiased;
      }
    </style>
    <title>Document</title>
  </head>
    <body>
        <div class="start-page">
            <div class="contain-start">
                <img class="image-3" src="img/logoL.png"/>
                <a href="signup.php">
                    <div  class="box-for-start">
                        <div class="start">START</div>
                    </div>
                </a>
                <div class="box-tail">
                    <div class="already-have-an-accout">already have an account ?</div>
                    <a href="index.php" class="sign-in">sign in</a>
                </div>
            </div>
        </div>
    </body>
</html>
