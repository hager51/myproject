const loginForm = document.getElementById('loginForm');
const registerForm = document.getElementById('registerForm');
const messageDiv = document.getElementById('message');

function showForm(form) {
    if (form === 'login') {
        loginForm.style.display = 'block';
        registerForm.style.display = 'none';
    } else {
        loginForm.style.display = 'none';
        registerForm.style.display = 'block';
    }
    messageDiv.innerHTML = '';
}

// Handle Login
loginForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;
    const loginBtn = document.getElementById('loginBtn');

    loginBtn.disabled = true;
    loginBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> جاري الدخول...';

    try {
        const res = await fetch('php/login.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({email, password})
        });

        const data = await res.json();
        if (data.token) {
            sessionStorage.setItem('jwt', data.token);
            Swal.fire({
                icon: 'success',
                title: 'You are logged in',
                text: 'You are being redirected to the control panel...',
                timer: 1000,
                showConfirmButton: false
            });
            setTimeout(() => window.location.href = 'dashboard.html', 1000);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.error
            });
        }
    } catch (err) {
        Swal.fire({
          icon: 'error',
          title: 'Communication error',
          text: err.message
        });
    }

    loginBtn.disabled = false;
    loginBtn.innerHTML = 'Login';
});


// Handle Register
registerForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const username = document.getElementById('registerUsername').value;
    const email = document.getElementById('registerEmail').value;
    const password = document.getElementById('registerPassword').value;
    const registerBtn = document.getElementById('registerBtn');

    registerBtn.disabled = true;
    registerBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Registering...';

    try {
        const res = await fetch('php/register.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({username, email, password})
        });

        const data = await res.json();

        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Registration completed successfully',
                text: data.success
            });
            showForm('login');
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Registration failed',
                text: data.error
            });
        }

    } catch (err) {
        Swal.fire({
            icon: 'error',
            title: 'Communication error',
            text: err.message
        });
    }

    registerBtn.disabled = false;
    registerBtn.innerHTML = 'Register';
});
