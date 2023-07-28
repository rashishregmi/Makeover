 // Swapping between login and registration forms
 const wrapper = document.querySelector('.wrapper');
 const loginLink = document.querySelector('.login-link');
 const registerLink = document.querySelector('.register-link');

 registerLink.addEventListener('click', () => {
     wrapper.classList.add('active');
 });

 loginLink.addEventListener('click', () => {
     wrapper.classList.remove('active');
 });

 // Email and password input transition
 const inputBoxes = document.querySelectorAll('.input-box');

 inputBoxes.forEach(inputBox => {
   
     const label = inputBox.querySelector('label');

     input.addEventListener('input', () => {
        const input = inputBox.querySelector('input');
         if (input.value.trim() !== '') {
             inputBox.classList.add('input-filled');
         } else {
             inputBox.classList.remove('input-filled');
         }
     });

     if (input.value.trim() !== '') {
         inputBox.classList.add('input-filled');
     }
 });

 // Registration form validation
 const registerButton = document.querySelector('.form-box.register .btn');
 const usernameInput = document.getElementById('username');
 const emailInput = document.getElementById('email');
 const passwordInput = document.getElementById('password');
 const termsCheckbox = document.querySelector('.form-box.register input[type="checkbox"]');

 registerButton.addEventListener('click', (event) => {
     event.preventDefault();

     // Check if username has at least 3 characters
     const usernameValue = usernameInput.value.trim();
     if (usernameValue.length < 3) {
         alert('Username should have at least 3 characters.');
         return;
     }

     // Check if the email is valid
     const emailValue = emailInput.value.trim();
     const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
     if (!emailPattern.test(emailValue)) {
         alert('Please enter a valid email address.');
         return;
     }

     // Check if password meets the requirements (at least 8 characters, 1 capital letter, and 1 special character)
     const passwordValue = passwordInput.value.trim();
     const passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
     if (!passwordPattern.test(passwordValue)) {
         alert('Password should have at least 8 characters, 1 capital letter, and 1 special character.');
         return;
     }

     // Check if the terms and conditions checkbox is checked
     if (!termsCheckbox.checked) {
         alert('Please agree to the terms & conditions.');
         return;
     }

     // Registration successful, redirect to login page
     window.location.href = "http://localhost/Makeover/html/login.html";
 });

 // Login form validation
 const loginButton = document.querySelector('.form-box.login .btn');
 const emailInputLogin = document.getElementById('email1');
 const passwordInputLogin = document.getElementById('password1');

 loginButton.addEventListener('click', (event) => {
     event.preventDefault();

     // Check if the email is valid
     const emailValue = emailInputLogin.value.trim();
     const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
     if (!emailPattern.test(emailValue)) {
         alert('Please enter a valid email address.');
         return;
     }

     // Check if password meets the requirements (at least 8 characters, 1 capital letter, and 1 special character)
     const passwordValue = passwordInputLogin.value.trim();
     const passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
     if (!passwordPattern.test(passwordValue)) {
         alert('Password should have at least 8 characters, 1 capital letter, and 1 special character.');
         return;
     }

     // Login successful, redirect to appoitment2 page
     window.location.href = "http://localhost/Makeover/html/Appointment2.html";
 });