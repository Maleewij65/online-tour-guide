

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&family=Poppins:wght@200;400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/main.css">  
    <link rel="stylesheet" href="../css/tour_cs.css">
    <link rel="stylesheet" href="../css/payment.css">
    
    <title>SERENDIB TRAVELS | GUIDE PROFILE></title>
</head>
<?php 
include 'inc/nav.php';

if(isset($_SESSION['touristId']))
{
    $userId = $_SESSION['touristId'];
    $sql1 = 'SELECT * FROM tourists WHERE touristId = ?';
    $stat = $conn->prepare($sql1);
    $stat->bind_param("i",$userId);
    $stat->execute();
    $res = $stat->get_result();
    $tourist = mysqli_fetch_assoc($res);

}
if($userId == null)
{
    header("Location: login.php");
}



if($_SERVER['REQUEST_METHOD']==="POST")
{
    $pkgId =(int)$_POST['pkgId'];
    
    $sql = 'SELECT * FROM tourpackage WHERE pkgId = ?';
    $stat = $conn->prepare($sql);
    $stat->bind_param("i",$pkgId);
    $stat->execute();
    $res = $stat->get_result();
    $pkg = mysqli_fetch_assoc($res);
    
   
    $sql1 = 'SELECT * FROM tourguide WHERE guideId = ?';
    $stat = $conn->prepare($sql1);
    $stat->bind_param("i",$pkg['guideId']);
    $stat->execute();
    $res = $stat->get_result();
    $guide = mysqli_fetch_assoc($res);
   

}

?>
<main>
    <h1 class= "tt-text">Payment Interface</h1>
    <div class="payment-interface-container">
    <div class="details-containter">
         <div class="order-details">
            <h1>Package Details</h1>
            <h2>Package name :<?php echo $pkg['pkgName'] ?> </h2>
            <h2>Package type :<?php echo $pkg['pkgType'] ?> </h2>
            <h2>Package Id : PKG -<?php echo $pkgId ?> </h2>
            <h2>Package Destination :<?php echo $pkg['destination'] ?> </h2>
            <h1>Guide Details</h1>
            <h2>Guide name :<?php echo $guide['firstName']." ".$guide['lastName']; ?> </h2>
            <h2>Guide Id :<?php echo'TOG-'.$pkg['guideId'];?> </h2>
            <h2>Guide Availability:<?php if($guide['availabillity']){ echo'YES';}else {echo 'NO';} ?></h2>
            <h1>Tourist Details : </h1>
            <h2>Tourist email :<?php echo $tourist['email'];?> </h2>
            <h2>Toursit Id :<?php echo'TOU-'.$tourist['touristId'];?> </h2>
            <h2>Loyalty Level :<?php echo $tourist['loyalty'];?> </h2>
         </div>

    </div>

    <div class="payment-container">
            <form action="logics/paymentconfirm.php" method="POST">
             <div class='lb'><label> Departure date </label> <input id="dt1" data-pkgid=<?php echo$pkgId ?> oninput="dataValidation()" type="date" name="departure" min="" require></div>
             <div class='lb'><label> Arrival date </label> <input id="dt2" type="date" disabled></div>
             <div class='lb'><label> Additional Adults: </label><input id="dt3"type="number" name="countAdults" min = "0" value="0" oninput="dataValidation()"></div>
             <div class='lb'><label> Children : </label><input id="dt4" type="number" name="countChilds" min = "0" value="0" oninput="dataValidation()"></div>
             <input type="hidden" id="dt5" value=<?php echo $tourist['loyalty'];?>>
             <input type="hidden" id="dt6" name ="tid" value=<?php echo $tourist['touristId']?>>
             <input type="hidden" id="dt7" name="paid" value=0>
             <input type="hidden" id="dt8" name="arival" >
             <input type="hidden" id="dt9" name="pkgId" value=<?php echo $pkgId; ?>>
             <input type="hidden" id="dt10" name="gid" value=<?php echo $pkg['guideId']; ?>>
                <h3 id="paa"></h3>
                <h3 id="pc"></h3>
                <h3 id="tp"></h3>
                <h3 id="bn"></h3>
                <h3 id="fi" onchange="book()"></h3>
                <div class ="ctr">
                <select class="dropdown-select" name="payopt">
                    <option value="card">Pay via card</option>
                    <option value="cash">Pay via cash</option>
                </select><br>
                <input class="book-now-btn" type="submit" value="BOOK NOW"></div>
            </form>
    </div>
    </div>

</main>
<script src="../javascripts/payment.js"></script>

<?php include 'inc/footer.php'; ?>