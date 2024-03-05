<?php 
  session_start();


  if (isset($_SESSION['username'])) {
  	# database connection file
  	include 'app/db.conn.php';
  	include 'app/helpers/user.php';

  	

    if (!isset($_GET['user'])) {
  		header("Location: map.php");
  		exit;
  	}

    $user = getUser($_GET['user'], $conn);
    

    if($user['user_id'] == $_SESSION['user_id']){
      header("Location: profile.php");
  		exit;
    }

?>



<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
        
		  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">		

		  <link rel="icon" href="img/logoL.png">
		  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

      <link rel="stylesheet" href="./css/style_profile1.css" />


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
          
          <title>L-Check Profile-page</title>
    </head>
  <body>
    
    <div class="test-page">
    <div class="contain">
        <div class = "Head">
			<a href="<?=$_SERVER['HTTP_REFERER']?>">
                <svg
                    class="arrow-left"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    >
                    <path
                    d="M19 12H5"
                    stroke="#000000"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    />
                    <path
                    d="M12 19L5 12L12 5"
                    stroke="#000000"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    />
                </svg>
            </a>
            <h3 class="profile">Profile</h3>
		</div>

        
      <div class = "Propic">
          <img src="uploads/<?=$user['p_p']?>">
      </div>

      <div class = "name-of-user">
      <?=$user['name']?>
      </div>

      <div class="box-tail">
                    <a href="map.php" class="sign-in" style="color:black">Back to Homepage?</a>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="home.php" class="sign-in">messages?</a>
                </div>
      <a href="chat.php?user=<?=$user['username']?>">
                    <div  class="box-for-logout">
                        <div class="logout">Chat</div>
                    </div>
      </a>


        </div>  
    </div>
  </body>
</html>

<?php
  }else{
  	header("Location: index.php");
   	exit;
  }
 ?>