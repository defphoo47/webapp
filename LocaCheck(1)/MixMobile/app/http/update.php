<?php 
  session_start();

  echo $_SESSION['username'];

  echo("welcome test<br>");

  if(isset($_POST['name']) &&
   isset($_POST['userID'])
   )
   {

   # database connection file
   include '../db.conn.php';
   
   # get data from POST request and store them in var
   //$name = $_POST['name'];
   
   $name = $_POST['name'];
   $userID = $_POST['userID'];

   $data = 'name='.$userID;


    $sql = "SELECT username 
   	          FROM users
   	          WHERE user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$userID]);

    if($stmt->rowCount() > 0){
        $em = "Can not use ($userID) as userID.";

        echo $em ; 

        header("Location: ../../procreat.php?error=$em&$data");
        exit;
    }
    else{
        $data = $data.'name'.$name.'userID'.$userID;

        echo isset($_FILES['pp']);

        # Profile Picture Uploading
      	if (isset($_FILES['pp'])) {
            
            
            # get data and store them in var
            $img_name  = $_FILES['pp']['name'];
            $tmp_name  = $_FILES['pp']['tmp_name'];
            $error  = $_FILES['pp']['error'];

            # if there is not error occurred while uploading
            if($error === 0){
             
             # get image extension store it in var
               $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);

             /** 
              convert the image extension into lower case 
              and store it in var 
              **/
              $img_ex_lc = strtolower($img_ex);

              /** 
              crating array that stores allowed
              to upload image extension.
              **/
              $allowed_exs = array("jpg", "jpeg", "png");

              /** 
              check if the the image extension 
              is present in $allowed_exs array
              **/
              if (in_array($img_ex_lc, $allowed_exs)) {
                  /** 
                   renaming the image with user's username
                   like: username.$img_ex_lc
                  **/
                  $new_img_name = $userID. '.'.$img_ex_lc;

                  # crating upload path on root directory
                  $img_upload_path = '../../uploads/'.$new_img_name;

                  # move uploaded image to ./upload folder
                  move_uploaded_file($tmp_name, $img_upload_path);
              }else {
                  $em = "You can't upload files of this type";
                    header("Location: ../../procreat.php?error=$em&$data");
                     exit;
              }

            }
        }

        # if the user upload Profile Picture
      	if (isset($new_img_name)) {

          # update data
          $sql3 = "UPDATE users SET name=? ,user_id=? ,p_p=? WHERE username=?";
          $stmt3 = $conn->prepare($sql3);
          $stmt3->execute([$name,$userID,$new_img_name, $_SESSION['username']]);
          $sm = "Account created successfully with image";

        }else {
            # update data
            $sql3 = "UPDATE users SET name=? ,user_id=? WHERE username=?";
            $stmt3 = $conn->prepare($sql3);
            $stmt3->execute([$name,$userID, $_SESSION['username']]);
            $sm = "Account created successfully without image";
        }


        # success message
       


        # redirect to 'index.php' and passing success message
        session_unset();
        session_destroy();
        echo $sm;
        header("Location: ../../index.php?success=$sm");
        exit;
       
    }

   }
   else {
    header("Location: ../../index.php");
    exit;
  }

?>