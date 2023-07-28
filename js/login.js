const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');

registerLink.addEventListener('click', () => {
    if (!wrapper.classList.contains('active')) {
        wrapper.classList.add('active');
        clearInputFields('.form-box.login');
    }
});

loginLink.addEventListener('click', () => {
    if (wrapper.classList.contains('active')) {
        wrapper.classList.remove('active');
        clearInputFields('.form-box.register');
    }
});

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

    input.addEventListener('focus', () => {
        label.style.top = '-5px';
    });

    input.addEventListener('blur', () => {
        if (input.value.trim() === '') {
            label.style.top = '50%';
        }
    });

    if (input.value.trim() !== '') {
        inputBox.classList.add('input-filled');
    }
});

function clearInputFields(formBoxClass) {
    const inputFields = document.querySelectorAll(formBoxClass + ' input');
    inputFields.forEach(input => (input.value = ''));
}

document.addEventListener('DOMContentLoaded', () => {
    const registerForm = document.getElementById('register-form');
    if (!registerForm) {
        console.error("register-form not found in the DOM.");
        return;
    }

    registerForm.addEventListener('submit', (event) => {
        event.preventDefault();

        const usernameInput = document.getElementById('username');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const termsCheckbox = document.getElementById('terms');

        const usernameValue = usernameInput.value.trim();
        if (usernameValue.length < 3) {
            alert('Username should have at least 3 characters.');
            return;
        }

        const emailValue = emailInput.value.trim();
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailValue) || emailValue.length < 5) {
            alert('Please enter a valid email address with at least 5 characters.');
            return;
        }

        const passwordValue = passwordInput.value.trim();
        const passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        if (!passwordPattern.test(passwordValue)) {
            alert('Password should have at least 8 characters, 1 capital letter, and 1 special character.');
            return;
        }

        if (!termsCheckbox.checked) {
            alert('Please agree to the terms & conditions.');
            return;
        }

        // If all validations pass, manually submit the form
        registerForm.submit();
    });

    const loginForm = document.querySelector('.form-box.login form');
    if (!loginForm) {
        console.error("Login form not found in the DOM.");
        return;
    }

    const emailInputLogin = document.getElementById('email1');
    const passwordInputLogin = document.getElementById('password1');

    loginForm.addEventListener('submit', (event) => {
        event.preventDefault();

        const emailValue = emailInputLogin.value.trim();
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailValue) || emailValue.length < 5) {
            alert('Please enter a valid email address with at least 5 characters.');
            return;
        }

        const passwordValue = passwordInputLogin.value.trim();
        const passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        if (!passwordPattern.test(passwordValue)) {
            alert('Password should have at least 8 characters, 1 capital letter, and 1 special character.');
            return;
        }

        // If all validations pass, manually submit the form
        loginForm.submit();
    });
});
