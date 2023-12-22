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
    <link rel="stylesheet" href="../css/form_cs.css">

    <title>ADMIN PORTAL</title>
</head>
<?php include'inc/admin_nav.php';
if(isset($_SESSION['msg']))
{
    $msg = $_SESSION['msg'];
}
    unset($_SESSION['msg']);
?> 

<h1 style="font-size:1.5rem;" class="warning" id="wrn"><?php if(isset($msg)){echo $msg;}?></h1>
<main style="gap:3em">           
            <div class="form-side">
                <h1>First Sign up</h1>
                <h2>As an admin</h2>
                <h3>Important : Contact main admin to get your admin privilages</h3>
                <h3>If you are redirect back to this page after check which means you do not have authorization to register as an admin</h3>
                <div class="sign-up-form">
                 <form action="admin_validation.php" method="post">
                 <input type="text" placeholder="First Name" name=fname id="fn" onchange="checkforName('fn')" required>
                 <input type="text" placeholder="Last Name" name=lname id="ln" onchange="checkforName('ln')" required></br>
                 <input style="width: 88.2%;" type="email" placeholder="Email" onchange="checkforEmail('mail')" name="mail" id="mail" required></br>
                 <input style="width: 88.2%;" type="password" placeholder="Password"name="ad_pass" required></br>
                 <input style="width: 88.2%;" type="password" placeholder="Confirm Password" name="rad_pass" required><br>
                 <input type="radio" name="isAccepted" required><label>I accept the terms of use and privacy policy</label><br>
                 <button type="submit">Let's check</button>
                 </form>
                </div>

            </div>
            <div class="form-side">
            <h1>Log-in</h1>
            <h2>Welcome back !</h2>
            
            <div class="sign-up-form">
                 <form action="admin_redirect.php" method="post">
                 <input style="width:95%" type="email" placeholder="Email" name="mail" onchange="checkforEmail('emx')" id="emx" required></br>
                 <input style="width:95%" type="password" placeholder="Password"name="ad_pass" id="pwdx" required></br>
                 <button type="submit" id="sbt">Log in</button>
                 </form>
            </div>
      
           <script src="../javascripts/signupval.js"></script>
      </div>
</main>       

      