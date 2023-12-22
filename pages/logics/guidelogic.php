<?php
$user = getUserGuide($conn,$id);

$user_name = $user['username'];
$g_id = $user['guideId'];
$date_reg = $user['dreg'];
$profile_img = $user['pic_link'];
$fname = $user['firstName'];
$lname = $user['lastName'];
$address = $user['address'];
$city = $user['city'];
$telephone = $user['phone'];
$email = $user['email'];
$dob = $user['dob'];
  


function getUserGuide($conection,$gid)
{
   $sql = 'SELECT * from tourguide where guideId = ?';
   $state = $conection->prepare($sql);
   $state->bind_param("i",$gid);
   $state->execute();
   $res = $state->get_result();
   $user = mysqli_fetch_assoc($res);
   return $user;

}

?>