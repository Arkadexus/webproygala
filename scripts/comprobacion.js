$(document).ready(function()
{    
 $("#username").keyup(function()
 {  
  var name = $(this).val(); 
  
  if(name.length > 5)
  {  
   
   /*$.post("username-check.php", $("#reg-form").serialize())
    .done(function(data){
    $("#result").html(data);
   });*/
   
   $.ajax({
    
    type : 'POST',
    url  : 'scripts/username-check.php',
    data : $(this).serialize(),
    success : function(data)
        {
              $("#result").html(data);
              if(data == "<span style='color:brown;'>Este nombre de usuario ya se ha utilizado</span>"){
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
   $("#result").html("<span style='color:brown;'>El nombre de usuario debe tener más de 6 letras</span>");
   document.getElementById("Enviar").disabled = true;
  }
 });
 
});