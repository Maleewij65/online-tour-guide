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
   $id = getId($conn);
   $countAdults = $_POST['countAdults'] + 1; 
   $countChilds = $_POST['countChilds'];
   $guideId =(int)$_POST['gid'];
   $sql = 'INSERT INTO payment(payId,pmethod,amount,departure,arrival,adults,children,pkgId,gId,tId) VALUES(?,?,?,?,?,?,?,?,?,?)';
   $stat = $conn->prepare($sql);
   $stat->bind_param("isdssiiiii",$id,$_POST['payopt'],$_POST['paid'],$_POST['departure'],$_POST['arival'],$countAdults,$countChilds,$_POST['pkgId'],$_POST['gid'],$_POST['tid']);
   $res=$stat->execute();
   if($res)
   {
        echo "<h1>Payment Success</h1>";
        header("Location:../touristprofile.php");
   }
   else
   {
        echo "<h1>Unsucessful Payment</h1>";
        header("Location:../payment.php");
   }

}

function getId($conn)
{
    $sql = 'SELECT MAX(payId) as Mpid FROM payment';

    $res = mysqli_query($conn,$sql);
    $ans = mysqli_fetch_assoc($res);
    $max = $ans["Mpid"];
    if($max == null)
    {
        return 1;
    }
    else
    {
        return (int)$max + 1;
    }

}



?>