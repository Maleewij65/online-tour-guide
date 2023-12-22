function callApprove(btn)
{
  var pkgid = btn.getAttribute('data-button-id'); 
    console.log("calling approve function");

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'logics/packageappr.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // Request completed and successful
          console.log(xhr.responseText);
          location.reload();
        }
    }
    xhr.send('pakgId=' + encodeURIComponent(pkgid));
}

function callRemove(btn)
{
  var pkgid = btn.getAttribute('data-button-id'); 
  console.log("calling approve function");

  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'logics/packageremove.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Request completed and successful
        console.log(xhr.responseText);
        location.reload();
      }
  }
  xhr.send('pakgId=' + encodeURIComponent(pkgid));
}

function hideCd()
{
   let x = document.getElementById('cdf');
   x.classList.add('hide');
}
function viewCd()
{
  let x = document.getElementById('cdf');
  x.classList.remove('hide');
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