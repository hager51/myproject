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

    const res = await fetch('php/login.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({email, password})
    });

    const data = await res.json();
    if (data.token) {
        localStorage.setItem('jwt', data.token);
        messageDiv.innerHTML = `<span class="text-success">Login successful!</span>`;
        setTimeout(() => window.location.href = 'dashboard.html', 1000);
    } else {
        messageDiv.innerHTML = `<span class="text-danger">${data.error}</span>`;
    }
});

// Handle Register
registerForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const username = document.getElementById('registerUsername').value;
    const email = document.getElementById('registerEmail').value;
    const password = document.getElementById('registerPassword').value;

    const res = await fetch('php/register.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({username, email, password})
    });

    const data = await res.json();
    if (data.success) {
        messageDiv.innerHTML = `<span class="text-success">${data.success}</span>`;
        showForm('login');
    } else {
        messageDiv.innerHTML = `<span class="text-danger">${data.error}</span>`;
    }
});
