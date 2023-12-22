<?php 
include "../config/database.php";


if($_SERVER['REQUEST_METHOD']==='POST')
{
    $gId =(int)$_POST['gid'];
    $email = $_POST['email'];
    $dest = $_POST['destination'];
    $dura =(int)$_POST['duration'];
    $context = $_POST['message'];
    $id = getNextRequestId($conn);
    var_dump($context);
    $sql = 'INSERT INTO request(requestId,context,email,duration,destination,gId) VALUES(?,?,?,?,?,?)';
    $stat = $conn->prepare($sql);
    $stat->bind_param("issisi",$id,$context,$email,$dura,$dest,$gId);
    $res=$stat->execute();
    if($res)
    {
        echo '<script>alert("Request added.Guide will contact you.");</script>';
        echo '<script>window.location.href="../tours.php";</script>';
    }
    else
    {
        echo '<script>alert("Something went wrong.Try later.Your request not recorded")</script>';
        echo '<script>window.location.href="../tours.php";</script>';
    }
}
function getNextRequestId($conn)
{
    $sql="SELECT MAX(requestId) as req FROM request";
    $res = mysqli_query($conn,$sql);
    $ans = mysqli_fetch_assoc($res);
    $max = (int)$ans["req"];
    var_dump($max);
    if($max == null)
    {
        $max= 1;
    }
    else
    {
        $max++;
    }
    return $max;
}


?>