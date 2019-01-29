function surligne(champ, erreur)
{
   if(erreur)
      champ.style.backgroundColor = "#fba";
   else
      champ.style.backgroundColor = "";
}

function verifMail(champ)
{
   var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
   if(!regex.test(champ.value))
   {
      surligne(champ, true);
      $("#mail").removeClass("valid");    
      return false;
   }
   else
   {
      surligne(champ, false);
      $("#mail").addClass("valid");
      return true;
   }
}

function verifPrenom(champ)
{
   var regex = /^[A-Z][A-Za-z\é\è\ê\-]+$/;
   if(!regex.test(champ.value))
   {
      surligne(champ, true);
      $("#prenom").removeClass("valid");    
      return false;
   }
   else
   {
      surligne(champ, false);
      $("#prenom").addClass("valid");
      return true;
   }
}

function verifNom(champ)
{
   var regex = /^[A-Z][A-Za-z\é\è\ê\-]+$/;
   if(!regex.test(champ.value))
   {
      surligne(champ, true);
      $("#nom").removeClass("valid");    
      return false;
   }
   else
   {
      surligne(champ, false);
      $("#nom").addClass("valid");
      return true;
   }
}

function verifPass(champ)
{
   var regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$/;
   if(!regex.test(champ.value))
   {
      surligne(champ, true);
      $("#pass").removeClass("valid");    
      return false;
   }
   else
   {
      surligne(champ, false);
      $("#pass").addClass("valid");
      return true;
   }
}

function verifDescription(champ)
{
   var regex = /.{1,200}/;
   if(!regex.test(champ.value))
   {
      surligne(champ, true);
      $("#desc").removeClass("valid");    
      return false;
   }
   else
   {
      surligne(champ, false);
      $("#desc").addClass("valid");
      return true;
   }
}

function verifLieu(champ)
{
   var regex = /.{1,50}/;
   if(!regex.test(champ.value))
   {
      surligne(champ, true);
      $("#lieu").removeClass("valid");    
      return false;
   }
   else
   {
      surligne(champ, false);
      $("#lieu").addClass("valid");
      return true;
   }
}

function verifDate(champ)
{
   var datenum1 = document.getElementById("date1").value;
   var datenum2 = document.getElementById("date2").value;
   var datenum3 = document.getElementById("date3").value;

   var regex = /^[0-9]{2}$/;

   if(regex.test(datenum1) && regex.test(datenum2) && regex.test(datenum3))
   {
      surligne(champ, false);
      $("#date1").addClass("valid");
      $("#date2").addClass("valid");
      $("#date3").addClass("valid");
      return true;
   }
   else
   {
      $("#date1").removeClass("valid");
      $("#date2").removeClass("valid");
      $("#date3").removeClass("valid");         
      return false;
   }
}

function verifEvent(champ)
{
   var regex = /^.{1,45}$/;
   if(!regex.test(champ.value))
   {
      surligne(champ, true);
      $("#event").removeClass("valid");    
      return false;
   }
   else
   {
      surligne(champ, false);
      $("#event").addClass("valid");
      return true;
   }
}

function verifPrix(champ)
{
   var regex = /^[0-9]{1,}(\.[0-9]{1,2}){0,1}$/;
   if(!regex.test(champ.value))
   {
      surligne(champ, true);
      $("#prix").removeClass("valid");
      return false;
   }
   else
   {
      surligne(champ, false);
      $("#prix").addClass("valid");
      return true;
   }
}

function verifPass1(champ)
{

   var pw1 = document.getElementById('pass1').value;
   var pw2 = document.getElementById('pass2').value;

   var regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$/;

   if(!regex.test(champ.value) || !(pw1 == pw2))
   {
      surligne(champ, true);
      $("#pass1").removeClass("valid");
      $("#pass2").removeClass("valid");      
      return false;
   }
   else
   {
      surligne(champ, false);
      $("#pass1").addClass("valid");
      $("#pass2").addClass("valid");
      return true;
   }
}

function verifForm(f)
{
   var bool = true;
   bool = haveError(f);
   
   if(!bool)
   {
      alert("Veuillez remplir correctement tous les champs");
      return false;
   }
   else
   {
      return true;
   }
}

function haveError(child)
{
   var bool = true;
   $(child).find("*").each(function() {
      if($(this).hasClass("mustCheck") && !$(this).hasClass("valid"))
      {
         console.log('zbeub');
         bool = false;
      }
   });
   return bool;
}