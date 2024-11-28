document.getElementById('password').addEventListener('input', function() {
    const passwordInput = this.value;
    const messageElement = document.getElementById('message');

    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$€%^&*()_\-+=])[A-Za-z\d!@#$€%^&*()_\-+=]{12,}$/;

    if (passwordRegex.test(passwordInput)) {
        messageElement.textContent = "Valid password";
        messageElement.style.color = "green"; 
        messageElement.className = "valid"; 
    } else {
        messageElement.textContent = "Invalid password (at least 12 characters, one uppercase, one lowercase, one number and one special character)";
        messageElement.style.color = "red";  
        messageElement.className = "invalid";
    }

});