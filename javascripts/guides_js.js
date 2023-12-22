
function viewGuide(btn)
{
    
    let x=btn.getAttribute("data-gid");
    console.log(x);
        
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'tours.php';

    var param1 = document.createElement('input');
    param1.type = 'hidden';
    param1.name = 'gid_guide';
    param1.value = x;
    form.appendChild(param1);

    document.body.appendChild(form);        
    form.submit();
    
}