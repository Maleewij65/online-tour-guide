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
    if(isset($_POST['bkDate']))
    {
        $pkgId = $_POST['pkgId'];
        $query_ad = 'SELECT * FROM tourPackage WHERE pkgId= ?';
                $stat = $conn->prepare($query_ad);
                $stat->bind_param("i",$pkgId);
                $stat->execute();
                $resultes= $stat->get_result();
                $pk=mysqli_fetch_assoc($resultes);
        
        $date =new Datetime($_POST['bkDate']);
        $duration = "+{$pk['duration']} days";
        $formattedDate = formatDate($date,$duration);
        $cAdults=$_POST['adults'];
        $cChilds=$_POST['childs'];
        $loyalty = $_POST['loyalty'];
        $total = calculateT($pk,$cAdults,$cChilds);
        
        if($cAdults != null)
        {
           $adult = $pk['priceAdditionalAdult'] * $cAdults;
        }
        if($cChilds != null)
        {
           $child = $pk['priceChild'] *$cChilds;
        }
        if($loyalty != null)
        {
                $query_ad = 'SELECT * FROM bonus WHERE bType= ?';
                $stat = $conn->prepare($query_ad);
                $stat->bind_param("s",$loyalty);
                $stat->execute();
                $resultes= $stat->get_result();
                $bn=mysqli_fetch_assoc($resultes);
                $bRate = $bn['bAmount'];
                $bonus = calculateBonus($total,$bRate);
        }
        $response = array(
            'arivalDate' => $formattedDate,
            'total'=>$total,
            'adultP'=>$adult,
            'childP'=>$child,
            'bonus'=>$bonus,
            'final'=>$total-$bonus,
          );
          
    $jsonResponse = json_encode($response);
// echo the data back to the JavaScript
    echo $jsonResponse;
    }
}

function formatDate($Date,$add)
{
    $xday = clone $Date;
    $xday->modify($add);
    $fdate =$xday->format('Y-m-d');
    return $fdate;
}
function calculateT($pkg,$adults,$childs)
{
    $total = $pkg['priceAdult'];
    if($adults!= null)
    {
        $total += $pkg['priceAdditionalAdult'] * $adults;
    }
    if($childs!= null)
    {
        $total += $pkg['priceChild'] * $childs;
    }
    return $total;
}
function calculateBonus($tot,$bAm)
{
    $bonus = $tot*$bAm;
    return $bonus;
}




?>