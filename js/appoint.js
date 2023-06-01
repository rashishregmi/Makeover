document.getElementById("appointmentForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission

    // Get form values
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var phone = document.getElementById("phone").value;
    var date = document.getElementById("date").value;
    var time = document.getElementById("time").value;
    var message = document.getElementById("message").value;

    // Perform validation or additional processing if needed

    // Display a success message
    alert("Appointment request submitted successfully!");

    // Clear form fields
    document.getElementById("appointmentForm").reset();
  });