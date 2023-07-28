 
    document.addEventListener("DOMContentLoaded", function () {
        const bookButton = document.getElementById("bookButton");
        bookButton.addEventListener("click", function (e) {
            e.preventDefault(); // Prevent form submission to test validation

            const fullNameInput = document.getElementById("fullname");
            const fullNameValue = fullNameInput.value.trim();
            const contactInput = document.getElementById("contact");
            const contactValue = contactInput.value.trim();
            const checkboxes = document.querySelectorAll('input[name="topics"]:checked');
            const dateInput = document.querySelector('input[type="date"]');
            const timeInput = document.querySelector('input[type="time"]');

            // Full name validation
            if (!fullNameValue) {
                alert("Type your full name");
                return;
            }

            // Regular expression to check if the full name contains only alphabets and a space
            const alphabetsWithSpaceRegex = /^[A-Za-z ]+$/;

            if (!alphabetsWithSpaceRegex.test(fullNameValue)) {
                alert("Full name should contain only alphabets (a to z) and a space.");
                return;
            }

            // Split the full name by space and check the length of both parts
            const [firstName, lastName] = fullNameValue.split(" ");
            if (!firstName || !lastName || firstName.length < 3 || lastName.length < 3) {
                alert("Full name should be in the format: First Name (at least 3 characters) Last Name (at least 3 characters)");
                return;
            }

            // Contact number validation
            const contactNumberRegex = /^(98|97)\d{8}$/;
            if (!contactNumberRegex.test(contactValue)) {
                alert("Contact number should be exactly 10 digits and start with '98' or '97'.");
                return;
            }

            // Checkbox validation
            if (checkboxes.length === 0) {
                alert("Select at least one checkbox");
                return;
            }

            // Date validation
            const currentDate = new Date();
            const selectedDate = new Date(dateInput.value);
            if (!dateInput.value || selectedDate < currentDate) {
                alert("Please select a date in the present or future");
                return;
            }

            // Time validation
            const selectedTime = new Date(`2000-01-01T${timeInput.value}`);
            const startTime = new Date(`2000-01-01T09:00`);
            const endTime = new Date(`2000-01-01T19:00`);
            if (!timeInput.value || selectedTime < startTime || selectedTime > endTime) {
                alert("Please select a time between 9 AM and 7 PM");
                return;
            }

            // If all validations pass, show the "Appointment booked" message
            alert("Appointment booked");

            // Reset the form to its initial state
            document.getElementById("appointment-form").reset();
        });
    });
 
