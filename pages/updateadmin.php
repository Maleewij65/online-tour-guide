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
    $us['id'] =(int)$_POST['aid'];
    //$img_path
}

function updateAD($conn,$us)
{
    $quiere_mail = 'UPDATE admins SET username=?,email=?,firstName=?,lastName=?,dob=?,address=?,phone=?,city=? where adminId= ?' ;
    $statement = $conn->prepare($quiere_mail);
    $statement->bind_param("ssssssssi",$us['username'],$us['email'],$us['fname'],$us['lname'],$us['dob'],$us['adrs'],$us['tel'],$us['city'],$us['id']);
    $res=$statement->execute();
    if($res)
    {
        //send msg succesfull
        echo "Updated the database";
        //header('Location:guideprofile.php')
        //send back
    }
    else
    {
        //send msg unsuccess
        echo "Update eror";
    }

}
updateAD($conn,$us);


?>