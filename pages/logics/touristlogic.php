<?php
$user = getUser($conn,$id);

$user_name = $user['username'];
$t_id = $user['touristId'];
$date_reg = $user['dreg'];
$profile_img = $user['pic_link'];
$fname = $user['firstName'];
$lname = $user['lastName'];
$address = $user['address'];
$city = $user['city'];
$telephone = $user['phone'];
$email = $user['email'];
$dob = $user['dob'];

  


function getUser($conection,$tid)
{
   $sql = 'SELECT * from tourists where touristId = ?';
   $state = $conection->prepare($sql);
   $state->bind_param("i",$tid);
   $state->execute();
   $res = $state->get_result();
   $user = mysqli_fetch_assoc($res);
   return $user;

}

function getPayments($conection,$tid)
{
   $sql = 'SELECT * from payment where tId = ?';
   $state = $conection->prepare($sql);
   $state->bind_param("i",$tid);
   $state->execute();
   $res = $state->get_result();
   $payments = mysqli_fetch_all($res);
   return $payments;

}

?>