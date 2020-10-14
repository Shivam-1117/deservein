$('#target').change(function(event) {
  var form = $("#target");
  var txt3 = form.find('input[name = "email"]').val();
  window.console && console.log('Sending POST');
  $.post( 'val_email.php', { 'email': txt3 },
  function( data ) {
        window.console && console.log(data);
        msg = data;
        $('#result1').empty().append(data);
      }
  ).error( function() {
    $('#target').css('background-color', 'red');
    alert("Dang!");
});
});
