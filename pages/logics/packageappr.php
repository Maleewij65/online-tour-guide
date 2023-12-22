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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id=(int)$_POST['pakgId'];
    Approve($id,$conn);


}


function Approve($id,$conn) {
    // Function logic goes here
    $sql='UPDATE tourpackage SET rating=1,availabillity=1 WHERE pkgId=?';
    $stat = $conn->prepare($sql);
    $stat->bind_param('i',$id);
    $stat->execute();
    echo "Updated package!".$id;
}



?>