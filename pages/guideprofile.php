
<?php
    session_start();
    if(isset($_SESSION['username']))
    {
        $username= $_SESSION['username'];
        unset($_SESSION['username']);
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
         
         $_SESSION['guideId'] = $_POST['gid'];
         $id =$_SESSION['guideId'];
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
    <link rel="stylesheet" href="../css/guide_profile.css">
    <link rel="stylesheet" href="../css/tour_cs.css">
    
    <title>SERENDIB TRAVELS | GUIDE PROFILE></title>
</head>
<?php
   include 'inc/nav.php'; 
   if($id == null)
    {
        header('Location:login.php');
        exit;
    }
   include 'logics/guidelogic.php';
   $_SESSION['userN']=$user_name;
?>
<script src='../javascripts/guideprofile.js'></script>
<main>
         <div class="left-side">
             <div class="upper-sec">
                <div class="pic-sec">
                    <img src=<?php echo $profile_img?> id="profile-pic">
                </div>
                <div class="details-sec">
                     <h1><?php echo $user_name?></h1>
                     <h2>ID : TOG <?php echo $g_id?></h2>
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
             </div>
              
         </div>
         <div class="right-side">
               <div class="site-ctrl-sec">
                <h1 class="tt-text">Quick Access</h1>
                <h3><a href="#sec-pkg">Package Creater</a></h3>
                <h3><a href="#my-packages-sec">My Packages</a></h3>
                <h3><a href="#pkg-tr">Transactions</a></h3>
                <h3><a href="#pkg-rq">Package requests</a></h3>
                <h3><a href="#" onclick="viewPop()">Reset Password</a></h3>
                <h3><a href="#" onclick="viewCd()">Edit Profile</a></h3>
               </div>
               <div class ="site-overview-sec">
            
                   <h1 class="tt-text">Overview</h1>
                   <?php
                        $sql = 'SELECT count(payId) as cout from payment where gId=?';
                        $stat= $conn->prepare($sql);
                        $stat->bind_param("i",$g_id);
                        $stat->execute();
                        $res=$stat->get_result();
                        $paym = mysqli_fetch_all($res,MYSQLI_ASSOC);                        
                        $g_soldcount = $paym[0]['cout'];
                        if($g_soldcount==null)
                        {
                            $g_soldcount = 0;
                        }
                   ?>
                   <h2>Sold packages : <?php echo $g_soldcount ?></h2>
                   <?php
                        $sql = 'SELECT count(pkgId) as cout from tourpackage where guideId=?';
                        $stat= $conn->prepare($sql);
                        $stat->bind_param("i",$g_id);
                        $stat->execute();
                        $res=$stat->get_result();
                        $paym = mysqli_fetch_all($res,MYSQLI_ASSOC);                        
                        $g_packagecount = $paym[0]['cout'];
                        if($g_packagecount==null)
                        {
                            $g_packagecount = 0;
                        }
                   ?>
                   <h2>Total Packages : <?php echo $g_packagecount; ?></h2>
                   <?php
                        $sql = 'SELECT SUM(amount) as amx from payment where gId=?';
                        $stat= $conn->prepare($sql);
                        $stat->bind_param("i",$g_id);
                        $stat->execute();
                        $res=$stat->get_result();
                        $paym = mysqli_fetch_all($res,MYSQLI_ASSOC);                        
                        $g_income = $paym[0]['amx'];
                        if($g_income==null)
                        {
                            $g_income = 0;
                        }
                   ?>
                   <h2>Earned RS :<?php echo"RS ". $g_income; ?> </h2>
               </div>

         </div>               
    </main>
    <div class ="pkg-creater" id="sec-pkg">
         <div class="request-wrapper">
            <div class="hide">
            <h1 class="tt-text">Package Requests</h1>              
            
            </div>
            <div>
                <img id="bpic" src="../images/guideprofileback.png" alt="">
            </div>
            
            
              
         </div>
         <div class="pkg-wrapper">
            <h1 class="tt-text">Package Creater</h1>
            <div class="pkg-form">
                <form action="logics/packagecreaterlogic.php" method ="POST" enctype="multipart/form-data">
                    <input type="text" placeholder="Enter Package Name" name="pkg-name" id="pkgName">
                    <div class="major-sec-wrapper">
                        <div class="left-sec-msw">
                            <label><h3>Upload a package image</h3><label>
                            <input type="file" name="pkg_img" id="pkgImage" accept="image/*">
                        </div>
                        <div class="right-sec-msw">
                            <input type="text" placeholder="Destination" name="destination"><br>
                            <select name="pkg_options">
                                <option value="normal">Normal Package</option>
                                <option value="custom">Custom Package</option>
                            </select>
                            <div class="durx">
                                <h3>Duration<h3>
                                <input type="range" min=1 max=30 value=2 steps=30 name="duration" placeholder="Duration" oninput="UpdateValue()" id="dura" >
                                <h3 id ="dtion"><h3>
                            </div>  
                            <input type="number" name="max_adults"  placeholder="Maximun Adults">
                            <input type="number" name="max_children" placeholder="Maximum Childrens" >
                    
                        </div>
                        
                    </div>
                    <div class="middle-sec-wrapper">
                        <textarea name="description" placeholder="Description"  cols="30" rows="10"></textarea><br>
                    </div>
                    <div class="end-sec-wrapper">
                        <input type="text" placeholder="Package Price" name="packagePrice" >
                        <input type="text" placeholder = "Price for an additional adult" name="priceAA">
                        <input type="text" placeholder="Price for a child" name="priceChild" >
                        <input type="hidden" name="gid" value=<?php echo $id?>>
                    </div>
                    <input type="submit" value="Send to Approval">
                </form>

            </div>         
        </div>
         

    </div>

    <div id="my-packages-sec">
        <h1 class= "tt-text">My Packages<h1>
        <div class="tp-results-container">
        <?php include'inc/tour_pack.php';
            SortPackagesByGuideId($id,$packages);
        ?>
        </div>
    </div>
    <?php 
         $sql = 'SELECT * from payment where gId = ?';
         $state = $conn->prepare($sql);
         $state->bind_param("i",$user['guideId']);
         $state->execute();
         $res = $state->get_result();
         $payments = mysqli_fetch_all($res,MYSQLI_ASSOC);
         if($payments != null){ 
         echo'<h1 class ="tt-text" id="pkg-tr">Package Transactions</h1>';
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
             echo '<td>Tourist ID</td>';
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
             echo '<td> TOG- '.$pay['tId'].'</td>';
             echo'</tr>';
         }
            
     ?>

<?php 
         $sql = 'SELECT * from request where gId = ?';
         $state = $conn->prepare($sql);
         $state->bind_param("i",$user['guideId']);
         $state->execute();
         $res = $state->get_result();
         $requests = mysqli_fetch_all($res,MYSQLI_ASSOC);
         if($requests != null){ 
         echo'<h1 class ="tt-text" id="pkg-rq">Custom Requests</h1>';
         echo'<div class ="payment-container">';
         echo '<table>';
         echo '<tr>';
             echo '<td>RequestId</td>';
             echo '<td>Context</td>';
             echo '<td>Email</td>';
             echo '<td>Duration</td>';
             echo '<td>Destination</td>';
             echo'</tr>';
         foreach($requests as $req)
         {
            drawRequestRows($req);

         }
         echo'</table>';
         
         echo '</div>';}
         function drawRequestRows($req)
         {
             echo '<tr>';
             echo '<td> REQ-'.$req['requestId'].'</td>';
             echo '<td>'.$req['context'].'</td>';
             echo '<td>'.$req['email'].'</td>';
             echo '<td>'.$req['duration'].'</td>';
             echo '<td>'.$req['destination'].'</td>';
             echo'<td><button id="rem-btn" data-button-id='.$req['requestId'].' onclick="callRemove(this)">Remove</button></td>';
             echo'</tr>';
         }
            
     ?>
     

    <div id="pwd-reset" class ="hide">
        <div class="reset-container">
            <div class="reset-tittle">
                <h2>RESET PASSWORD</h2>
                <button onclick="hidePop()">CLOSE</button>
            </div>
            <div class="reset-form">
                <form action="logics/guidepassreset.php" method="post">
                    <input type="password" placeholder="Old Password" name="opwd" ><br>
                    <input type="password" placeholder="New Password" name="npwd" ><br>
                    <input type="password" placeholder="Confirm Password"name="repwd" ><br>
                    <input type="hidden" value=<?php echo $id?> name="guideId">
                    <input type="submit" value="Change" onclick="hidePop()">
                </form>
            </div>
        </div>
    </div>

    <div class="hide" id="chg-det">
        <div class="cd-container">
            <div class="cd-tittle">
                <h2>change personal details</h2>
                <button onclick="hideCd()">close</button>
            </div>
            <div class="cd-form-container">
                <form action="updateguide.php" method="POST" enctype="multipart/form-data">
                <input type="text" placeholder="User Name" value="<?php echo $user_name?>" name="username" id="">
                <input type="file" name="g_img" id="gImage" accept="image/*">
                <input type="hidden" name="preImg" value=<?php echo$user['pic_link'];?>>
                <input type="text" placeholder="First Name" value="<?php echo $fname?>" name="fname">
                <input type="text" placeholder="Last Name" value="<?php echo $lname?>" name="lname">
                <input type="text" placeholder="City" value="<?php echo $city?>" name="city">
                <input type="tel" placeholder="Contact no" value="<?php echo $telephone?>" name="tel">
                <input type="email" placeholder="Email" value="<?php echo $email?>" name="email">
                <input type="date" palceholder="Date of Birth" value="<?php echo $dob?>" name="dob" id="">
                <textarea placeholder="Address" name="adrs" id="adrs" cols="30" rows="10"><?php echo $address?></textarea>
                <input type="hidden" value=<?php echo $id ?> name="gid">
                <input type="submit" onclick="hideCd()" value="Edit Details">
                </form>
                
            </div>
        </div>
    </div>

<script src='../javascripts/guideprofile.js'></script>

<?php 
  include 'inc/footer.php';
?>