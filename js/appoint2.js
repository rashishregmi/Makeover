document.addEventListener("DOMContentLoaded", function () {
  // Logout link functionality
  const logoutLink = document.getElementById("logout-link3");
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

  function validateForm(event) {
    event.preventDefault(); // Prevent form submission

    // Reset previous error messages
    const errorMessages = document.querySelectorAll(".error-message");
    errorMessages.forEach((element) => (element.textContent = ""));

    const fullnameInput = document.getElementById("fullname3");
    const fullname = fullnameInput.value.trim();
    const contact = document.getElementById("contact3").value.trim();
    const checkboxes = document.querySelectorAll("input[type=checkbox]:checked");
    const calendarDate = document.getElementById("myCalender3").value;
    const time = document.getElementById("timeInput3").value.trim();
    const openingHour = 10;
    const closingHour = 18;

    let errorMessage = null;

    // Full Name Validation
    if (!/^.{2,}\s.{3,}(\s.{3,})*$/.test(fullname)) {
      errorMessage = "Enter your Fullname";
      fullnameInput.focus();
    }

    // Contact Number Validation
    else if (!contact || !/^[9][87]\d{8}$/.test(contact)) {
      errorMessage = "Contact number should start with '98' or '97' and be 10 digits long.";
    }

    // Check if at least one checkbox is checked
    else if (checkboxes.length === 0) {
      errorMessage = "Please select at least one service.";
    }

    // Date and Time Validation
    else if (!calendarDate || !time) {
      errorMessage = "Please select both date and time.";
    }

    // Date Validation (must be today or in the future)
    else {
      const today = new Date();
      today.setHours(0, 0, 0, 0);
      const selectedDate = new Date(calendarDate);
      if (selectedDate < today) {
        errorMessage = "Date must be today or in the future.";
      } else {
        const selectedTime = new Date(`2000-01-01T${time}`);
        const currentHour = new Date().getHours();
        const currentMinute = new Date().getMinutes();

        // Check if time is at least 30 minutes after current time
        if (
          selectedTime.getHours() < openingHour ||
          selectedTime.getHours() > closingHour ||
          (selectedTime.getHours() === closingHour && selectedTime.getMinutes() > 0) ||
          (selectedTime.getHours() === currentHour && selectedTime.getMinutes() <= currentMinute + 30)
        ) {
          errorMessage = "Appointment can be booked only after half hour earlier";
        }
      }
    }

    // Show error message in alert if there is an error
    if (errorMessage !== null) {
      alert(errorMessage);
      return;
    }

    // If no errors, proceed with form submission
    alert("Appointment booked!");
    document.getElementById("appointment-form2").submit();
  }

  const bookButton = document.getElementById("bookButton3");
  bookButton.addEventListener("click", validateForm);
});
