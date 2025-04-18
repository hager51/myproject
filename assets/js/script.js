// AJAX for registration
$('#registerForm').submit(function(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: 'php/register.php',
      data: $(this).serialize(),
      success: function(response) {
        $('#registerMsg').html(response);
      }
    });
  });
  
  // AJAX for login
  $('#loginForm').submit(function(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: 'php/login.php',
      data: $(this).serialize(),
      success: function(response) {
        $('#loginMsg').html(response);
      }
    });
  });
  