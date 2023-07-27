//email password transition
const inputBoxes = document.querySelectorAll('.input-box');

inputBoxes.forEach(inputBox => {
    const input = inputBox.querySelector('input');
    const label = inputBox.querySelector('label');

    input.addEventListener('input', () => {
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

//swapping
const wrapper= document.querySelector('.wrapper');
const loginLink= document.querySelector('.login-link');
const registerLink= document.querySelector('.register-link');

registerLink.addEventListener('click',()=>{
    wrapper.classList.add('active');
});

loginLink.addEventListener('click',()=>{
    wrapper.classList.remove ('active');
});


 
  const loginForm = document.querySelector(".form-box.login form");
  const registerForm = document.querySelector(".form-box.register form");

  function showErrorAlert(message) {
    alert(message);
  }

  function validateEmail(email) {
    // Simple email validation regex
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  function validatePassword(password) {
    // Password should be at least 8 characters, with at least one uppercase letter and one special character
    const passwordRegex = /^(?=.*[A-Z])(?=.*[!@#$%^&*])[A-Za-z!@#$%^&*]{8,}$/;
    return passwordRegex.test(password);
  }

  function register(username, email, password) {
    if (!username || !email || !password) {
      showErrorAlert("All fields are required.");
      return false;
    }

    if (username.length < 3) {
      showErrorAlert("Username should be at least 3 characters long.");
      return false;
    }

    if (!validateEmail(email)) {
      showErrorAlert("Invalid email address.");
      return false;
    }

    if (!validatePassword(password)) {
      showErrorAlert(
        "Password should be at least 8 characters long, with at least one uppercase letter and one special character."
      );
      return false;
    }

    if (!document.querySelector(".form-box.register input[type='checkbox']").checked) {
      showErrorAlert("Please agree to the terms and conditions.");
      return false;
    }

    return true;
  }

  function login(email, password) {
    if (!email || !password) {
      showErrorAlert("Please fill in all fields.");
      return false;
    }

    if (!validateEmail(email)) {
      showErrorAlert("Invalid email address.");
      return false;
    }

    if (!validatePassword(password)) {
      showErrorAlert("Invalid password.");
      return false;
    }

    return true;
  }

  loginForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const email = loginForm.querySelector('input[type="email"]').value;
    const password = loginForm.querySelector('input[type="password"]').value;

    if (login(email, password)) {
      // Perform login action
      // For example, you can submit the form to the server here
      alert("Login successful!");
    }
  });

  registerForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const username = registerForm.querySelector('input[type="text"]').value;
    const email = registerForm.querySelector('input[type="email"]').value;
    const password = registerForm.querySelector('input[type="password"]').value;

    if (register(username, email, password)) {
      // Perform registration action
      // For example, you can submit the form to the server here
      alert("Registration successful!");
    }
  });
 
