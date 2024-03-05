<?php 
  session_start();

  if (isset($_SESSION['username'])) {
  	# database connection file
  	include 'app/db.conn.php';

  	include 'app/helpers/user.php';
  	include 'app/helpers/conversations.php';
    include 'app/helpers/timeAgo.php';
    include 'app/helpers/last_chat.php';

  	# Getting User data data
  	$user = getUser($_SESSION['username'], $conn);

  	# Getting User conversations
  	$conversations = getConversation($user['ID'], $conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	
	<link rel="icon" href="img/logoL.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" 
	      href="css/style_home3.css">


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
          
          <title>L-Check Messages</title>
    </head>
  <body>
    
    <div class="home-page">
        <div id = "box-all">
    		<!-- <div class="d-flex
    		            mb-3 p-3 bg-light
			            justify-content-between
			            align-items-center">
    			<div class="d-flex
    			            align-items-center">
    			    <img src="uploads/<?=$user['p_p']?>"
    			         class="w-25 rounded-circle">
                    <h3 class="fs-xs m-2"><?=$user['name']?></h3> 
    			</div>
    			<a href="logout.php"
    			   class="btn btn-dark">Logout</a>
    		</div> -->

			

			<div class = "Message">
			<a href="map.php">
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
                    stroke="#ffffff"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    />
                    <path
                    d="M12 19L5 12L12 5"
                    stroke="#ffffff"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    />
                </svg>
            </a>
			Messages
			
			<a href="profile.php">
			<div class="cir">
			<img src="uploads/<?=$user['p_p']?>"
			     class="w-10 rounded-circle">
			</div>
			</a>
		</div>

    		<div class="input-bar">
    			<input type="text"
    			       placeholder="Search..."
    			       id="searchText">
    			<button  id="serachBtn">
    			        <i class="fa fa-search"></i>	
    			</button>       
    		</div>

			<h4 style="margin-left:10px;
					margin-top:10px;
					color:white;">RECENT</h4><br>


		   <div class="scrollprofile">
    			<?php if (!empty($conversations)) { ?>
    			    <?php 

    			    foreach ($conversations as $conversation){ ?>
	    			<div class="chat-row-group">
	    				<a href="profileF.php?user=<?=$conversation['username']?>&backto=home"
	    				   class="chat-row">
	    					<div>
							<div class="cir">
	    					   	 <img src="uploads/<?=$conversation['p_p']?>">
					            </div>  	
	    					</div>
	    					<?php if (last_seen($conversation['last_seen']) == "Active") { ?>
		    					<div title="online">
		    						<div class="online"></div> 
		    					</div>
	    					<?php } ?>
	    				</a>
					</div>
    			    <?php } 
					   }
					?>
    		</div>		




			<div class ="box-list">
    		<ul id="chatList"
    		    class="list-group mvh-50 overflow-auto">
    			<?php if (!empty($conversations)) { ?>
    			    <?php 

    			    foreach ($conversations as $conversation){ ?>
	    			<li class="chat-row-group">
	    				<a href="chat.php?user=<?=$conversation['username']?>"
	    				   class="chat-row">
	    					<div class="d-flex
	    					            align-items-center">
								<div class="cir">
	    					   	 <img src="uploads/<?=$conversation['p_p']?>">
					            </div>
	    					    <h3>
	    					    	<?=$conversation['name']?><br>
                      <small>
                        <?php 
                          echo lastChat($_SESSION['ID'], $conversation['ID'], $conn);
						?>
						  <div>
						  <?php echo $conversation['last_seen'];  ?>
						  </div>
                      
                      </small>
	    					    </h3>            	
	    					</div>
	    					<?php if (last_seen($conversation['last_seen']) == "Active") { ?>
		    					<div title="online">
		    						<div class="online"></div>
		    					</div>
	    					<?php } ?>
	    				</a>
	    			</li>
    			    <?php } ?>
    			<?php }else{ ?>
    				<div class="alert alert-info 
    				            text-center">
					   <i class="fa fa-comments d-block fs-big"></i>
                       No messages yet, Start the conversation
					</div>
    			<?php } ?>
	
    		</ul>
			</div>

		</div>
    </div>
	  

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>


	$(document).ready(function(){
      
       //Search
    //    $("#searchText").on("input", function(){
    //    	 var searchText = $(this).val();
    //      if(searchText == "") return;
    //      $.post('app/ajax/search.php', 
    //      	     {
    //      	     	key: searchText
    //      	     },
    //      	   function(data, status){ 
    //               $("#chatList").html(data);
    //      	   });
    //    });
	

       // Search using the button
       $("#serachBtn").on("click", function(){
       	 var searchText = $("#searchText").val();
         if(searchText == "") return;
         $.post('app/ajax/search.php', 
         	     {
         	     	key: searchText
         	     },
         	   function(data, status){
                  $("#chatList").html(data);
         	   });
       });


      /** 
      auto update last seen 
      for logged in user
      **/
      let lastSeenUpdate = function(){
      	$.get("app/ajax/update_last_seen.php");
      }
      lastSeenUpdate();
      /** 
      auto update last seen 
      every 10 sec
      **/
      setInterval(lastSeenUpdate, 10000);

    });
</script>
</body>
</html>
<?php
  }else{
  	header("Location: index.php");
   	exit;
  }
 ?>