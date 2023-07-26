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