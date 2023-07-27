
document.addEventListener("DOMContentLoaded", function () {
    const firstNameInput = document.querySelector('input[placeholder="First Name"]');
    const lastNameInput = document.querySelector('input[placeholder="Last Name"]');
    const contactNumberInput = document.querySelector('input[placeholder="Contact Number"]');
    const emailInput = document.querySelector('input[placeholder="Email"]');
    const messageTextarea = document.querySelector('textarea[placeholder="Your Message"]');
    const sendButton = document.querySelector('.btn');

    // Function to check if a string contains only alphabetical characters
    function isAlphabetical(value) {
      return /^[A-Za-z]+$/.test(value);
    }

    // Function to filter the input to allow only alphabetic characters
    function filterAlphabeticInput(inputElement) {
      inputElement.addEventListener("input", function () {
        const inputValue = inputElement.value;
        const filteredValue = inputValue.replace(/[^A-Za-z]/g, '');
        if (inputValue !== filteredValue) {
          inputElement.value = filteredValue;
        }
      });
    }

    filterAlphabeticInput(firstNameInput);
    filterAlphabeticInput(lastNameInput);

    sendButton.addEventListener("click", function () {
      // Reset previous error messages
      const errorMessages = [];

      // Validate first name
      const firstNameValue = firstNameInput.value.trim();
      if (!isAlphabetical(firstNameValue) || firstNameValue.length < 3) {
        errorMessages.push("First name should contain at least 3 alphabetical characters.");
      }

      // Validate last name
      const lastNameValue = lastNameInput.value.trim();
      if (!isAlphabetical(lastNameValue) || lastNameValue.length < 3) {
        errorMessages.push("Last name should contain at least 3 alphabetical characters.");
      }

      // Validate contact number
      const contactNumberValue = contactNumberInput.value.trim();
      if (!/^98|97\d{8}$/.test(contactNumberValue)) {
        errorMessages.push("Contact number should start with '98' or '97' and be 10 digits long.");
      }

      // Validate email
      const emailValue = emailInput.value.trim();
      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailValue)) {
        errorMessages.push("Invalid email address.");
      }

      // Validate message
      const messageValue = messageTextarea.value.trim();
      if (messageValue === "") {
        errorMessages.push("Please enter your message.");
      }

      // Display the first error message if any
      if (errorMessages.length > 0) {
        alert(errorMessages[0]);
      } else {
        // If no errors, proceed with form submission (you can implement this part as needed)
        alert("Form submitted successfully!");
        document.querySelector('form').reset(); // Reset the form fields after successful submission
        location.reload(); // Reload the page after successful submission
      }
    });
  });