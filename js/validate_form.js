function submit_form() {
if (validate())
{
document.getElementById("target").submit();
alert("Joined Successfully :)");
return true;
}
else{
  return false;
}
}

function validate() {
  var txt1 = document.getElementById("fn").value;
  var txt2 = document.getElementById("ln").value;
  var txt3 = document.getElementById("un").value;
  var txt4 = document.getElementById("em").value;
  var txt5 = document.getElementById("con").value;
  var txt6 = document.getElementById("password-field").value;
  var txt7 = document.getElementById("password-field1").value;
  if(txt1 === '' || txt2 === '' || txt3 === '' || txt4 === '' || txt5 === '' || txt6 === '' || txt7 === ''){
    alert("All fields are required !");
    return false;
  }
  return true;
}
