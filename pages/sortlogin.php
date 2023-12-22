<?php 
include 'config/database.php';
echo "<br>Sorting";

if($_SERVER['REQUEST_METHOD']==='POST')
{
    $loginType = $_POST['logintype'];
}
if($_SERVER['REQUEST_METHOD']=== 'POST')
{
    $usermail = $_POST['mail'];
    echo $usermail;
}
if($_SERVER['REQUEST_METHOD']=== 'POST')
{
    $pass = $_POST['pass'];
    echo $pass;
}

//sort the user type
if(!strcmp($loginType,'tg'))
{
    fetchTourGuides($usermail,$pass,$conn);
}
else if (!strcmp($loginType,'tr'))
{
    fetchTourist($usermail,$pass,$conn);
}


function fetchTourGuides($user,$pwd,$conn)
{
    $sql = 'SELECT * from tourguide where email =?';
    $statement = $conn->prepare($sql);
    $statement->bind_param('s',$user);
    $statement->execute();
    $guide_res = $statement->get_result();
    $guide = mysqli_fetch_assoc($guide_res);
    if($guide != null)
    {
        //check for password match
        if(!strcmp($guide['pass'],$pwd))
        {
            //redirect user to profile
            $id = $guide['guideId'];
            SendLoginInfo($id);
        }
        else
        {
            //redirect back to login with passwod eror and reset option
           redirect("You have entered a wrong password !");

        }
    }
    else
    {
        redirect('You have entered a wrong email or you are not registered <a href ="signform.php" >Sign up</a> instead !');
    }

}
function fetchTourist($user,$pwd,$conn)
{
    $sql = 'SELECT * from tourists where email =?';
    $statement = $conn->prepare($sql);
    $statement->bind_param('s',$user);
    $statement->execute();
    $tourist_res = $statement->get_result();
    $tourist = mysqli_fetch_assoc($tourist_res);
    if($tourist != null)
    {
        //check for password match
        if(!strcmp($tourist['pass'],$pwd))
        {
            //redirect user to profile
            $id = $tourist['touristId'];
            SendLoginInfoTr($id);
        }
        else
        {
            //redirect back to login with passwod eror and reset option
           //redirect("Password missmatch");
           redirect("You have entered a wrong password !");

        }
    }
    else
    {
        redirect('You have entered a wrong email or you are not registered <a href ="signformt.php" >Sign up</a> instead !');
    }

}


//make the quirey
function redirect($msg)
{
    session_start();
    $_SESSION['msg'] = $msg;
    header('Location:login.php');
    exit;
}
function SendLoginInfo($guideId)
{
    

    echo'<script> 
    window.onload = function() {
        // Create a form dynamically
        var form = document.createElement(\'form\');
        form.method = \'POST\';
        form.action = \'guideprofile.php\';

        var param1 = document.createElement(\'input\');
        param1.type = \'hidden\';
        param1.name = \'gid\';
        param1.value = \''.$guideId.'\';
        form.appendChild(param1);  
       
        document.body.appendChild(form);

        // Submit the form
        form.submit();
    }</script>';

    
}
function SendLoginInfoTr($touristId)
{
    

    echo'<script> 
    window.onload = function() {
        // Create a form dynamically
        var form = document.createElement(\'form\');
        form.method = \'POST\';
        form.action = \'touristprofile.php\';

        var param1 = document.createElement(\'input\');
        param1.type = \'hidden\';
        param1.name = \'tid\';
        param1.value = \''.$touristId.'\';
        form.appendChild(param1);  
       
        document.body.appendChild(form);

        // Submit the form
        form.submit();
    }</script>';

    
}


?>