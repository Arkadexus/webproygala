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
              if(data == "<span style='color:brown;'>Este correo ya se ha utilizado</span>"){
                document.getElementById("Enviar").disabled = true;
              }else{
                document.getElementById("Enviar").disabled = false;
              }
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