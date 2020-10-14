function togglePassword(){
var type = document.getElementById("password-field").type;
if(type=='password'){
 document.getElementById("password-field").type = "text";
 }else{
  document.getElementById("password-field").type = "password";
 }
 var type = document.getElementById("password-field1").type;
 if(type=='password'){
  document.getElementById("password-field1").type = "text";
  }else{
   document.getElementById("password-field1").type = "password";
  }
}
