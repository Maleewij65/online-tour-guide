<?php include'config/database.php';
    session_start();
    if($_SERVER['REQUEST_METHOD'] =="POST")
    {
       $_SESSION['ademail'] =$_POST['ademail'];
       $_SESSION['adpwd'] =$_POST['adpwd'];
    }    
?>
<body>    
    <div class="wrapper">
        <header>
            <a href="../index.php"><img id="logo" src="../images/logo.svg" alt=""></a>
            <h1>ADMIN PORTAL<h1>
            <nav>      
                <ul id = 'admin_nav' class="hide" >
                    <li><a href="logout.php">Log out</a></li>
                </ul>                     
            </nav>
        </header>