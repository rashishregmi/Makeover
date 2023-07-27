
  function validateForm(event) {
    event.preventDefault(); // Prevent form submission

    // Reset previous error messages
    const errorMessages = document.querySelectorAll(".error-message");
    errorMessages.forEach((element) => (element.textContent = ""));

    const firstName = document.getElementById("firstname").value.trim();
    const lastName = document.getElementById("lastname").value.trim();
    const contact = document.getElementById("contact").value.trim();
    const email = document.getElementById("email").value.trim();
    const checkboxes = document.querySelectorAll("input[type=checkbox]:checked");
    const calendarDate = document.querySelector("input[type=date]").value;
    const time = document.querySelector("input[type=time]").value.trim();
    const openingHour = 9;
    const closingHour = 19;

    let errorMessage = null;

    // First Name Validation
    if (firstName.length < 3 || !/^[a-zA-Z]+$/.test(firstName)) {
      errorMessage = "First name should be at least 3 characters and contain only letters.";
    }

    // Last Name Validation
    else if (lastName.length < 3 || !/^[a-zA-Z]+$/.test(lastName)) {
      errorMessage = "Last name should be at least 3 characters and contain only letters.";
    }

    // Contact Number Validation
    else if (!/^[9][87]\d{8}$/.test(contact)) {
      errorMessage = "Contact number should start with '98' or '97' and be 10 digits long.";
    }

    // Email Validation
    else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
      errorMessage = "Invalid email address.";
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
        if (selectedTime.getHours() < openingHour || selectedTime.getHours() >= closingHour) {
          errorMessage = "Opening hours are from 9 am to 7 pm.";
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
    document.getElementById("appointment-form").submit();
  }

  const bookButton = document.getElementById("bookButton");
  bookButton.addEventListener("click", validateForm);
 