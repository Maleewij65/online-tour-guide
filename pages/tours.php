
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&family=Poppins:wght@200;400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/main.css"> 
    <link rel="stylesheet" href="../css/tour_cs.css">
    <link rel="stylesheet" href="../css/guide_cs.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <title>SERENDIB TRAVELS | TOURS </title>
</head>
<?php include 'inc/nav.php'?>
<?php include 'inc/tour_pack.php'?>
<script src="../javascripts/tours_js.js"></script>
        <main>
        
            
            <h1 class="tt-text">Search Results</h1>
            <div class="tp-results-container" id="searchR">
            <?php 
            if ($_SERVER['REQUEST_METHOD'] === 'GET') 
            {
        
                if($_GET['destination'] != null)
                {
                    echo '<script>
                    let searchDiv = document.getElementById(\'searchR\');
                    searchDiv.classList.remove(\'hide\');
                    </script>';
                    $dest = $_GET['destination'];
                    showSearchResults($dest,$packages);
                }
                
                
                else
                {
                    echo '<script>
                    let searchDiv = document.getElementById(\'searchR\');
                    searchDiv.classList.add(\'hide\');
                    </script>';
                }
                
                
            }
            if($_SERVER['REQUEST_METHOD']==='POST')
                {
                    if(isset($_POST['gid_guide']))
                    {
                        echo '<script>
                    let searchDiv = document.getElementById(\'searchR\');
                    searchDiv.classList.remove(\'hide\');
                    </script>';
                        $gid_from_guides=(int)$_POST['gid_guide'];
                        //guide results
                        SortPackagesByGuideId($gid_from_guides,$packages);
                    }     
                }
                else
                {
                    echo '<script>
                    let searchDiv = document.getElementById(\'searchR\');
                    searchDiv.classList.add(\'hide\');
                    </script>';
                }
            ?>
            </div>
            <h1 class="tt-text">Popular Destinations</h1>
            <div class="tp-results-container">
                <?php
                     
                    SortPackagesByRatings(8,$packages); 
                ?>                
            </div>
            <h1 class="tt-text">All packages</h1>
            <div class="tp-results-container">
                <?php
                     //implement POPdestionation function in the tour_pack 
                    SortPackagesByRatings(1,$packages);
                ?>                
            </div>
            <?php
                
                //include 'ajax_handler.php';
                
             ?>
            <div class="ct-request-container">
                 <h1 class="tt-text">Submit a custom tour request</h1>
                 <div class="tour-form">
                <form action="logics/customtourrequest.php" method="POST">
                <label for="name">Guide Id "use only the number":</label>
                <input type="text" id="name" name="gid" required>
                <br><br>

                <label for="email">Your Email:</label>
                <input type="text" id="email" name="email" required>
                <br><br>

                <label for="destination">Destination:</label>
                <input type="text" id="destination" name="destination" required>
                <br><br>

                <label for="duration">Duration (in days):</label>
                <input type="text" id="duration" name="duration" required>
                <br><br>

                <label for="message">Additional Information:</label>
                <textarea id="message" name="message" rows="5" cols="50"></textarea>
                <br><br>

                <input type="submit" value="Submit Request">
                </form>
            </div>
                 
            </div>

            '<div class="hide" id="tour-view">
            <div class="pop-up-tour">
            <div class="pop-up-top">                    
            <div><h2 id="pkg-name-pop"></h2></div>
            <div><h2 id="pkg-guide-name-pop"></h2></div>
            <div id="pkg-id">
            <h3 id="pkg-id-pop"></h3>
            <button id="close-tour" onclick="hideT()">close</button>
            </div>      
            </div>
            <div class="pop-up-sumerry">
            <div class="p-sumerry">
            <h2 id="destination-pop"></h2>
            <h2 id ="duration-pop"></h2>
            <h2 id="avail-pop"></h2>
            </div>
            <div class ="btn-review">
                <?php if(isset($tid_nav)){echo'<button onclick="showReview()">Add Review</button>';} ?>
                
            </div>    
            </div>
            <div class="pop-up-mid">
            <div class="activities">
                <h4>Description</h4>
                <p id="description-pop"> </p>
                
            </div>
            <h4>Reviews</h4>
            <div class="reviews-package" id="rpk">
                
                
                
            </div>
            </div>
            <div class="pop-up-bottom">
            <div class="guide-sec">
                <img id="pkg-img-pop" src="" alt ="pkgImage">
            </div>
            <div class="price-sec">
                <h3 id="price-pop">Price for a member :</h3>
                <h3 id="priceC-pop">Price for a child :</h3>
                <h3 id="priceA-pop">Price for a aditional member :</h3>
                <button id="book-btn" onclick="callBook(this)">BOOK NOW</button>
            </div>
            </div></div></div>;
            <div id="review-container" class="hide">
            <form action="logics/reviewhandler.php" method="POST">
            <label for="rating">Rating:</label>
            <select id="rating" name="rating">
            <option value="10">10 Stars</option>
            <option value="9">9 Stars</option>
            <option value="8">8 Stars</option>
            <option value="7">7 Stars</option>
            <option value="6">6 Star</option>
            <option value="5">5 Stars</option>
            <option value="4">4 Stars</option>
            <option value="3">3 Stars</option>
            <option value="2">2 Stars</option>
            <option value="1">1 Star</option>
            </select>
            <br><br>
    
            <label for="tourist_name">Tourist Username:</label>
            <input type="text" id="tourist_name" name="tourist_name" value=<?php echo $_SESSION['userN'];?> disabled>
            <input type="hidden" id="r1" name="touristId" value=<?php echo $tid_nav;?>>
            <input type="hidden" id="r2" name="pkgId" value="">
            </br><br>
    
            <label for="review">Review:</label>
            <textarea id="review" name="review" rows="5" cols="50"></textarea>
            <br><br>
            <div class="review-btn">
            <input type="submit" value="Submit Review"><button>Close</button>
            </div>
            </form></div>     

            <script src="../javascripts/tours_js.js"></script>

        </main>
    
<?php include 'inc/footer.php';
?>