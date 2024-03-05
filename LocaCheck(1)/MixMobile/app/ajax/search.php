<?php

session_start();

# check if the user is logged in
if (isset($_SESSION['username'])) {
    # check if the key is submitted
    if(isset($_POST['key'])){
       # database connection file
	   include '../db.conn.php';

	   # creating simple search algorithm :) 
	   $key = $_POST['key'];
     
	   $sql = "SELECT * FROM users
	           WHERE user_id
	           = ?";
       $stmt = $conn->prepare($sql);
       $stmt->execute([$key]);

       if($stmt->rowCount() > 0){ 
         $users = $stmt->fetchAll();

         foreach ($users as $user) {
         	if ($user['user_id'] == $_SESSION['user_id']) continue;
       ?>
       <li class="chat-row-group">
		<a href="chat.php?user=<?=$user['username']?>"
		class="chat-row">
			<div class="d-flex
			            align-items-center">
				<div class="cir">
			    <img src="uploads/<?=$user['p_p']?>"
			         class="w-10 rounded-circle">
					 </div>
					 
			    <h3>
			    	<?=$user['name']?>
			    </h3>            	
			</div>
		 </a>
	   </li>

       <?php } }else { ?>
         <div class="alert alert-info 
    				 text-center">
		   <i class="fa fa-user-times d-block fs-big"></i>
           The user "<?=htmlspecialchars($_POST['key'])?>"
           is  not found.
		</div>
    <?php }
    }

}else {
	header("Location: ../../index.php");
	exit;
}