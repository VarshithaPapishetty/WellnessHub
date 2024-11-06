document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    // Simulate a successful login
    alert('Login successful!');
});

document.getElementById('forgotPassword').addEventListener('click', function() {
    alert('Password recovery options will be provided here.');
});

document.getElementById('signupForm').addEventListener('submit', function(event) {
    event.preventDefault();
    // Simulate a successful signup
    alert('Signup successful!');
});
document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Perform login authentication here

    // For demonstration purposes, let's assume the login is successful
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    if (username === 'your_username' && password === 'your_password') {
        // Redirect to the dashboard page
        window.location.href = 'dashboard.html';
    } else {
        // Display error message or handle unsuccessful login
        alert('Invalid username or password. Please try again.');
    }
});
