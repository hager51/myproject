// AJAX Register
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

// AJAX Login
$('#loginForm').submit(function(e) {
  e.preventDefault();
  $.ajax({
    type: 'POST',
    url: 'php/login.php',
    data: $(this).serialize(),
    success: function(response) {
      const data = JSON.parse(response);
      if (data.token) {
        window.location.href = 'protected/project.php';
      }
    },
    error: function(xhr) {
      $('#loginMsg').html("<span class='text-danger'>Invalid credentials</span>");
    }
  });
});
