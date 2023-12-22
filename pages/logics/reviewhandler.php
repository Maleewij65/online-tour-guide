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


if($_SERVER['REQUEST_METHOD']==="POST")
{
    $pkgId=(int)$_POST['pkgId'];
    $tid =(int)$_POST['touristId'];
    $review = $_POST['review'];
    $rating =(int)$_POST['rating'];
    $id=getNextId($conn);
    var_dump($id);
    $sql = 'INSERT INTO review(revId,context,tId,pkgId,rating) VALUES(?,?,?,?,?)';
    $stat = $conn->prepare($sql);
    $stat->bind_param("isiii",$id,$review,$tid,$pkgId,$rating);
    $res=$stat->execute();
    if($res)
    {
        echo '<script>alert("Review added. Thank you for your feedback. If context inappropriate will be deleted by admins")</script>';
        echo '<script>window.location.href="../tours.php";</script>';
    }
    else
    {
        echo '<script>alert("Something went wrong.Try later.Your response not recorded")</script>';
        echo '<script>window.location.href="../tours.php";</script>';
    }
}
function getNextId($conn)
{
    $sql="SELECT MAX(revId) as rev FROM review";
    $res = mysqli_query($conn,$sql);
    $ans = mysqli_fetch_assoc($res);
    $max = (int)$ans["rev"];
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