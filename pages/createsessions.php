<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Add Bootstrap Icons CDN link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Custom Styles -->
    <link rel="stylesheet" href="../assets/css/createsessons.css"> <!-- Custom Styles -->


    
    <title>sessions</title>
</head>
<body>
   <?php
       include '../includes/navbar.php';
       include '../includes/sidebar.php';
       include '../api/chatbot/Chatbot.php';
   ?>

   <div class="container">
      <h1>Create a Session</h1>

      <form id="createSessionForm" action="../api/zoom/createSession.php" method="POST" class="form-container">

        <label for="category">Select a Category</label>
        <select id="category" name="category">
            <option value="">Select a category</option>
        </select><br>

        <label for="module">Select a Module</label>
        <select id="module" name="module">
            <option value="">Select a module</option>
        </select><br>

        <label for="topic">Topic :</label>
        <input type="text" id="topic" name="topic"><br>

        <label for="hosted">Hosted by :</label>
        <input type="text" id="hosted" name="hosted"><br>

        <label for="duration">Duration :</label>
        <input type="text" id="duration" name="duration"><br>

        <label for="date">Date :</label>
        <input type="date" id="date" name="date"><br>

        <label for="time">Time :</label>
        <input type="time" id="time" name="time"><br>

        <label for="meetingLink">Meeting Link:</label>
        <input type="url" id="meetingLink" name="meetingLink"><br>

        <button type="submit">Create</button>
      </form>
   </div>

   <script>
   document.addEventListener('DOMContentLoaded', function () {
       const categorySelect = document.getElementById('category');
       const moduleSelect = document.getElementById('module');

       // Load categories
       fetch('../api/auth/fetch_data.php?action=getCategories')
           .then(res => res.json())
           .then(data => {
               categorySelect.innerHTML = '<option value="">Select a category</option>';
               data.forEach(category => {
                   categorySelect.innerHTML += `<option value="${category.id}">${category.name}</option>`;
               });
           });

       // Load modules when category changes
       categorySelect.addEventListener('change', function () {
           const selectedCategoryId = this.value;
           moduleSelect.innerHTML = '<option value="">Loading modules...</option>';

           fetch(`../api/auth/fetch_data.php?action=getModules&categoryId=${selectedCategoryId}`)
               .then(res => res.json())
               .then(data => {
                   moduleSelect.innerHTML = '<option value="">Select a module</option>';
                   data.forEach(module => {
                       moduleSelect.innerHTML += `<option value="${module.id}">${module.name}</option>`;
                   });
               });
       });
   });
   </script>

   
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('createSessionForm');

    form.addEventListener('submit', function (event) {
        const category = document.getElementById('category').value.trim();
        const module = document.getElementById('module').value.trim();
        const topic = document.getElementById('topic').value.trim();
        const hosted = document.getElementById('hosted').value.trim();
        const duration = document.getElementById('duration').value.trim();
        const date = document.getElementById('date').value.trim();
        const time = document.getElementById('time').value.trim();
        const meetingLink = document.getElementById('meetingLink').value.trim();

        let errorMessages = [];

        if (!category) errorMessages.push("Please select a category.");
        if (!module) errorMessages.push("Please select a module.");
        if (!topic) errorMessages.push("Topic is required.");
        if (!hosted) errorMessages.push("Host name is required.");
        if (!duration || isNaN(duration)) errorMessages.push("Duration must be a number.");
        if (!date) errorMessages.push("Date is required.");
        if (!time) errorMessages.push("Time is required.");
        if (!meetingLink || !isValidURL(meetingLink)) errorMessages.push("Please enter a valid meeting link.");

        if (errorMessages.length > 0) {
            event.preventDefault(); // Prevent form submission
            alert(errorMessages.join("\n")); // Show all errors
        }
    });

    function isValidURL(str) {
        try {
            new URL(str);
            return true;
        } catch (_) {
            return false;
        }
    }
});
</script>


   <script src="../assets/js/script.js"></script>
   <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>