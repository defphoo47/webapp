

<?php 
  session_start();

  if (isset($_SESSION['username'])) {
  	# database connection file
  	include 'app/db.conn.php';

  	include 'app/helpers/user.php';

  	# Getting User data data
  	$user = getUser($_SESSION['username'], $conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC749Xmb9AbSXgBF_Dyaq2vepvdCjPJY2s"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L-Check Home-page</title>
</head>
<body>
    
    <div class="containAll">
    <div id="map-container""></div>
    <div class="logo">
    <img src="img/logoL.png" >
     </div>
     <a href="profile.php?backto=map">
        <div class="profile">
            <img id = "propic" src="uploads/<?=$user['p_p']?>" >
        </div>
    </a>
    <div class="to-chat">
        <a href="home.php">
        <svg
        class="icon"
        width="56"
        height="56"
        viewBox="0 0 56 56"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <rect
          x="0.5"
          y="0.5"
          width="55"
          height="55"
          rx="27.5"
          stroke="#EBEBEB"
        />
        <path
          d="M19.7383 41.1133C21.3672 41.1133 24.6602 39.5312 27.1328 37.7734C35.3945 37.9258 41.5703 33.1445 41.5703 26.8867C41.5703 20.8398 35.5352 15.9766 28 15.9766C20.4648 15.9766 14.4297 20.8398 14.4297 26.8867C14.4297 30.7305 16.832 34.1758 20.5 35.957C19.9961 36.918 19.0938 38.2305 18.5898 38.8984C17.8516 39.8828 18.3555 41.1133 19.7383 41.1133ZM21.1328 38.7344C21.0039 38.793 20.9453 38.7109 21.0391 38.5938C21.6367 37.8438 22.5273 36.6836 22.9609 35.875C23.3125 35.2305 23.1836 34.668 22.4336 34.3164C18.8594 32.6289 16.7852 29.957 16.7852 26.8867C16.7852 22.1641 21.7539 18.3203 28 18.3203C34.2461 18.3203 39.2148 22.1641 39.2148 26.8867C39.2148 31.6094 34.2461 35.4531 28 35.4531C27.7773 35.4531 27.4609 35.4414 27.0391 35.4297C26.5352 35.4297 26.1602 35.582 25.6914 35.9453C24.2852 36.9883 22.1875 38.3125 21.1328 38.7344Z"
          fill="white"
        />
      </svg></a>
    </div>
  </div>

</body>

<style>

.to-chat{
    position:fixed;
    bottom:7%;
    left: 50%;
    transform: translateX(-50%);
    display:flex;
    justify-content: center;
    align-items:center;
    background: #fe51b0;
    border-radius: 10px;
    width: 80px;
    height: 75px;
    box-shadow: 2px 4px 20px 3px rgba(0, 0, 0, 0.15),
             3px 2px 20px 7px rgba(0, 0, 0, 0.25);
}

#map-container{
    position:fixed;
    left: 50%;
    width:100%;
    height: 100%;
    transform: translateX(-50%);
}

.containAll{
    display:flex;
    height: 745px;
}

body{
    background: black;
}

.profile {
    position:fixed;
    top:10%;
    right:15px;
    display:flex;
    justify-content: center;
    align-items:center;
    border-radius:50px;
    box-shadow: 2px 4px 20px 3px rgba(0, 0, 0, 0.15), 
                3px 2px 20px 7px rgba(0, 0, 0, 0.25);
}

.logo{
    position:fixed;
    top:10%;
    left:15px;
    width: 90px;
    height: 90px;
    display:flex;
    justify-content: center;
    align-items:center;
    background:#000000;
    border-radius: 10px;
}

.logo img{
   height: 75%;
}

.profile img{
    border-radius:50%;
    width: 80px;
    height: 80px;
}

</style>


<script>
    function initMap() {
      // Replace these with your desired coordinates
      var lat = 13.7339664;
      var lng = 101.755512931878;
      
      var mapOptions = {
        zoom: 15,
        center: {lat: lat, lng: lng}
      };
      
      var propic = document.getElementById("propic");
      var filename = propic.src.split('/')[5];

      var map = new google.maps.Map(document.getElementById("map-container"), mapOptions);
    //----------------------------------------------------------------
      var selfMarker = new google.maps.Marker({
        position: { lat: 13.727, lng: 101.762 },
        map: map,
        title: "self Marker",
        url: "profile.php?", // Replace with your desired link
        icon: {
          url: "uploads/"+filename,
          scaledSize: new google.maps.Size(50, 50) 
          //"https://cdn.discordapp.com/attachments/968308402201718864/1214230958711246928/image.png?ex=65f85bb3&is=65e5e6b3&hm=e1ce722d8e5e344618956a9498751dafd284e9b79c000359e894b0514e5c781b&"
        }
    });
      google.maps.event.addListener(selfMarker, "click", function () {
        window.location.href = selfMarker.url;
      });

    //------------------------------------------------------------------
    var AuMarker = new google.maps.Marker({
        position: {lat: 13.731, lng: 101.751},
        map: map,
        title: "Au Marker",
        url: "profileF.php?user=au@mail",
        scaledSize: new google.maps.Size(5, 5),
        icon: {
          url: "uploads/ausa007.jpg",
          scaledSize: new google.maps.Size(50, 50) 
        }
      });
      google.maps.event.addListener(AuMarker, "click", function () {
        window.location.href = AuMarker.url;
      });
    //------------------------------------------------------------------
    var bossMarker = new google.maps.Marker({
        position: {lat: 13.72669, lng: 101.752},
        map: map,
        title: "boss Marker",
        url: "profileF.php?user=boss@mail",
        scaledSize: new google.maps.Size(5, 5),
        icon: {
          url: "uploads/boss000.png",
          scaledSize: new google.maps.Size(50, 50) 
          //"https://maps.google.com/mapfiles/ms/icons/boss-dot.png"
        }
      });
      google.maps.event.addListener(bossMarker, "click", function () {
        window.location.href = bossMarker.url;
      });
      //------------------------------------------------------------------
      var gameMarker = new google.maps.Marker({
        position: {lat: 13.735, lng: 101.753},
        map: map,
        title: "game Marker",
        url: "profileF.php?user=game@mail",
        scaledSize: new google.maps.Size(5, 5),
        icon: {
          url: "uploads/game000.png",
          scaledSize: new google.maps.Size(50, 50) 
          //"https://maps.google.com/mapfiles/ms/icons/game-dot.png"
        }
      });
      google.maps.event.addListener(gameMarker, "click", function () {
        window.location.href = gameMarker.url;
      });
      //------------------------------------------------------------------
      var bankMarker = new google.maps.Marker({
          position: {lat: 13.733, lng: 101.758},
          map: map,
          title: "bank Marker",
          url: "profileF.php?user=bank@mail",
          scaledSize: new google.maps.Size(5, 5),
          icon: {
            url: "uploads/bank000.png",
            scaledSize: new google.maps.Size(50, 50) 
            //"https://maps.google.com/mapfiles/ms/icons/bank-dot.png"
          }
        });
        google.maps.event.addListener(bankMarker, "click", function () {
          window.location.href = bankMarker.url;
        });
        //------------------------------------------------------------------
      var opicMarker = new google.maps.Marker({
          position: {lat: 13.74, lng: 101.751},
          map: map,
          title: "opic Marker",
          url: "profileF.php?user=opic@mail",
          scaledSize: new google.maps.Size(5, 5),
          icon: {
            url: "uploads/opic000.jpeg",
            scaledSize: new google.maps.Size(50, 50) 
            //"https://maps.google.com/mapfiles/ms/icons/opic-dot.png"
          }
        });
        google.maps.event.addListener(opicMarker, "click", function () {
          window.location.href = opicMarker.url;
        });
        //------------------------------------------------------------------
      var bestMarker = new google.maps.Marker({
          position: {lat: 13.744, lng: 101.757},
          map: map,
          title: "best Marker",
          url: "profileF.php?user=best@mail",
          scaledSize: new google.maps.Size(5, 5),
          icon: {
            url: "uploads/best000.jpg",
            scaledSize: new google.maps.Size(50, 50) 
            //"https://maps.google.com/mapfiles/ms/icons/best-dot.png"
          }
        });
        google.maps.event.addListener(bestMarker, "click", function () {
          window.location.href = bestMarker.url;
        });
        //------------------------------------------------------------------
        var zoomMarker = new google.maps.Marker({
            position: {lat: 13.729, lng: 101.755},
            map: map,
            title: "zoom Marker",
            url: "profileF.php?user=zoom@mail",
            scaledSize: new google.maps.Size(5, 5),
            icon: {
              url: "uploads/zoom000.jpeg",
              scaledSize: new google.maps.Size(50, 50) 
              //"https://maps.google.com/mapfiles/ms/icons/zoom-dot.png"
            }
          });
          google.maps.event.addListener(zoomMarker, "click", function () {
            window.location.href = zoomMarker.url;
          });
    
    }
    initMap();
  </script>

</html>

<?php
  }else{
  	header("Location: index.php");
   	exit;
  }
 ?>


<!-- 
 function initMap() {
    
  
      
    
  
     -->