
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
include_once 'inc/tour_pack.php';
$pk;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['clicked'])) {
      $data = $_POST['clicked'];
      $ID = $data[0];
      // Process the data as needed
      $query_ad = 'SELECT * FROM tourPackage WHERE pkgId= ?';
                $stat = $conn->prepare($query_ad);
                $stat->bind_param("i",$ID);
                $stat->execute();
                $resultes= $stat->get_result();
                $pk=mysqli_fetch_assoc($resultes);
                $query = 'SELECT * FROM tourguide WHERE guideId= ?';
                $stat = $conn->prepare($query);
                $stat->bind_param("i",$pk['guideId']);
                $stat->execute();
                $resultes= $stat->get_result();
                $guide=mysqli_fetch_assoc($resultes);
                $query = 'SELECT * FROM review r join tourists t on r.tId=t.touristId WHERE pkgId= ?';
                $stat = $conn->prepare($query);
                $stat->bind_param("i",$ID);
                $stat->execute();
                $resultes= $stat->get_result();
                $reviews=mysqli_fetch_all($resultes,MYSQLI_ASSOC);
                //var_dump($pk);
                $response = array(
                  'pkgName' => $pk['pkgName'],
                  'pkgId'=>$pk['pkgId'],
                  'destination'=>$pk['destination'],
                  'avail'=>$pk['availabillity'],
                  'description'=>$pk['description'],
                  'rating'=>$pk['rating'],
                  'duration'=>$pk['duration'],
                  'priceA'=>$pk['priceAdult'],
                  'priceAA'=>$pk['priceAdditionalAdult'],
                  'priceChild' =>$pk['priceChild'],
                  'pkgImage'=>$pk['pkgImage'],
                  'guidefName'=>$guide['firstName'],
                  'guidelName'=>$guide['lastName'],
                  'reviews'=>$reviews,

                );
                
      $jsonResponse = json_encode($response);
      // echo the data back to the JavaScript
      echo $jsonResponse;
    }
  } 
?>