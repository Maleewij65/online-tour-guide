
<?php
include 'config/database.php';

if($_SERVER['REQUEST_METHOD']==="POST")
{

    $fname_t = $_POST['fname_t'];
    $lname_t= $_POST['lname_t'];
    $email_t= $_POST['email_t'];
    $pass_t= $_POST['pass_t'];
    $repass_t= $_POST['repass_t'];
    $policy = $POST['isAccepted'];
}
$quiere= 'SELECT touristId FROM tourists';
$results= mysqli_query($conn,$quiere);
$tourists = mysqli_fetch_all($results,MYSQLI_ASSOC);


if($email_t != null)
{
    $quiere_mail = 'SELECT * FROM tourists where email = ?';
    $statement = $conn->prepare($quiere_mail);
    $statement->bind_param('s',$email_t);
    $statement->execute();
    $res=$statement->get_result();
    $user = mysqli_fetch_array($res);
    if($user == null)
    {
        //register
        $cnt= getCountTOU($conn);
        $newUser = [$cnt,$email_t,$pass_t,$fname_t,$lname_t];
        if(!strcmp($pass_t,$repass_t)) //password validation with caps sensitivity
        {
            //register
            
            registerTourist($newUser,$conn,$cnt);
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


function registerTourist($newUser,$conn,$id)
{
    $quiere_mail = 'INSERT INTO tourists(touristId,email,pass,firstName,lastName)
    values(?,?,?,?,?)';
    $statement = $conn->prepare($quiere_mail);
    $statement->bind_param('issss',$newUser[0],$newUser[1],$newUser[2],$newUser[3],$newUser[4]);
    $res = $statement->execute();
    if($res) 
    {
        echo '<script>alert("User registered succussfully");</script>';
        SendLoginInfo($id);
    }
    else
    {
        echo '<script>alert("Error occurred during the process");</script>';
        redirect("Try Again !");
    }
    
}

function SendLoginInfo($touristId)
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
 




function redirect($msg)
{  
    session_start();
// Store the POST data in session variables
    $_SESSION['msg'] = $msg;

// Redirect to the desired page
    header('Location: signformt.php');
    exit;
       
}

function getCountTOU($conn)
{
    $sql = 'SELECT MAX(touristId) as tid FROM tourists';

    $res = mysqli_query($conn,$sql);
    $ans = mysqli_fetch_assoc($res);
    $max = $ans["tid"];
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