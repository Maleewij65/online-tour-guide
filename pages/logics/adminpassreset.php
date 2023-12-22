<?php

define('DB_HOST','localhost');
define('DB_USER','kdy_b1_04');
define('DB_PASS','Sliitkdy@04');
define('DB_NAME','db-otg');


//setting a connection
$conn= new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

//making a connection

if($conn->connect_error)
{
    echo "Connection eror";
    die("Connection Failed".$conn->connect_error);
}
echo "CONNECTED TO OTG DATABASE";





if($_SERVER['REQUEST_METHOD']==="POST")
{
    $id = $_POST['adminId'];
    $query_ad = 'SELECT * FROM admins WHERE adminId=?';
    $stat = $conn->prepare($query_ad);
    $stat->bind_param("s",$id);
    $stat->execute();
    $resultes= $stat->get_result();
    $user=mysqli_fetch_assoc($resultes);

    var_dump($user['password']);
    $oldpass = $_POST['opwd'];
    $npwd =$_POST['npwd'];
    $rpwd =$_POST['repwd'];

    if(!strcmp($npwd,$rpwd))
    {
            //can reset password
        pwdResetAdmin($conn,$user,$oldpass,$npwd);
    }
    else
    {
        echo '<script> alert("Your retype password does not matched with the new password");</script>';
        echo '<script>window.location.href = "../adminprofile.php";</script>';
        
    }
    

    
}
function pwdResetAdmin($conn,$user,$oldpwd,$npwd)
{
   if(!strcmp($user['password'],$oldpwd))
   {
      //change password
      $sql = 'UPDATE admins SET password=? where adminId = ?';
      $stat = $conn->prepare($sql);
      $stat->bind_param("si",$npwd,$user['adminId']);
      $res=$stat->execute();
      if($res)
      {
          
          echo '<script> alert("Password reset success");</script>';
          echo '<script>window.location.href = "../logout.php";</script>';
          
      }
      else
      {
          echo '<script> alert("Password reset unsuccess");</script>';
          echo '<script>window.location.href = "../adminprofile.php";</script>';
          
      }

   }
}



        




?>