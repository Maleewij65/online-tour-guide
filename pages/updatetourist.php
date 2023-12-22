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
    $us['id'] =(int)$_POST['tid'];
    //$img_path
    //upload
    $targetDirectory ="uploads/tourists/";
    $targetFile = $targetDirectory .basename($_FILES["t_img"]["name"]);
    if (move_uploaded_file($_FILES["t_img"]["tmp_name"], $targetFile)) {
        // Save file path to database
        $us['pic'] = $targetFile;
        
    }
    if($us['pic']==null)
    {
        $us['pic'] =$_POST['preImg'];
        
    }
}

function updateTourist($conn,$us)
{
    $quiere_mail = 'UPDATE tourists SET username=?,email=?,firstName=?,lastName=?,dob=?,address=?,phone=?,city=?,pic_link=? where touristId= ?' ;
    $statement = $conn->prepare($quiere_mail);
    $statement->bind_param("sssssssssi",$us['username'],$us['email'],$us['fname'],$us['lname'],$us['dob'],$us['adrs'],$us['tel'],$us['city'],$us['pic'],$us['id']);
    $res=$statement->execute();
    if($res)
    {     
        echo "<script>alert('Updated the database');</script>";
        header('Location:touristprofile.php');
       
    }
    else
    {
        echo "<script>alert('Update eror');</script>";
        header('Location:touristprofile.php');
    }

}
updateTourist($conn,$us);


?>