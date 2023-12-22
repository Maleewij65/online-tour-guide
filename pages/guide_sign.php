
<?php
include 'config/database.php';

if($_SERVER['REQUEST_METHOD']==="POST")
{

    $fname_g = $_POST['fname_g'];
    $lname_g= $_POST['lname_g'];
    $email_g= $_POST['email_g'];
    $pass_g= $_POST['pass_g'];
    $repass_g= $_POST['repass_g'];
    $policy = $POST['isAccepted'];
}
$quiere= 'SELECT guideId FROM tourguide';
$results= mysqli_query($conn,$quiere);
$guides = mysqli_fetch_all($results,MYSQLI_ASSOC);


if($email_g != null)
{
    $quiere_mail = 'SELECT * FROM tourguide where email = ?';
    $statement = $conn->prepare($quiere_mail);
    $statement->bind_param('s',$email_g);
    $statement->execute();
    $res=$statement->get_result();
    $user = mysqli_fetch_array($res);
    if($user == null)
    {
        //register
        $cnt= getCountTG($conn);
        $newUser = [$cnt,$email_g,$pass_g,$fname_g,$lname_g];
        var_dump($newUser);
        if(!strcmp($pass_g,$repass_g)) //password validation with caps sensitivity
        {
            //register
            
            registerTG($newUser,$conn,$cnt);
        }
        else
        {
            redirect("Re - entered password did not match <br>
                    Try again");
        }
        
    }
    else
    {
        redirect("The user already registered as a tour guide </br>
        Try <a href='login.php'>Log in </a> instead");
    }                     
}


function registerTG($newUser,$conn,$id)
{
    $quiere_mail = 'INSERT INTO tourguide(guideId,email,pass,firstName,lastName)
    values(?,?,?,?,?)';
    $statement = $conn->prepare($quiere_mail);
    $statement->bind_param('issss',$newUser[0],$newUser[1],$newUser[2],$newUser[3],$newUser[4]);
    $res = $statement->execute();
    if($res) 
    {
        echo '<scrpit>alert(User registered successfully);</script>';
        SendLoginInfo($id);
    }
    else
    {
        echo '<scrpit>alert(User registered unsuccessfull);</script>';
    }
    
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
function redirect($msg)
{  
    session_start();
    $_SESSION['msg'] = $msg;
    header('Location: signform.php');
    exit;
       
}


function getCountTG($conn)
{
    $sql = 'SELECT MAX(guideId) as gid FROM tourguide';

    $res = mysqli_query($conn,$sql);
    $ans = mysqli_fetch_assoc($res);
    $max = $ans["gid"];
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