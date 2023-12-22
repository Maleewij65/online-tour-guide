<?php include 'pages/config/database.php'; 
$img1="images/about1.jpg";
$img2="images/about2.jpg";
$img3="images/about3.jpg";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&family=Poppins:wght@200;400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/main.css"> 
                                   >    
    <script src="javascripts/mapviews.js"></script> 
       
    <link rel="stylesheet" type="text/css" href ="css/home_cs.css">

    <title>SERENDIB TRAVELS </title>
</head>
<body>    
    <div class="wrapper">
        <header>
            <a href="#"><img id="logo" src="images/logo.svg" alt=""></a>
            <nav>
                <ul>
                    <li><a href="index.php" class="active ">Home</a></li>
                    <li><a href="pages/about.php">About</a></li>
                    <li><a href="pages/tours.php">Tours</a></li>
                    <li><a href="pages/guides.php">Guides</a></li>
                    <li><a href="pages/register.php">Register</a></li>
                </ul>
            </nav>
        </header>
       <main>
            <div class="left-side">
                <div class="hero-sec">
                <h1>The journey of a thousand miles begins with a single step</h1>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
                   Est aperiam ducimus, nihil quibusdam assumenda 
                   quidem soluta sequi! Illum, qui expedita!
                </p>
                </div>
                <h1>Where you wish to go next ? </h1>
                <div class="search-bar">
                    <form action="pages/tours.php" method="get">
                        <input type="text" name="destination" id="dest" placeholder="DESTINATION">
                        <input type="submit" value="GO" id="go-btn">
                    </form>
                </div>
                <h1>Explore...</h1>

                <div class="tour-wrapper" id='cont'>
                    <img src="images/about1.jpg" id="im1">
                    <img src="images/about2.jpg" id="im2" >
                    <img src="images/about3.jpg" id="im3">
                    <script src = "javascripts/home.js"></script>
                </div>
            </div>
            <div class="right-side">
                <div id="map">
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD5LDgz9jr79Iwa2bwRVUnWcIYWRO6T6Hw&callback=initMap"></script>

                </div>
            </div>
        </main>
        <div class="promo">
           <video autoplay muted loop>
                <source src="videos/promo_vid.mp4" type="video/mp4">
            </video>
        </div>  

<?php include 'pages/inc/footer.php'?>        