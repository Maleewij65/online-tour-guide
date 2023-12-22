
function UpdateValue()
{
    var duration = document.getElementById("dura");
    var selDuration = duration.value;
    
    document.getElementById("dtion").innerHTML = selDuration;
}

function hidePop()
{
    let popmenu = document.getElementById("pwd-reset");
    popmenu.classList.add ("hide");
}

function viewPop()
{
    let popmenu = document.getElementById("pwd-reset");
    popmenu.classList.remove("hide");
}

function hideCd()
{
    let popmenu = document.getElementById("chg-det");
    popmenu.classList.add ("hide");
}

function viewCd()
{
    let popmenu = document.getElementById("chg-det");
    popmenu.classList.remove("hide");
}
function callRemove(btn)
{
  var rid = btn.getAttribute('data-button-id'); 

  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'logics/requestremove.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Request completed and successful
        console.log(xhr.responseText);
        location.reload();
      }
  }
  xhr.send('reqId=' + encodeURIComponent(rid));
}