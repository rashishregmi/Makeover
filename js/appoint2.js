// appointment2.js
document.addEventListener("DOMContentLoaded", function () {
    const logoutLink = document.getElementById("logout-link");
    logoutLink.addEventListener("click", function (e) {
        e.preventDefault();
        const confirmationPopup = document.createElement("div");
        confirmationPopup.classList.add("confirmation-popup");
        confirmationPopup.innerHTML = `
            <p>Are you sure you want to logout?</p>
            <button id="logout-yes" class="btn">Yes</button>
            <button id="logout-no" class="btn">No</button>
        `;

        document.body.appendChild(confirmationPopup);
        const logoutYesButton = document.getElementById("logout-yes");
        const logoutNoButton = document.getElementById("logout-no");

        logoutYesButton.addEventListener("click", function () {
            window.location.href = "http://localhost/Makeover/html/login.html";
            document.body.removeChild(confirmationPopup);
        });

        logoutNoButton.addEventListener("click", function () {
            document.body.removeChild(confirmationPopup);
        });
    });

    const fullnameInput = document.getElementById("fullname");
    const nameRegex = /^[a-zA-Z]{3,}\s[a-zA-Z]{3,}$/;

    const validateFullName = () => {
        const fullname = fullnameInput.value.trim();
        if (!nameRegex.test(fullname)) {
            alert("Full Name must be at least 3 characters before the space, followed by a space, and then at least 3 characters after the space.");
            fullnameInput.focus();
            return false;
        }
        return true;
    };

    fullnameInput.addEventListener("input", function (e) {
        const inputText = e.target.value;
        const filteredText = inputText.replace(/[^a-zA-Z\s]/g, "");
        if (inputText !== filteredText) {
            e.target.value = filteredText;
        }
    });

    const contactInput = document.getElementById("contact");
    const contactRegex = /^(98|97)\d{8}$/;

    const validateContact = () => {
        const contact = contactInput.value.trim();
        if (!contactRegex.test(contact)) {
            alert("Contact Number must be exactly 10 digits and start with '98' or '97'.");
            contactInput.focus();
            return false;
        }
        return true;
    };

    contactInput.addEventListener("input", function (e) {
        const inputText = e.target.value;
        const filteredText = inputText.replace(/[^0-9]/g, "");
        if (inputText !== filteredText) {
            e.target.value = filteredText;
        }
    });

    const bookButton = document.getElementById("bookButton");
    bookButton.addEventListener("click", function (e) {
        e.preventDefault();
        if (validateFullName() && validateContact() && validateTopics() && validateDateAndTime()) {
            showSuccessMessage();
            resetFormFields();
        }
    });

    // Check if at least one checkbox is checked
    const validateTopics = () => {
        const checkboxes = document.querySelectorAll('input[name="topics[]"]');
        const checkedTopics = Array.from(checkboxes).some((checkbox) => checkbox.checked);
        if (!checkedTopics) {
            alert("Please select at least one service from the list.");
            return false;
        }
        return true;
    };

    // Check if date and time fields are filled with valid values
    const validateDateAndTime = () => {
        const dateInput = document.querySelector('input[type="date"]');
        const timeInput = document.querySelector('input[type="time"]');

        const currentDate = new Date();
        const currentYear = currentDate.getFullYear();
        const currentMonth = (currentDate.getMonth() + 1).toString().padStart(2, "0");
        const currentDay = currentDate.getDate().toString().padStart(2, "0");
        const currentHour = currentDate.getHours().toString().padStart(2, "0");
        const currentMinute = currentDate.getMinutes().toString().padStart(2, "0");

        const currentDateTime = `${currentYear}-${currentMonth}-${currentDay}T${currentHour}:${currentMinute}`;

        const selectedDate = dateInput.value;
        const selectedTime = timeInput.value;

        if (selectedDate < currentDateTime) {
            alert("Please select a present or future date.");
            return false;
        }

        if (selectedTime < "10:00" || selectedTime > "18:00") {
            alert("Please select a time between 10 AM and 6 PM.");
            return false;
        }

        const selectedDateTime = new Date(`${selectedDate} ${selectedTime}`);
        if (selectedDateTime <= currentDate.getTime() + 30 * 60 * 1000) {
            alert("Please select a date and time that is at least 30 minutes in the future.");
            return false;
        }

        return true;
    };

    // Show success message
    const showSuccessMessage = () => {
        alert("Appointment booked successfully!");
    };

    // Reset form fields to their default values
    const resetFormFields = () => {
        fullnameInput.value = "";
        contactInput.value = "";

        const checkboxes = document.querySelectorAll('input[name="topics[]"]');
        checkboxes.forEach((checkbox) => (checkbox.checked = false));

        const currentDate = new Date();
        const currentYear = currentDate.getFullYear();
        const currentMonth = (currentDate.getMonth() + 1).toString().padStart(2, "0");
        const currentDay = currentDate.getDate().toString().padStart(2, "0");
        const currentHour = currentDate.getHours().toString().padStart(2, "0");
        const currentMinute = currentDate.getMinutes().toString().padStart(2, "0");

        const currentDateTime = `${currentYear}-${currentMonth}-${currentDay}T${currentHour}:${currentMinute}`;
        const dateInput = document.querySelector('input[type="date"]');
        const timeInput = document.querySelector('input[type="time"]');
        dateInput.value = currentDateTime;
        timeInput.value = "10:00"; // Set default time to 10 AM
    };
});
