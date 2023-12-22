<?php
$email_incoming = $_SESSION['ademail'];
//database calls so this need to called after admin nav since it has the database connection
$query_ad = 'SELECT * FROM admins WHERE email=?';
$stat = $conn->prepare($query_ad);
$stat->bind_param("s",$email_incoming);
$stat->execute();
$resultes= $stat->get_result();
$ad=mysqli_fetch_assoc($resultes);
//$admins = mysqli_fetch_all($results,MYSQLI_ASSOC);
$user=$ad;
$id=$ad['adminId'];

//short var place
 $profile_img =$ad['pic_link'];
 $user_name=$ad['username'];
 $ad_id=$ad['adminId'];
 $date_reg=$ad['dob'];
 $fname=$ad['firstName'];
 $lname=$ad['lastName'];
 $address=$ad['address'];
 $city=$ad['city'];
 $telephone=$ad['phone'];
 $email=$ad['email'];
 $dob=$ad['dob'];
 

 $q_tourist = "SELECT count(*) FROM tourists";
 $result_t = mysqli_query($conn,$q_tourist);
 $res1 = mysqli_fetch_assoc($result_t);
 $t_tourists =$res1['count(*)']; 

 $q_guides = "SELECT count(*) FROM tourguide";
 $result_g = mysqli_query($conn,$q_guides);
 $res2 = mysqli_fetch_assoc($result_g);
 $t_guides =$res2['count(*)']; 
 
 $q_packs = "SELECT count(*) FROM tourpackage";
 $result_p = mysqli_query($conn,$q_packs);
 $res3 = mysqli_fetch_assoc($result_p);
 $t_packs =$res3['count(*)']; 



 



 ?>