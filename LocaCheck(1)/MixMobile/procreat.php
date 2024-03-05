<?php 
  session_start();

  if (!isset($_SESSION['user_id'])) {
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

      <link rel="stylesheet" href="./css/style_procreat.css" />




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
          
          <title>Profile create</title>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
			    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
			    crossorigin="anonymous"
			    referrerpolicy="no-referrer">
	    </script>
    </head>
  <body>
    
    <div class="test-page">
    <div class="contain">
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
      <h3 class="welcome">Welcome !</h3>

      <div class = "Propic">
        <img src="uploads/user-default1.png" id="imgPreview">
      </div>

      <?php 

        if(isset($_POST['Email']) &&
        isset($_POST['password']) &&
        isset($_POST['Confirmed-password'])
        )
        {

        # database connection file
        include 'app/db.conn.php';
        
        # get data from POST request and store them in var
        //$name = $_POST['name'];
        
        $Email = $_POST['Email'];
        $password = $_POST['password'];
        $CF_password = $_POST['Confirmed-password'];

        $data = 'name='.$Email;

          $sql = "SELECT username 
                  FROM users
                  WHERE username=?";
          $stmt = $conn->prepare($sql);
          $stmt->execute([$Email]);

          
          if($stmt->rowCount() > 0 && isset($_SESSION['username']) && $_SESSION['username'] != $Email ){

            $em = "The username ($Email) is taken";
            header("Location: signup.php?error=$em&$data");
            exit;
          }
          else if($CF_password !== $password){
            $em = "confirm password does not match!";
            header("Location: signup.php?error=$em&$data");
            exit;
          }
          else if(!isset($_SESSION['username'])){

            if($stmt->rowCount() > 0){
              $em = "The username ($Email) is taken";
              header("Location: signup.php?error=$em&$data");
              exit;
            }
            else if($CF_password !== $password){
              $em = "confirm password does not match!";
              header("Location: signup.php?error=$em&$data");
              exit;
            }
            
            $_SESSION['username'] = $_POST['Email'];


            //hash password
            $password = password_hash($password, PASSWORD_DEFAULT);

            //insert data
            $sql = "INSERT INTO users
                        (name, username, password)
                        VALUES ('nametest',?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$Email, $password]);
    

          }
          
          //$data = 'name='.$name.'&username='.$username;        
          
      }
      ?>





          <form method="post"  
            action="app/http/update.php"
            enctype="multipart/form-data"
            class="letter-1">
          
          <?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-warning" role="alert">
            <?php echo htmlspecialchars($_GET['error']);?>
          </div>
          <?php } ?>

            <label class="form-label">Username</label>
            <input class="form-control" 
                  name="name"
                  required>

            <label class="form-label">UserID</label>
            <input class="form-control"
                  name="userID"
                  required>
            
            <label class="Propic-label">
            <svg
              class="icons-mode-edit-24-px"
              width="24"  
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M19.06 3.59L20.41 4.94C21.2 5.72 21.2 6.99 20.41 7.77L7.18 21H3V16.82L13.4 6.41L16.23 3.59C17.01 2.81 18.28 2.81 19.06 3.59ZM5 19L6.41 19.06L16.23 9.23L14.82 7.82L5 17.64V19Z"
              fill="black"
              />
            </svg>
            <input type="file" 
		              class="Propic-up"
                  id = "photo"
		              name="pp"
                  required="true" />


            </label>
		        

            <button type="submit" 
                          id="formBtn"
                          class="box-for-les-t-go">
                    <div class="let-s-go">Create account</div> 
            </button>

          </form> 

              

        </div>  
    </div>
  </body>


  <script>
		$(document).ready(() => {
			const photoInp = $("#photo");
			let file;

			photoInp.change(function (e) {
				file = this.files[0];
				if (file) {
					let reader = new FileReader();
					reader.onload = function (event) {
						$("#imgPreview")
							.attr("src", event.target.result);
					};
					reader.readAsDataURL(file);
				}
			});
		});

	</script>


</html>

<?php
  }else{
  	header("Location: map.php");
   	exit;
  }
 ?>