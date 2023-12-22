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
            
            <div class="cnt-side">

            </div>
            <div class="form-side">
                <h1>Sign-up</h1>
                <h2>As a tourist</h2>
                <h2 class="warning" id="wrn"></h2>
                <h3 class="warning"><?php if(isset($msg)){ echo $msg;} ?></h3>
                <div class="sign-up-form">
                 <form action="tourist_sign.php" method ="POST">
                 <input type="text" placeholder="First Name" name="fname_t" id="fn" onchange="checkforName('fn')" required>
                 <input type="text" placeholder="Last Name" name="lname_t" id="ln" onchange="checkforName('ln')" required></br>
                 <input style="width: 88.2%;" type="email" placeholder="Email"name="email_t" id="email" onchange="checkforEmail('email')" required></br>
                 <input style="width: 88.2%;" type="password" placeholder="Password" name="pass_t"  required></br>
                 <input style="width: 88.2%;" type="password" placeholder="Confirm Password" name="repass_t" required><br>
                 <input type="radio" name="isAccepted" required><label>I accept the terms of use and privacy policy</label><br>
                 <button type="submit" id="sbt">submit</button>
                 </form>
                </div>

            </div>

        </main>
        <script src="../javascripts/signupval.js"></script>
<?php include 'inc/footer.php' ?>