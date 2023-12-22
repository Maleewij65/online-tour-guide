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
    <link rel="stylesheet" href="../css/reg_cs.css">
    
    <title>SERENDIB TRAVELS| REGISTER </title>
</head>
<?php include 'inc/nav.php'?>
        <a href ="../admin.php">admin page</a><!--this is only used here because to acedemic staff do not know the admin url 
        our intention is admin should type the url and go to the portal without a link -->
        <main> 
              <div class="wrap-sec">
                <div class="wrap1">
                    <button id="sign-btn-1">I am a tourist</button>
                </div>                           
              </div>
              <div class="wrap-sec">
                <div class="wrap2">
                    <button id="sign-btn-2">Log in</button>
                </div>                           
              </div>
              <div class="wrap-sec">
                <div class="wrap3">
                    <button id="sign-btn-3">I am a tour guide</button>
                </div>                           
              </div>
                     

        </main>

        <script>
          const urls = ["signformt.php","login.php","signform.php"];
          const sign_btns = document.querySelectorAll("main button");

          sign_btns.forEach(element => {
          element.addEventListener("click",sort);  
          });

            function sort()
          {
    
            let btn = event.currentTarget;
          if (btn === sign_btns[0])
          {
            console.log(btn);
            console.log("btn 1");
            redirect(0);
          }
          else if(btn === sign_btns[1])
          {
             console.log(btn);
              console.log("btn 2")
              redirect(1);
            }
         else
          {
          console.log(btn);
          console.log("btn 3");
          redirect(2);
        }
        }

          function redirect(i)
        {
          console.log("Working");
          window.location.href =urls[i];
        }

        </script>

        

<?php include 'inc/footer.php'?>
