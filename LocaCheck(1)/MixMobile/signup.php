<?php 
  session_start();
  
  if (!isset($_SESSION['user_id'])) {

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
        
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">		

		<link rel="icon" href="img/logoL.png">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

		<link rel="stylesheet" href="./css/style_signup.css" />

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
   
        <div class="sign-up-page">
            <a href="start.php">
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
                    stroke="#1C1919"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    />
                    <path
                    d="M12 19L5 12L12 5"
                    stroke="#1C1919"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    />
                </svg>
            </a>

            <form method="post" 
	 	          action="procreat.php"
                  class="letter-1">

                <div class="Sign-in">Sign up</div>


				<?php if (isset($_GET['error'])) { ?>
	 			<div class="alert alert-warning" role="alert">
			  	<?php echo htmlspecialchars($_GET['error']);?>
				</div>
				<?php } ?>
	 		
		        <label class="form-label"></label>
		        <input type="text" 
                    class="form-control"
		            name="Email"
                    placeholder="Email"
                    required>
		  
                <label class="form-label"></label>
                <input type="password" 
                    class="form-control"
                    name="password"
                    placeholder="Password" 
                    required>
                
                <label class="form-label"></label>
                <input type="password" 
                    class="form-control"
                    name="Confirmed-password"
                    placeholder="Confirmed password" 
                    required>
 
                
				<div class="account">
                    <a href="index.php" style="color: black;">already have an account ?</a>
                </div>

                <button type="submit" 
                        class="box-for-les-t-go">
                        <div class="let-s-go">Create account</div> 
                </button>

		    </form>

            
           
        </div>
    </body>
</html>


<?php
  }else{
  	header("Location: map.php");
   	exit;
  }
 ?>