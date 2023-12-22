<?php include'config/database.php';

if(session_status()===PHP_SESSION_NONE)
{
    session_start();
}//for tourist
if(isset($_SESSION['touristId']))
{
    $tid_nav = $_SESSION['touristId'];
    var_dump($tid_nav);
}
if(isset($_SESSION['guideId']))
{
    $gid_nav =$_SESSION['guideId'];
}

?>
<body>    
    <div class="wrapper">
        <header>
            <a href="#"><img id="logo" src="../images/logo.svg" alt=""></a>
            <nav>
                <ul id = 'normal_nav' >
                    <li><a href="../index.php" id="active ">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="tours.php">Tours</a></li>
                    <li><a href="guides.php">Guides</a></li>
                    <li><a href=<?php if(isset($tid_nav) || isset($gid_nav)){echo"logout.php";}else{echo "register.php";}?>><?php if(isset($tid_nav) || isset($gid_nav)){echo"log out";}else{echo "Register";}?></a></li>
                </ul>                    
            </nav>
        </header>

        
  