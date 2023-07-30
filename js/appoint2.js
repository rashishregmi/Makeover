document.addEventListener("DOMContentLoaded", function () {
  // Logout link functionality
  const logoutLink = document.getElementById("logout-link2");
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

  // Full name validation
  const fullnameInput = document.getElementById("fullname2");
  const fullnameRegex = /^[a-zA-Z]{3,}\s[a-zA-Z]{3,}$/;

  const validateFullName = () => {
    const fullname = fullnameInput.value.trim();
    if (!fullnameRegex.test(fullname)) {
      alert("Enter your fullname. It must be at least 3 characters before the space, followed by a space, and then at least 3 characters after the space.");
      fullnameInput.focus();
      return false;
    }
    return true;
  };

  // Contact number validation
  const contactInput = document.getElementById("contact2");
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

  // Helper function to check if a time is valid (between 10:00 AM and 6:00 PM, in 30-minute increments)
  const isValidTime = (time) => {
    const minTime = new Date();
    minTime.setHours(10, 0, 0); // Minimum time: 10:00 AM
    const maxTime = new Date();
    maxTime.setHours(18, 0, 0); // Maximum time: 6:00 PM

    const selectedTime = new Date(`2000-01-01T${time}`);
    if (selectedTime < minTime || selectedTime >= maxTime) {
      return false;
    }

    // Check if time is in 30-minute increments
    const minutes = selectedTime.getMinutes();
    if (minutes !== 0 && minutes !== 30) {
      return false;
    }

    return true;
  };

  // Form validation and submission
  const bookButton = document.getElementById("bookButton2");
  bookButton.addEventListener("click", validateForm);

  function validateForm(event) {
    event.preventDefault(); // Prevent form submission

    // Reset previous error messages
    const errorMessages = document.querySelectorAll(".error-message");
    errorMessages.forEach((element) => (element.textContent = ""));

    const fullname = document.getElementById("fullname2").value.trim();
    const contact = document.getElementById("contact2").value.trim();
    const selectedDate = document.getElementById("myCalender2").value;
    const selectedTime = document.getElementById("timeInput2").value.trim();
    const currentTime = new Date();

    let errorMessage = null;

    // Full Name Validation
    if (!validateFullName()) {
      return;
    }

    // Contact Number Validation
    if (!validateContact()) {
      return;
    }

    // Check if at least one checkbox is checked
    const checkboxes = document.querySelectorAll('input[name="topics[]"]:checked');
    if (checkboxes.length === 0) {
      errorMessage = "Please select at least one service.";
      alert(errorMessage);
      return;
    }

    // Date and Time Validation
    const selectedDateTime = new Date(`${selectedDate}T${selectedTime}`);
    const minTimeDifference = 30 * 60 * 1000; // 30 minutes in milliseconds

    // Date Validation (must be today or in the future)
    if (selectedDateTime < currentTime) {
      errorMessage = "Date must be today or in the future.";
      alert(errorMessage);
      return;
    }

    // Time Validation (must be between 10:00 AM and 6:00 PM, in 30-minute increments)
    const openingHour = 10;
    const closingHour = 18;
    const currentHour = currentTime.getHours();
    const currentMinute = currentTime.getMinutes();
    const selectedTimeHour = parseInt(selectedTime.split(":")[0]);
    const selectedTimeMinute = parseInt(selectedTime.split(":")[1]);

    if (
      selectedTimeHour < openingHour ||
      selectedTimeHour > closingHour ||
      (selectedTimeHour === closingHour && selectedTimeMinute > 0) ||
      (selectedTimeHour === currentHour && selectedTimeMinute <= currentMinute + 30)
    ) {
      errorMessage = "Appointment can be booked only after half an hour earlier.";
      alert(errorMessage);
      return;
    }

    // Check if time is at least 30 minutes after the current time
    const timeDifference = selectedDateTime - currentTime;
    if (timeDifference < minTimeDifference) {
      errorMessage = "You can only book an appointment at least 30 minutes from now.";
      alert(errorMessage);
      return;
    }

    // If no errors, proceed with form submission
    showSuccessMessage();
    resetFormFields();
  }

  const showSuccessMessage = () => {
    alert("Appointment booked successfully!");
  };

  const resetFormFields = () => {
    fullnameInput.value = "";
    contactInput.value = "";

    const checkboxes = document.querySelectorAll('input[name="topics[]"]');
    checkboxes.forEach((checkbox) => (checkbox.checked = false));
  };
});
