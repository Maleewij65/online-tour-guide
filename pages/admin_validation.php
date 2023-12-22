<?php 
include'config/database.php';   
if($_SERVER['REQUEST_METHOD']==='POST')
{
     $ad_fname = $_POST['fname'];
     $ad_lname = $_POST['lname'];
     $ad_email = $_POST['mail'];
     $ad_pass = $_POST['ad_pass'];
     $ad_retype = $_POST['rad_pass'];
     $ad_isAccepted =$_POST['isAccepted'];
     $isLogin =$POST['isLogin'];         
}
$quire_admins ='SELECT * FROM admins';
$resuts_admins = mysqli_query($conn,$quire_admins);
$admins = mysqli_fetch_all($resuts_admins,MYSQLI_ASSOC);


//guard against empty fields
if($ad_fname==null ||$ad_lname==null||$ad_email==null||$ad_pass==null||$ad_retype==null||!$ad_isAccepted)
{
    sendback();
}

//var_dump($admins); //uncoment to troubleshoot
$mailmatch =0;
foreach($admins as $admin)
{
    //since this is an admin he will have only to add  for first log in credential will suply by another admin
    if(!strcmp($ad_email,$admin['email'])&&!strcmp($ad_pass,$admin['password']))
    {
        echo "<h1>Email Matched<h1>";
        echo"<h1>".$admin['email']."</h1>";
        $mailmatch++;
        $checkQuiree ="UPDATE admins SET firstName=?, lastName=? WHERE adminId =?";
        $statement = $conn->prepare($checkQuiree);
        $statement->bind_param("ssi",$ad_fname,$ad_lname,$admin['adminId']);
        if($statement->execute())
        {
            echo'<h1> user details succesfully updated and registered as an admin</h1>';
            
            sendforword($ad_email,$ad_pass);
        }
        else
        {
            echo'<h1> user details not updated</h1>';
        }
        $statement->close();
    }    
    
}
echo $mailmatch;
if($mailmatch ==0){
    sendback();
}

function sendback()
{
    
    echo'<script> window.location.href="adminportal.php" </script>';   
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





