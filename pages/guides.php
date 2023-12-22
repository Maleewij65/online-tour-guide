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
    <link rel="stylesheet" href="../css/guide_cs.css">                              >    
    

    <title>SERENDIB TRAVELS| GUIDES </title>
</head>
<?php include 'inc/nav.php' ?>
        <main>
        <h1 class = 'tt-text'>Our Tour Guides</h1>
        <?php include 'inc/guide_card.php' ?>
        <div class="guide-results-container">
              <?php showAllGuides($guides) ?>
        </div>        
        
        </main>
        <script src="../javascripts/guides_js.js"></script>
    
<?php include 'inc/footer.php'?>