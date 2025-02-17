<?php
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="login_style.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="headerimage.png" alt="Logo">
        </div> 
        
    </header>
    <div id="bg-video-container">
        <video autoplay muted loop id="bg-video">
         <source src="4498111-hd_1280_720_30fps.mp4" type="video/mp4">
         Your browser does not support the video tag.
        </video>
    </div>
    
 <div class="container">
    <h2>Registration Form</h2>
    <form id="registration_form" action="registration.php" method="POST">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required><br><br>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required><br><br>

        <label for="cnic">CNIC:</label>
        <input type="text" id="cnic" name="cnic" pattern="[0-9]{5}-[0-9]{7}-[0-9]{1}" title="Please enter CNIC in the format 12345-1234567-1" required><br><br>

        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="address">Address:</label>
        <input type="address" id="address" name="address" required><br><br>

        
        <label for="province">Province:</label>
            <select id="province" class="select-box" name ="province">
                <option disabled selected>Choose</option>
            </select>
            <br><br>
        
        <label for="city">City:</label>
            <select id="city" class="select-box" name ="city">
            <option disabled selected>Choose</option>
            </select>
            <br><br>
        
        <label for="town">Town:</label>
            <select id="town" class="select-box" name ="town">
            <option disabled selected>Choose</option>
            </select>
            <br><br>

        

        <button type="submit">Register</button>
    </form>
    <p>If You Can Not Find Your Appropriate Address, Please Let Us Know <a href='complaint.html'>Feedback</a></p>
    <p>Please Ask Our Volunteer To Get Your Face Registered.</p>
 </div>  

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
    

$(document).ready(function() {
    // Fetch province data
    $.ajax({
        url: 'fetch_data.php', // Your server-side script URL
        type: 'GET',
        data: { action: 'get_provinces' },
        success: function(data) {
            $('#province').html(data);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });

    // Function to fetch city data based on selected province
    function fetchCities(province) {
        $.ajax({
            url: 'fetch_data.php',
            type: 'GET',
            data: { action: 'get_cities', province: province},
            success: function(data) {
                $('#city').html(data);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    // Function to fetch town data based on selected city
    function fetchTowns(city) {
        $.ajax({
            url: 'fetch_data.php',
            type: 'GET',
            data: { action: 'get_towns', city: city },
            success: function(data) {
                $('#town').html(data);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    // Event listener for province selection
    $(document).on('change','#province', function() {
        var province = $(this).val();
        fetchCities(province);
    });


    $(document).on('change','#city', function() {
        var city = $(this).val();
        fetchTowns(city);
    });
});


</script>



</body>
</html>
