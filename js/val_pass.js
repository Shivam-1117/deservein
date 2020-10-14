$('#target').change(function(event) {
  var txt1 = $("#password-field").val();
  var txt2 = $("#password-field1").val();
  window.console && console.log('Sending POST');
  $.post( 'val_pass.php', { 'pass': txt1, 'cnf_pass' : txt2 },
  function( data ) {
        window.console && console.log(data);
        $('#result2').empty().append(data);
      }
  ).error( function() {
    $('#target').css('background-color', 'red');
    alert("Dang!");
});
});
