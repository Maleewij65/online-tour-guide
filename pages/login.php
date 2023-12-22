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
    

    <title>SERENDIB TRAVELS | LOG IN</title>
</head>
<?php include 'inc/nav.php';
if(isset($_SESSION['msg']))
{
    $msg = $_SESSION['msg'];
}
    unset($_SESSION['msg']);
?>
        <main style="justify-content: center;">
            <div class="form-side">
                <h1>Log-in</h1>
                <h2>Welcome back !</h2>
                <h2 class ="warning" id="wrn"><?php if(isset($msg)){ echo$msg; }?></h2>
                <div class="sign-up-form" >
                 <form action="sortlogin.php" method ="POST">
                 <input style="width:95%" type="email" placeholder="Email" onchange="checkforEmail('emx')" name="mail" id="emx" required></br>
                 <input style="width:95%" type="password" placeholder="Password" name="pass" id="ps" required></br>  
                 <lable><h2>Login Type<h2></lable>    
                 <select name="logintype" required class ="drop">
                    <option value="tg">Tour-Guide</option>
                    <option value="tr">Tourist</option>
                 </select><br>
                 <button type="submit" id="sbt">submit</button>
                 </form>
                </div>

            </div>
            <script src="../javascripts/signupval.js"></script>
        </main>
<?php include 'inc/footer.php'?>