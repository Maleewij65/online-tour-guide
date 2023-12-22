<?php
include '../config/database.php';

if($_SERVER['REQUEST_METHOD']==='POST')
{
    $pkg_type =$_POST['pkg_options'];
    $pkg_name=$_POST['pkg-name'];
    $pkg_duration=$_POST['duration'];
    $pkg_description=$_POST['description'];
    $pkg_destination=$_POST['destination'];
    //$pkg_id=$_POST[''];
    $pkg_max_children=$_POST['max_children'];
    $pkg_max_adults=$_POST['max_adults'];
    $pkg_img_link;
    $pkg_price=$_POST['packagePrice'];
    $pkg_price_child=$_POST['priceChild'];
    $pkg_price_ad=$_POST['priceAA'];
    $guide_id=(int)$_POST['gid'];
    //uploading
    $targetDirectory = "../uploads/packages/";
    $targetFile = $targetDirectory . basename($_FILES["pkg_img"]["name"]);
    $otherDirectory ="uploads/packages/";
    $relativePath = $otherDirectory.basename($_FILES["pkg_img"]["name"]);
    if (move_uploaded_file($_FILES["pkg_img"]["tmp_name"], $targetFile)) {
        // Save file path to database
        $pkg_img_link = $relativePath;
    }


   
}
$pkg_id =countPkg($conn);

function countPkg($conn)
{
    $sql = 'SELECT MAX(pkgId) as pid FROM tourpackage';

    $res = mysqli_query($conn,$sql);
    $ans = mysqli_fetch_assoc($res);
    $max = $ans["pid"];
    if($max == null)
    {
        return 1;
    }
    else
    {
        return (int)$max + 1;
    }

}
//create assoc 

$newPkg;
$newPkg['pkgName']=$pkg_name;
$newPkg['pkgId']=(int)$pkg_id;
$newPkg['destination']=$pkg_destination;
$newPkg['availabillity'] = 1;
$newPkg['pkgType']= $pkg_type;
$newPkg['description']=$pkg_description;
$newPkg['rating']=null;
$newPkg['duration'] =(int)$pkg_duration;
$newPkg['priceAdult']=$pkg_price;
$newPkg['priceAdditionalAdult']=$pkg_price_ad;
$newPkg['priceChild'] =$pkg_price_child;
$newPkg['pkgImage']=$pkg_img_link;
$newPkg['maxA'] = $pkg_max_adults;
$newPkg['maxC']=$pkg_max_children;
if($newPkg['pkgImage']==null)
{
    $newPkg['pkgImage']= "../images/cities/kdy.jpg"; // setting a default picture
}
$newPkg['guideId'] =$guide_id;

createPkg($conn,$newPkg);

function createPkg($conn,$newPkg)
{
    $quiere_mail = 'INSERT INTO tourpackage(pkgId,pkgName,destination,availabillity,pkgType,description,rating,duration,priceAdult,priceAdditionalAdult,priceChild,pkgImage,guideId,maxA,maxC)
    values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
    $statement = $conn->prepare($quiere_mail);
    $statement->bind_param("ississdidddsiii",$newPkg['pkgId'],$newPkg['pkgName'],$newPkg['destination'],$newPkg['availabillity'],$newPkg['pkgType']
    ,$newPkg['description'],$newPkg['rating'],$newPkg['duration'],$newPkg['priceAdult'],$newPkg['priceAdditionalAdult'],$newPkg['priceChild'],$newPkg['pkgImage'],$newPkg['guideId'],$newPkg['maxA'],$newPkg['maxC']);
    $res = $statement->execute();
    if($res) 
    {
        echo '<script>alert("Package registered succussfully");</script>';
        echo '<script>window.location.href="../guideprofile.php"</script>';
    }
    else
    {
        echo '<script>alert("Package not registered.Try again later");</script>';
        echo '<script>window.location.href="../guideprofile.php"</script>';
    }

}


?>