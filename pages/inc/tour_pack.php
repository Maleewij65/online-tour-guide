<?php 
  
  $sql = 'SELECT * FROM tourPackage';
  $results = mysqli_query($conn,$sql);
  $packages = mysqli_fetch_all($results,MYSQLI_ASSOC); //store fetch data on array
  //var_dump($packages);
  
  
  function createPackage($pkgId,$package_name,$destination_pkg,$pkg_img_path,$pkg_description,$price)
  {
        $iconpath = "../images/elements/location_indicator.png";
        echo "<div class='package-container' id='tpk'>";
        echo "<div class='package-dest'>";
        echo "<img src =".$iconpath." alt='dest-icon'>";
        echo "<h4 id='city-name'>".$destination_pkg."</h4></div>";
        echo "<div class='package-mid-sec'>";
        echo "<div class='dest-pic'>";
        echo "<img src=".$pkg_img_path." id='package-img'></div>";
        echo "<div class='package-disc'>";
        echo "<h5>Description</h5>";
        echo "<p id='pkg-description'>".$pkg_description."</p></div></div>";
        echo "<div class='package-end-sec'>";
  
        echo"<h3 id='pkg-name'>".$package_name."</h3>";
        echo"<h3 id='pkg-price'>".$price."</h3></div>";
        echo"<div class='pkg-ctrl'>";
        echo"<button class='hide'>delete</button>";
        echo '<button id="view-tour" class="vb" data-button-id='.$pkgId.' onclick="popT(this)">View</button></div></div>';
  }

  function defaultPack($n)
  {
        
        $pkg_img = "../images/cities/kdy.jpg";
        $pkg_desc = "officia molestiae sed culpa ipsam libero quasi veniam reiciendis aliquam voluptatibus necessitatibus ratione cum?";
        $i=0;
        for($i=0;$i<$n;$i++)
        {
            createPackage(111111,"package name","colombo",$pkg_img,$pkg_desc,50000);
        }
  }

  function showPkg($arryTourPackages)
  {
        $pkg_img = "../images/cities/kdy.jpg";
        foreach($arryTourPackages as $pkg)
        {
            showSinglePkg($pkg);
            
        }
  }

  function showSinglePkg($pkg)
  {
        $pkg_img = $pkg['pkgImage'];
        //var_dump($pkg_img);
        //$pkg_img = "../images/cities/kdy.jpg";
        createPackage($pkg['pkgId'],$pkg['pkgName'],$pkg['destination'],$pkg_img,$pkg['description'],$pkg['priceAdult']);
        
  }

  function showSearchResults($city,$allPacks)
  {
      $searchs =0; 
      foreach($allPacks as $pks)
      {
           
          if(!strnatcasecmp($city,$pks['destination']))
          {
               showSinglePkg($pks);
               $searchs++;
          }
      }
      if($searchs === 0)
      {
        echo "<h2>Sorry we could not find the packages for the location ".$city."</h2>";
      }

  }

  //this function will sort packages by rating
  function SortPackagesByRatings($min_rating,$pkg_arry)
  {
       foreach($pkg_arry as $pkg)
       {
           if($pkg['rating']>=$min_rating)
           {
            showSinglePkg($pkg);
           }           
       }
  }
  function SortPackagesByGuideId($gid,$pkg_arry)
  {
       $searchs =0; 
       foreach($pkg_arry as $pkg)
       {
           if($pkg['guideId']==$gid)
           {
            showSinglePkg($pkg);
            $searchs++;
           }           
       }
       if($searchs === 0)
      {
        echo "<h2>Guide has not created any packages</h2>";
      }

  }

  

  
  
  

?>