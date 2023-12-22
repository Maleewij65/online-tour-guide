<?php
include'config/database.php';
$us;
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $us['username'] = $_POST['username'];
    $us['fname']= $_POST['fname'];
    $us['lname'] = $_POST['lname'];
    $us['city'] =$_POST['city'];
    $us['tel']=$_POST['tel'];
    $us['email']=$_POST['email'];
    $us['dob']=$_POST['dob'];
    $us['adrs'] =$_POST['adrs'];
    $us['id'] =(int)$_POST['gid'];
    
    //$img_path
    $targetDirectory ="uploads/guides/";
    $targetFile = $targetDirectory .basename($_FILES["g_img"]["name"]);
    if (move_uploaded_file($_FILES["g_img"]["tmp_name"], $targetFile)) {
        // Save file path to database
        $us['pic'] = $targetFile;
        
    }
    if($us['pic']==null)
    {
        $us['pic'] =$_POST['preImg'];
        
    }
}

function updateTG($conn,$us)
{
    $quiere_mail = 'UPDATE tourguide SET username=?,email=?,firstName=?,lastName=?,dob=?,address=?,phone=?,city=?,pic_link=? where guideId= ?' ;
    $statement = $conn->prepare($quiere_mail);
    $statement->bind_param("ssssssissi",$us['username'],$us['email'],$us['fname'],$us['lname'],$us['dob'],$us['adrs'],$us['tel'],$us['city'],$us['pic'],$us['id']);
    $res=$statement->execute();
    if($res)
    {
        //send msg succesfull
        echo '<script>alert("Updated the database");</script>';
        header('Location:guideprofile.php');
        
    }
    else
    {
        //send msg unsuccess
        echo '<script>alert("Update eror");</script>';
        header('Location:guideprofile.php');
    }

}
updateTG($conn,$us);


?>