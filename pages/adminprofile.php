
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
    <link rel="stylesheet" href="../css/admin.css">         
    <title>ADMIN PROFILE</title>
</head>

<?php include 'inc/admin_nav.php';  
  include 'logics/adminlogic.php'; 
  if($_SESSION['ademail']==null)
  {
    header("Location:adminportal.php");
  }  
?>

<script>
    let nav_admin = document.getElementById('admin_nav');
    nav_admin.classList.remove('hide');
</script>

    <main>
         <div class="left-side">
             <div class="upper-sec">
                <div class="pic-sec">
                    <img src=<?php echo $profile_img?> id="profile-pic">
                </div>
                <div class="details-sec">
                     <h1><?php echo $user_name?></h1>
                     <h2>ID : ADM <?php echo $ad_id?></h2>
                     <h3>Member Since : <?php echo $date_reg?></h3>
                </div>

             </div>
             <div class="down-sec">
                <h1>Personal Details</h2>
                <h2>First Name : <?php echo $fname ?></h2>
                <h2>Last Name : <?php echo $lname ?></h2>
                <h2>Address : <p><?php echo $address ?></p></h2> 
                <h2>City : <?php echo $city ?></h2>
                <h2>Telephone : <?php echo $telephone ?></h2>
                <h2>Email : <?php echo $email ?></h2>
                <h2>Date of Birth : <?php echo $dob ?></h2>
                <button onclick="viewCd()">Change Details</button>
             </div>
              
         </div>
         <div class="right-side">
               <div class="site-ctrl-sec">
                <h1 class="tt-text">Site Tasks</h1>
                <h3><a href="#pkg-mng-sec">Package Manager</a></h3>
                <h3><a href="#payment-sec">Transaction Details</a></h3>
                <h3><a href="#">Filter reviews</a></h3>
                <h3><a href="#">View pages as admin</a></h3>
                <h3><a href="#">Set Loyalty Bonus</a></h3>
                <h3><a href="#">Add an admin</a></h3>
                <h3><a href="#" onclick="viewPop()">Reset Password</a></h3>
               </div>
               <div class ="site-overview-sec">
            
                   <h1 class="tt-text">Site Performance</h1>
                   <h2>Total Tourists : <?php echo $t_tourists ?></h2>
                   <h2>Total Guides : <?php echo $t_guides ?></h2>
                   <h2>Total Tour Packages :<?php echo $t_packs ?> </h2>
                   <?php
                        $sql = 'SELECT SUM(amount) as amx from payment';
                        $res = mysqli_query($conn,$sql);
                        $paym = mysqli_fetch_all($res,MYSQLI_ASSOC);                        
                        $t_transactions = $paym[0]['amx'];
                   ?>
                   <h2>Total Transactions :<?php echo "RS ". $t_transactions ?> </h2>
               </div>

         </div>               
    </main>
    <div class="package-manager-container" id ="pkg-mng-sec">
        <h1 class="tt-text">Package Manager</h1>
        <?php
            $sql = 'SELECT * FROM tourPackage';
            $results = mysqli_query($conn,$sql);
            $packages = mysqli_fetch_all($results,MYSQLI_ASSOC); 
            echo '<table>';
            echo'<tr id="tr-pkg">
                <td>Package Id</td>
                <td>Package Name</td>
                <td>Destination</td>
                <td>Rating</td>
                <td>Guide Id</td>
                <td>Availabillity</td>
                <td>Package Price</td>
                <td></td>
                <td></td>
            </tr>';
            foreach($packages as $pkg)
            {
               
               drawTable($pkg);
            }
            echo '</table>';

            function drawTable($pkg)
            {
                $id = $pkg['pkgId'];
                echo '<tr>';
                echo '<td>PKG- '.$pkg['pkgId'].'</td>';
                echo '<td>'.$pkg['pkgName'].'</td>';
                echo '<td>'.$pkg['destination'].'</td>';
                echo '<td>'.$pkg['rating'].'</td>';
                echo '<td>TOG- '.$pkg['guideId'].'</td>';
                if(!$pkg['availabillity'])
                {
                    echo '<td>NO</td>';
                }
                else
                {
                    echo '<td>YES</td>';
                }
                echo'<td>'.$pkg['priceAdult'].'</td>';
                echo'<td><button id="rem-btn" data-button-id='.$id.' onclick="callRemove(this)">Remove</button></td>';
                if($pkg['rating']<1)
                {
                    echo'<td><button id="app-btn" data-button-id='.$id.' onclick="callApprove(this)">Approve</button></td>';
                }
                echo '</tr>';
                
            }
            
        ?>
       
       

    </div>
    <div class="package-manager-container" id ="payment-sec">
        <h1 class="tt-text">Transactions</h1>
        <?php 
         $sql = 'SELECT * from payment';
         $res = mysqli_query($conn,$sql);
         $payments = mysqli_fetch_all($res,MYSQLI_ASSOC);
         if($payments != null){
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
             echo '<td>Tourist ID</td>';
             echo'</tr>';
         foreach($payments as $pay)
         {
            drawPaymentsRows($pay);

         }
         echo'</table>';}
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
             echo '<td> TOU- '.$pay['tId'].'</td>';
             echo'</tr>';
         }
         echo '</div>';
            
     ?>
    </div>
    <div id="pwd-reset" class ="hide">
        <div class="reset-container">
            <div class="reset-tittle">
                <h2>RESET PASSWORD</h2>
                <button onclick="hidePop()">CLOSE</button>
            </div>
            <div class="reset-form">
                <form action="logics/adminpassreset.php" method="POST">
                    <input type="password" placeholder="Old Password" name="opwd" ><br>
                    <input type="password" placeholder="New Password" name="npwd" ><br>
                    <input type="password" placeholder="Confirm Password"name="repwd" ><br>
                    <input type="hidden" value=<?php echo $ad['adminId']; ?> name="adminId">
                    <input type="submit" value="Change" onclick="hidePop()">
                </form>
            </div>
        </div>
    </div>
    


    <div class="hide" id="cdf">
     <div class="cd-container">
        <div class="cd-tittle">
            <h2>Edit personal details</h2>
            <button onclick="hideCd()">close</button>
        </div>
        
        <div class="cd-form">
            <form action="updateadmin.php" method ="POST">
                <input type="text" placeholder="User Name" value="<?php echo $user['username']?>" name="username" >
                <input type="text" placeholder="First Name" value="<?php echo $user['firstName']?>" name="fname">
                <input type="text" placeholder="Last Name" value="<?php echo $user['lastName']?>" name="lname">
                <input type="text" placeholder="City" value="<?php echo $user['city']?>" name="city">
                <input type="tel" placeholder="Contact no" value="<?php //echo $telephone?>" name="tel">
                <input type="email" placeholder="Email" value="<?php echo $user['email']?>" name="email">
                <input type="date" palceholder="Date of Birth" value="<?php echo $user['dob']?>" name="dob" >
                <textarea placeholder="Address" name="adrs" value="<?php echo $user['address']?>" id="adrs" cols="30" rows="10"></textarea>
                <input type="hidden" value=<?php echo $id ?> name="aid">
                <input type="submit" onclick="hideCd()" value="Edit Details">
            </form>
        </div>
     </div>
     </div>
     <script src="../javascripts/adminprofile.js"></script>
</body>
</html>