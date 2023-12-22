<?php
session_start();
if(isset($_SESSION['username']))
{
    $username= $_SESSION['username'];
    unset($_SESSION['username']);
}
if($_SERVER['REQUEST_METHOD'] === 'POST')
{    
     $_SESSION['touristId'] = $_POST['tid'];
     $id =$_SESSION['touristId'];
     echo "WELCOME {$id} <br>";
}
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
    <link rel="stylesheet" type="text/css" href="../css/main.css">  
    <link rel="stylesheet" href="../css/tour_cs.css">
    <link rel="stylesheet" href="../css/touristpr.css">
    
    <title>SERENDIB TRAVELS | GUIDE PROFILE></title>
</head>
<?php
include 'inc/nav.php';

if($id == null)
    {
        header('Location:login.php');
        exit;
    }
include 'logics/touristlogic.php';
    $_SESSION['userN']=$user_name;
?>
<main>

    <div class="slideshow-container">
      <div class="slide">
        <img src="../images/image1.jpg" alt="Image 1">
      </div>
      <div class="slide">
        <img src="../images/image2.jpg" alt="Image 2">
      </div>
      <div class="slide">
       <img src="../images/image3.jpg" alt="Image 3">
      </div>
    </div>
   
    <div class="profile-tittle">
             <div class="profile-pic-container">
                 <img src="<?php echo$user['pic_link']?>" alt="profilePic" id="pfp">
             </div>
             <div class="profile-name">
                 <h1><?php echo $user['username'];?></h1>
             </div>
             <div class="tid-container">
                 <h1>TOR  <?php echo $user['touristId'];?></h1>
             </div>
     </div>

     <div class="t-details-container">
        <h2>Email : <?php echo $user['email'] ?></h2>
        <h2>Date of Birth : <?php echo $user['dob'] ?></h2>
        <h2>City : <?php echo $user['city'] ?></h2>
        <h2>First Name : <?php echo $user['firstName'] ?></h2>
        <h2>Last Name : <?php echo $user['lastName'] ?></h2>
        <h2>Address: <?php echo $user['address'] ?></h2>
        <h2>Member Since : <?php echo $user['dreg'] ?></h2>
        <h2>Loyalty Level : <?php echo $user['loyalty'] ?></h2>
        
        <button class="anime-button" onclick="viewCd()">Edit personal details</button>
     </div>


     <div class="hide" id="cdf">
     <div class="cd-container">
        <div class="cd-tittle">
            <h2>Edit personal details</h2>
            <button onclick="hideCd()">close</button>
        </div>
        
        <div class="cd-form">
            <form action="updatetourist.php" method ="POST" enctype="multipart/form-data">
                <input type="text" placeholder="User Name" value="<?php echo $user['username']?>" name="username" >
                <input type="hidden" name="preImg" value=<?php echo$user['pic_link'];?>>
                <input type="file" name="t_img" id="tImage" accept="image/*">
                <input type="text" placeholder="First Name" value="<?php echo $user['firstName']?>" name="fname">
                <input type="text" placeholder="Last Name" value="<?php echo $user['lastName']?>" name="lname">
                <input type="text" placeholder="City" value="<?php echo $user['city']?>" name="city">
                <input type="tel" placeholder="Contact no" value="<?php echo $user['phone']?>" name="tel">
                <input type="email" placeholder="Email" value="<?php echo $user['email']?>" name="email">
                <input type="date" palceholder="Date of Birth" value="<?php echo $user['dob']?>" name="dob" >
                <textarea placeholder="Address" name="adrs"id="adrs" cols="30" rows="10"><?php echo $user['address']?></textarea>
                <input type="hidden" value=<?php echo $id ?> name="tid">
                <input type="submit" onclick="hideCd()" value="Edit Details">
            </form>
        </div>
     </div>
     </div>
     
     
     <?php if($user['city'] != null) 
         echo '<h1 class="tt-text"> Tours around your current city </h1>';
         echo '<div class= "personalize-recomandation">';
           include_once 'inc/tour_pack.php';
           showSearchResults($user['city'],$packages);
         echo '</div>';  
     ?>

     <?php 
         $sql = 'SELECT * from payment where tId = ?';
         $state = $conn->prepare($sql);
         $state->bind_param("i",$user['touristId']);
         $state->execute();
         $res = $state->get_result();
         $payments = mysqli_fetch_all($res,MYSQLI_ASSOC);
         if($payments != null){ 
         echo'<h1 class ="tt-text">My Payments</h1>';
         echo'<div class ="payment-container">';
         echo '<table>';
         echo '<tr>';
             echo '<td>Payment Id</td>';
             echo '<td>Payment Method</td>';
             echo '<td>Amount</td>';
             echo '<td>Departure</td>';
             echo '<td>Arrival</td>';
             echo '<td>Adults</td>';
             echo '<td>Children</td>';
             echo '<td>Package ID</td>';
             echo '<td>Guide ID</td>';
             echo'</tr>';
         foreach($payments as $pay)
         {
            drawPaymentsRows($pay);

         }
         echo'</table>';
         
         echo '</div>';}
         function drawPaymentsRows($pay)
         {
             echo '<tr>';
             echo '<td> OTG-PAY-'.$pay['payId'].'</td>';
             echo '<td>'.$pay['pmethod'].'</td>';
             echo '<td>'.$pay['amount'].'</td>';
             echo '<td>'.$pay['departure'].'</td>';
             echo '<td>'.$pay['arrival'].'</td>';
             echo '<td>'.$pay['adults'].'</td>';
             echo '<td>'.$pay['children'].'</td>';
             echo '<td> PKG- '.$pay['pkgId'].'</td>';
             echo '<td> TOG- '.$pay['gId'].'</td>';
             echo'</tr>';
         }   
     ?>
     <script src="../javascripts/touristprofile.js"></script>
</main>
<?php
include 'inc/footer.php';
?>