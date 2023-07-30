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

  const validateTopics = () => {
    const checkboxes = document.querySelectorAll('input[name="topics[]"]');
    const checkedTopics = Array.from(checkboxes).some((checkbox) => checkbox.checked);
    if (!checkedTopics) {
      alert("Please select at least one service from the list.");
      return false;
    }
    return true;
  };

  const validateDateAndTime = () => {
    const dateInput = document.querySelector('input[type="date"]');
    const timeInput = document.querySelector('input[type="time"]');

    const selectedDateTime = new Date(`${dateInput.value} ${timeInput.value}`);
    const currentTime = new Date();

    const timeDifference = (selectedDateTime - currentTime) / (1000 * 60);

    if (timeDifference < 30) {
      alert("You can only book an appointment at least 30 minutes from now.");
      return false;
    }

    const selectedTime = selectedDateTime.getHours();
    if (selectedTime < 10 || selectedTime >= 18) {
      alert("Please select a time between 10:00 AM and 6:00 PM.");
      return false;
    }

    return true;
  };

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
