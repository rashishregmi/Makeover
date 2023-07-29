 
        document.addEventListener("DOMContentLoaded", function () {
            // Get the logout link element
            const logoutLink = document.getElementById("logout-link");

            // Add a click event listener to the logout link
            logoutLink.addEventListener("click", function (e) {
                e.preventDefault(); // Prevent the default behavior of the link

                // Show the popup confirmation dialog
                const confirmationPopup = document.createElement("div");
                confirmationPopup.classList.add("confirmation-popup");
                confirmationPopup.innerHTML = `
                    <p>Are you sure you want to logout?</p>
                    <button id="logout-yes" class="btn">Yes</button>
                    <button id="logout-no" class="btn">No</button>
                `;

                document.body.appendChild(confirmationPopup);

                // Add click event listeners to the "Yes" and "No" buttons in the popup
                const logoutYesButton = document.getElementById("logout-yes");
                const logoutNoButton = document.getElementById("logout-no");

                logoutYesButton.addEventListener("click", function () {
                    // If the user clicks "Yes", redirect to the login page
                    window.location.href = "http://localhost/Makeover/html/login.html";
                    document.body.removeChild(confirmationPopup);
                });

                logoutNoButton.addEventListener("click", function () {
                    // If the user clicks "No", remove the popup and do nothing (stay on the same page)
                    document.body.removeChild(confirmationPopup);
                });
            });

            const bookButton = document.getElementById("bookButton");
            bookButton.addEventListener("click", function (e) {
                e.preventDefault(); // Prevent form submission to test validation

                const fullNameInput = document.getElementById("fullname");
                const fullNameValue = fullNameInput.value.trim();

                // Full name validation
                if (!fullNameValue) {
                    alert("Enter your full name");
                    return;
                }

                // Regular expression to check if the full name contains at least 3 characters and a space
                const alphabetsWithSpaceRegex = /^[A-Za-z]{3,}\s[A-Za-z]{3,}$/;

                if (!alphabetsWithSpaceRegex.test(fullNameValue)) {
                    alert("Full name should be at least 3 characters long and should contain a space.");
                    return;
                }

                const contactInput = document.getElementById("contact");
                const contactValue = contactInput.value.trim();
                const checkboxes = document.querySelectorAll('input[name="topics"]:checked');
                const dateInput = document.querySelector('input[type="date"]');
                const timeInput = document.querySelector('input[type="time"]');

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
      
