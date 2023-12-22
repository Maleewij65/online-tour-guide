

function validateName(name) {
    var expression = /^[a-zA-Z\s]+$/;
  
    return expression.test(name);
}
function validMail(mail)
{
    var expr = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return expr.test(mail);
}

function checkforName(inputId)
{
    let name =document.getElementById(inputId).value;
    if(!validateName(name))
    {
        document.getElementById("wrn").innerHTML="Please enter a valid name!-numbers,special characters are invalid";
        
    }
    else
    {
        document.getElementById("wrn").innerHTML="";
    }
   
}
function checkforEmail(inputId)
{
    let email =document.getElementById(inputId).value;
    if(!validMail(email))
    {
        document.getElementById("wrn").innerHTML="Please enter a valid email!";
        
    }
    else
    {
        document.getElementById("wrn").innerHTML="";
    }

}

