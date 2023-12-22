<?php 
// Start
    session_start();

// Access the stored POST data from session variables
if(isset($_SESSION['msg']))
{
    $msg = $_SESSION['msg'];
}
    unset($_SESSION['msg']);

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
    <link rel="stylesheet" href="../css/form_cs.css">
                                   >    
    

    <title>SERENDIB TRAVELS | SIGN UP</title>
</head>
<?php include 'inc/nav.php' ?>
        <main>
            <div class="form-side">
                <h1>Sign-up</h1>
                <h2>As a tour guide</h2>
                <h3 class="warning" id="wrn"><?php if(isset($msg)){ echo $msg;} ?></h3>
                <div class="sign-up-form">
                 <form action ="guide_sign.php" method="POST">
                 <input type="text" placeholder="First Name"" name ="fname_g" onchange='checkforName("fname")' required id="fname">
                 <input type="text" placeholder="Last Name"" name="lname_g" onchange ='checkforName("lname")' required id="lname"></br>
                 <input style="width: 88.2%;" type="email" placeholder="Email"name="email_g" onchange='checkforEmail("mail")' id="mail" required></br>
                 <input style="width: 88.2%;" type="password" placeholder="Password"name="pass_g" id="pass" required></br>
                 <input style="width: 88.2%;" type="password" placeholder="Confirm Password" name ="repass_g" id="rpass" required><br>
                 <input type="radio" name="isAccepted" required><label>I accept the terms of use and privacy policy</label><br>
                 <button type="submit" id="sbt">submit</button>
                 </form>
                </div>

            </div>
            <div class="cnt-side">

            </div>
            <script src="../javascripts/signupval.js"></script>
        </main>
    
<?php include 'inc/footer.php' ?>