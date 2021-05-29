$(document).ready(function()
{    
 $("#mail").keyup(function()
 {  
  var mail = $(this).val(); 
  
  if(mail.length > 5)
  {  
   
   /*$.post("username-check.php", $("#reg-form").serialize())
    .done(function(data){
    $("#result").html(data);
   });*/
   
   $.ajax({
    
    type : 'POST',
    url  : 'scripts/email-check.php',
    data : $(this).serialize(),
    success : function(data)
        {
              $("#result2").html(data);
           }
    });
    return false;
   
  }
  else
  {
   $("#result2").html("");
  }
 });
 
});