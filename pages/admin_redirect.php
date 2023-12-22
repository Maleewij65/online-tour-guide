<?php

include'config/database.php';   
if($_SERVER['REQUEST_METHOD']==='POST')
{  
     $ad_email = $_POST['mail'];
     $ad_pass = $_POST['ad_pass'];
           
}
$quire_admins ='SELECT * FROM admins';
$resuts_admins = mysqli_query($conn,$quire_admins);
$admins = mysqli_fetch_all($resuts_admins,MYSQLI_ASSOC);

$mailmatch =0;
foreach($admins as $admin)
{
    if(!strcmp($ad_email,$admin['email'])&&!strcmp($ad_pass,$admin['password']))
    {
        $mailmatch++;
        sendforword($ad_email,$ad_pass);                
    }
    
}
function sendforword($email,$password)
{
    //echo'<script>window.location.href="adminprofile.php"</script>';

    echo'<script> 
    window.onload = function() {
        // Create a form dynamically
        var form = document.createElement(\'form\');
        form.method = \'POST\';
        form.action = \'adminprofile.php\';

        var param1 = document.createElement(\'input\');
        param1.type = \'hidden\';
        param1.name = \'ademail\';
        param1.value = \''.$email.'\';
        form.appendChild(param1);
        
        var param2 = document.createElement(\'input\');
        param2.type = \'hidden\';
        param2.name = \'adpwd\';
        param2.value = \''.$password.'\';
        form.appendChild(param2);
       
        document.body.appendChild(form);

        // Submit the form
        form.submit();
    }</script>';

    
}

function sendback($msg)
{
    session_start();
    $_SESSION['msg'] = $msg;
    echo'<script> window.location.href="adminportal.php" </script>';   
    exit;
    
}
if($mailmatch ==0){
    sendback("Email or password is incorrect! Make sure you have admin authorization");
}


?>
