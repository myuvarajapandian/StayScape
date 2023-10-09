
    <!-- layout page (it Connects through all pages) -->

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title' , 'Layout')</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <link rel="stylesheet" href="../css/app.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
  <div class="container">
    @yield('content')
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script>

    // Js function for location search 

    // Wait for the DOM to be fully loaded before executing the JavaScript
    document.addEventListener("DOMContentLoaded", function() {
      // Get references to various DOM elements using their IDs or classes
      const locationSearchForm = document.getElementById("location-search-form");
      const locationInput = document.getElementById("location-input");
      const roomCards = document.querySelectorAll(".room-card");
      const locationLinks = document.querySelectorAll(".location-link");

      // Add an event listener to the location search form for the "submit" event
      locationSearchForm.addEventListener("submit", function(e) {
        // Prevent the default form submission behavior, which would reload the page
        e.preventDefault();

        // Get the value entered in the location input field, trim spaces, and convert to lowercase
        const searchValue = locationInput.value.trim().toLowerCase();

        // Iterate through each room card
        roomCards.forEach(function(card) {
          // Get the data-location attribute of the card, trim spaces, and convert to lowercase
          const cardLocation = card.getAttribute("data-location").toLowerCase();

          // Check if the card's location includes the search value
          if (cardLocation.includes(searchValue)) {
            // If it includes the search value, display the card
            card.style.display = "block";
          } else {
            // If it doesn't include the search value, hide the card
            card.style.display = "none";
          }
        });
      });

      // Add an event listener to each location link
      locationLinks.forEach(function(link) {
        link.addEventListener("click", function(e) {
          // Prevent the default link navigation behavior
          e.preventDefault();

          // Get the text content of the clicked link, trim spaces, and convert to lowercase
          const linkText = link.textContent.trim().toLowerCase();

          // Iterate through each room card
          roomCards.forEach(function(card) {
            // Get the data-location attribute of the card, trim spaces, and convert to lowercase
            const cardLocation = card.getAttribute("data-location").toLowerCase();

            // Check if the card's location includes the text from the clicked link
            if (cardLocation.includes(linkText)) {
              // If it includes the text, display the card
              card.style.display = "block";
            } else {
              // If it doesn't include the text, hide the card
              card.style.display = "none";
            }
          });
        });
      });
    });

    // Js function for rent calculation

    document.addEventListener("DOMContentLoaded", function() {
      const checkInInput = document.getElementById("check-in");
      const checkOutInput = document.getElementById("check-out");
      const rentAmountInput = document.getElementById("rent-amount");

      // Get the element with the data-rent attribute
      const rentAmountDiv = document.querySelector('[data-rent]');

      // Access the rent value from the data-rent attribute
      const rentPerDay = parseFloat(rentAmountDiv.getAttribute('data-rent'));

      // Calculate and set the rent amount based on check-in and check-out dates
      function calculateRentAmount() {
        const checkInDate = new Date(checkInInput.value);
        const checkOutDate = new Date(checkOutInput.value);

        // Calculate the number of days between check-in and check-out
        const timeDiff = checkOutDate - checkInDate;
        const days = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

        const totalRent = days * rentPerDay;

        rentAmountInput.value = totalRent.toFixed(2); // Display with 2 decimal places
      }

      checkInInput.addEventListener('change', calculateRentAmount);
      checkOutInput.addEventListener('change', calculateRentAmount);
    });
  </script>

</body>

</html>