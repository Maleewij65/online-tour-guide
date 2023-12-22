
function hideT()
{
    let x = document.getElementById("tour-view"); 
    x.classList.add("hide");
}
function popT(btn)
{
    var id = btn.getAttribute('data-button-id'); 
     
    popPage();
    sendPkgID(id);
    
}

function popPage()
{  
    let x = document.getElementById("tour-view");
    x.classList.remove("hide");
    
}
function showReview()
{
    let review = document.getElementById("review-container");
    review.classList.remove("hide");
}
function closeReview()
{
    let review = document.getElementById("review-container");
    review.classList.add("hide");
}



function sendPkgID(id)
{
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'ajax_handler.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // Request completed and successful
          console.log(xhr.responseText);
          console.log(xhr.responseText[1]);
          var responseJson = xhr.responseText;
          var response = JSON.parse(responseJson);
          console.log(response);
          document.getElementById("pkg-name-pop").innerHTML=response['pkgName'];
          document.getElementById("pkg-id-pop").innerHTML="PKG - "+ response['pkgId'];
          document.getElementById("destination-pop").innerHTML="Destination : " + response['destination'];
          document.getElementById("duration-pop").innerHTML="Duration : " + response['duration'] + " days";
          document.getElementById("avail-pop").innerHTML=(response['avail'])?"Availabillity - AVAILABLE":"Availabillity - NOT AVAILABLE";
          document.getElementById("description-pop").innerHTML =response['description'];
          document.getElementById("price-pop").innerHTML="Package price : " + response['priceA'];
          document.getElementById("priceA-pop").innerHTML="Price for additional adult : " + response['priceAA'];
          document.getElementById("priceC-pop").innerHTML="Price for a child : " + response['priceChild'];
          document.getElementById("pkg-img-pop").src = response['pkgImage'];
          document.getElementById("pkg-guide-name-pop").innerHTML = response['guidefName']+" "+response['guidelName'];
          document.getElementById("book-btn").setAttribute("data-button-id", response['pkgId']);
          document.getElementById("r2").value=response['pkgId']; 
         var pkgReviews = response['reviews'];
          console.log(pkgReviews);
          reviewPosts(pkgReviews);
        }
      };
    
    xhr.send('clicked=' + encodeURIComponent(id));
    
    
}

function callBook(btn)
{
    let y = btn.getAttribute("data-button-id");
    console.log(y);
    var form = document.createElement('form');
        form.method = 'POST';
        form.action = 'payment.php';

        var param1 = document.createElement('input');
        param1.type = 'hidden';
        param1.name = 'pkgId';
        param1.value = y;
        form.appendChild(param1);  
       
        document.body.appendChild(form);

        // Submit the form
        form.submit();
}

function reviewPosts(reviews) {
    var revContainer = document.getElementById("rpk");

    // Clear any existing content in the container
    revContainer.innerHTML = "";

    // Loop through each reviews and create the HTML elements
    reviews.forEach(function(rev) {
      var revDiv = document.createElement("div");
      var tourist = document.createElement("h4");
      var context = document.createElement("p");

      tourist.textContent = rev['username'];
      context.textContent = rev['context'];

      revDiv.appendChild(tourist);
      revDiv.appendChild(context);

      revContainer.appendChild(revDiv);
    });
  }





