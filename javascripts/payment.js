var bookD;

function dataValidation()
{

    console.log("Validation in process");
    let date = document.getElementById("dt1").value;
    let pkgId = document.getElementById("dt1").getAttribute("data-pkgid");
    let adults = document.getElementById("dt3").value;
    let childs = document.getElementById("dt4").value;
    let loyalty = document.getElementById("dt5").value;


    console.log(pkgId);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'logics/calcpacks.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // Request completed and successful
          console.log(xhr.responseText);
          var responseJson = xhr.responseText;
          var response = JSON.parse(responseJson);
          bookD = response;
          document.getElementById("dt2").value = response['arivalDate'];
          document.getElementById("tp").innerHTML ="Total : RS "+response['total'];
          document.getElementById("paa").innerHTML ="Price for additional adults : RS "+response['adultP'];
          document.getElementById("pc").innerHTML ="Price for children : RS "+response['childP'];
          document.getElementById("bn").innerHTML ="Loyalty Bonus : RS "+response['bonus'];
          document.getElementById("fi").innerHTML ="Total Paybale : RS "+response['final'];
          document.getElementById("dt7").value = response['final'];
          document.getElementById("dt8").value=response['arivalDate'];
        }
    }
    
    xhr.send("bkDate="+encodeURIComponent(date) +"&pkgId="+encodeURIComponent(pkgId)+"&adults="+encodeURIComponent(adults)+"&childs="+encodeURIComponent(childs)+"&loyalty="+encodeURIComponent(loyalty));
    
}

var currentDate = new Date();
var oneWeekFromNow = new Date(currentDate.getTime() + (7 * 24 * 60 * 60 * 1000));
var formatDate = oneWeekFromNow.toISOString().split("T")[0];
document.getElementById("dt1").min = formatDate;


