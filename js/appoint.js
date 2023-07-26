 
  const form = document.getElementById("appointment-form");
  const firstName = document.getElementById("firstname");
  const lastName = document.getElementById("lastname");
  const contactNumber = document.getElementById("contact");
  const email = document.getElementById("email");
  const services = document.querySelectorAll("input[type='checkbox'][name='topics']");
  const myDate = document.querySelector("input[type='date']");

  form.addEventListener("submit", function(event) {
    let errorMessage = "";

    if (firstName.value.trim() === "") {
      errorMessage += "Please enter your first name.\n";
    }

    if (lastName.value.trim() === "") {
      errorMessage += "Please enter your last name.\n";
    }

    const phoneNumberRegex = /^[0-9]{10}$/;
    if (!phoneNumberRegex.test(contactNumber.value)) {
      errorMessage += "Please enter a valid 10-digit contact number.\n";
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email.value)) {
      errorMessage += "Please enter a valid email address.\n";
    }

    let checkedService = false;
    services.forEach(service => {
      if (service.checked) {
        checkedService = true;
      }
    });

    if (!checkedService) {
      errorMessage += "Please select at least one service.\n";
    }

    const selectedDate = new Date(myDate.value);
    const currentDate = new Date();

    if (selectedDate < currentDate) {
      errorMessage += "Please select a future date.\n";
    }

    if (errorMessage !== "") {
      event.preventDefault();
      alert(errorMessage);
    }
  });
 
