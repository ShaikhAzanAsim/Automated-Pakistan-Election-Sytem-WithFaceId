<?php
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SELCTION PAKISTAN</title>
    <style>
        header {
            background-color: rgb(52, 194, 212);
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav li {
            display: inline-block;
            margin-right: 15px;
        }

        nav a 
        {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }

        body
        {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
            background-color: #f4f4f4;
            
        }
        .admin-container 
        {
            display: flex;
            flex-direction: column;
        }

        .column-buttons, .row-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 10px; /* Adjust as needed */
        }

        .admin-button {
            /* Your button styles here */
            padding: 5px 10px;
            margin-right: 5px; /* Adjust the right margin to decrease the gap */
        }

        .action-button {
            /* Your button styles here */
            padding: 5px 10px;
            background-color: rgb(52, 194, 212);
            color: #fff; /* Example text color */
            margin-right: 5px; /* Adjust the right margin to decrease the gap */
        }
        
  /* Style for the dropdown container */
  .dropdown {
    position: relative;
    display: inline-block;
}

/* Style for the dropdown button */
.dropdown-button {
    background-color: rgb(52, 194, 212); /* Green */
    color: white;
    padding: 10px 200px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    z-index: 1;
    width: 200px;
    transition: background-color 0.3s ease;
    border: 1px solid #cac3c3; /* Set the color to your preferred dark color */
}

/* Change color of dropdown button on hover and active state */
.dropdown-button:hover,
.dropdown.active .dropdown-button {
    background-color: rgb(52, 194, 212); /* Dark Green */
}

/* Style for the dropdown content (hidden by default) */
.dropdown-content {
    font-size: 40px;
    display: none;
    position: absolute;
    background-color: white;
    min-width: 200%;
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    z-index: 2;
    opacity: 0;
    transition: opacity 0.3s ease, background-color 0.3s ease;
    border: 1px solid #333; /* Set the color to your preferred dark color */
    left: 120%; /* Position to the right of the button */
    top: 0; /* Align with the top of the button */
    margin-top: -1px; /* Adjust for border thickness */
}


#insertRole {
    width: 300px; /* Adjust the width as needed */
    padding: 10px; /* Adjust the padding as needed */
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
}
.select-box input {
    width: 300px; /* Adjust the width as needed */
    padding: 10px; /* Adjust the padding as needed */
    /* Add any other styling properties as needed */
}
/* Style for the dropdown items */
.dropdown-content a {
    
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Change color of dropdown items on hover */
.dropdown-content a:hover {
    background-color: #ddd;
}

/* Show the dropdown content when the dropdown button is clicked */
.dropdown.active .dropdown-content {
    display: block;
    opacity: 1;
}

button {
            border-radius: 10px; /* Adjust the value to control the roundness of corners */
            cursor: pointer;
            padding: 10px 12px; /* Adjust padding for better appearance */
            /* Add other styles as needed */
        }

        button:hover {
            background-color: #ddd; /* Change to your preferred hover background color */
        }
.submit-button {
            background-color: rgb(52, 194, 212); /* Green */
 /* Green */
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
        }
        .select-box label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .select-box select, .select-box input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: none;
            border-bottom: 2px solid #4CAF50; /* Add a green border bottom */
            border-radius: 0;
            box-sizing: border-box;
            outline: none; /* Remove the default input focus border */
        }
        h1 {
            font-size: 40px; /* Adjust the font size for h1 as needed */
        }

        h2 {
            font-size: 18px; /* Adjust the font size for h2 as needed */
        }
        .form-container {
            text-align: center;
        }

        .input-box {
            margin: 10px;
            display: block;
        }
        .back-btn {
         background-color: rgb(52, 194, 212); /* Green */
 /* Green */
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .back-btn {
      margin-right: -800px; /* Push the button to the far left */
    }
    .nav-buttons {
      display: flex;
    }

    .nav-buttons button {
      margin-right: 10px; /* Add some space between buttons */
      background-color: #333;
      color: #fff;
      border: none;
      padding: 10px;
      cursor: pointer;
    }

   .dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown button */
.dropdown-button {
  background-color: rgb(52, 194, 212); /* Green */
  color: white;
  padding: 10px;
  font-size: 16px;
  border: none;
  cursor: pointer;
  width: 500px;
  height: 70px;
  text-align: center;
  font-size: 30px;
}

/* Dropdown content */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: rgb(52, 194, 212); /* Green */
/* Dark Green */
  min-width: 200px;
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  z-index: 1;
  width: 500px;
  text-align: center;

}

/* Show dropdown content on hover */
.dropdown:hover .dropdown-content {
  display: block;
}

/* Dropdown input boxes and labels */
.input-container {
  padding: 10px;
  
}

.input-box {
  margin-bottom: 10px;
}

.input-box label {
  display: inline-block;
  width: 150px;
}

.input-box input, 
.input-box select {
  width: calc(100% - 150px);
  padding: 5px;
  margin-left: 10px;
  outline: auto;
}

/* Submit button */
.submit-button {
  background-color: rgb(52, 194, 212); /* Green */
  color: white;
  padding: 10px 20px;
  font-size: 16px;
  border: none;
  cursor: pointer;
  margin-top: 10px;
}

/* Button hover effect */
.submit-button:hover {
    background-color: rgb(52, 194, 212); /* Green */

  
}

label{
    font-size: 20px;
}            
</style>

<body>
    
    <!---------------------- this is where the page starts   ---------------------------->
    <header>
        <h1>Election Pakistan</h1>
        <h2>User Database</h2>
        
        <nav>
            <ul>
                <a href="admin.html"><button>BACK</button></a>
            </ul>
        </nav>
    </header>

    <br>
   <!--Insert-->

<div class="dropdown" id="insertDropdown">
    <button class="dropdown-button" onclick="toggleInsertDropdown()">Insert</button>
    <div class="dropdown-content">
        <!-- Enter party name input -->
        <form action="insert_user.php" method="post">
            <div class="input-container">
                    <div class="input-box">
                        <label for="fname">First Name:</label>
                        <input type="text" id="i_fname" name="fname">
                    </div>
                    <div class="input-box">
                        <label for="lname">Last Name:</label>
                        <input type="text" id="i_lname" name="lname">
                    </div>
                    <div class="input-box">
                        <label for="cnic">Cnic:</label>
                        <input type="text" id="i_cnic" name="cnic">
                    </div>
                    <div class="input-box">
                        <label for="email">Email:</label>
                        <input type="text" id="i_email" name="email">
                    </div>
                    <div class="input-box">
                        <label for="pass">Password:</label>
                        <input type="text" id="i_pass" name="password">
                    </div>
                    <div class="input-box">
                        <label for="gender">Gender:</label>
                        <input type="text" id="i_gender" name="gender">
                    </div>
                    <div class="input-box">
                        <label for="addr">Address:</label>
                        <input type="text" id="i_address" name="address">
                    </div>
                    <div class="input-box">
                        <label for="town">Town:</label>
                        <select name="town">
                            <option disabled selected>Choose</option>
                            <?php
                            $sql = "select distinct(town) from seat order by town asc;";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) { ?>

                                <option value=<?php echo $row["town"]; ?>> <?php echo $row["town"]; ?></option>

                            <?php } ?>
                        </select>
                        </div>
                        <div class="input-box">
                        <label for="city">City:</label>
                        <select name="city">
                            <option disabled selected>Choose</option>
                            <?php
                            $sql = "select distinct(city) from seat order by city asc;";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) { ?>

                                <option value=<?php echo $row["city"]; ?>> <?php echo $row["city"]; ?></option>

                            <?php } ?>
                        </select>
                        </div>
                        <div class="input-box">
                        <label for="province">Province:</label>
                        <select name="province">
                            <option disabled selected>Choose</option>
                            <?php
                            $sql = "select distinct(province) from seat order by province asc;";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) { ?>

                                <option value=<?php echo $row["province"]; ?>> <?php echo $row["province"]; ?></option>

                            <?php } ?>
                        </select>

                </div>
                <button type="submit" class="submit-button">Insert</button>
            </div>
        </form>
    </div>
</div>
<br>
<br>


<!--Update-->
<div class="dropdown" id="updateDropdown">
    <button class="dropdown-button" onclick="toggleUpdateDropdown()">Update</button>
    <div class="dropdown-content">
        <!-- Enter player name input -->
        <div class="input-container">
            <div class="input-box">
                <label for="cnic">CNIC:</label>
                <select name="user" id="userSelect">
                    <option disabled selected>Choose</option>
                    <?php 
                    $sql = "select CNIC,Fname,Lname,Email,Password,Gender,Vote1,Vote2,Seat1,Seat2,address,town,city,province from user;";
                    $result=mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)) 
                    { ?>
                    <option value=<?php echo $row["CNIC"]; ?>
                        data-Fname="<?php echo $row['Fname']; ?>"
                        data-Lname="<?php echo $row['Lname']; ?>"
                        data-Email="<?php echo $row['Email']; ?>"
                        data-Password="<?php echo $row['Password']; ?>"
                        data-Gender="<?php echo $row['Gender']; ?>"
                        data-V1="<?php echo $row['Vote1']; ?>"
                        data-V2="<?php echo $row['Vote2']; ?>"
                        data-S1="<?php echo $row['Seat1']; ?>"
                        data-S2="<?php echo $row['Seat2']; ?>"
                        data-address="<?php echo $row['address']; ?>"
                        data-town="<?php echo $row['town']; ?>"
                        data-city="<?php echo $row['city']; ?>"
                        data-province="<?php echo $row['province']; ?>"
                        ><?php echo $row["CNIC"];?></option>
                    <?php } ?>
                </select> 
                <button type="button" class="submit-button" onclick="fetchUserInfo()">Search</button>
            </div>
            <form method="post" action="update_user.php">
                <input type="hidden" id="CNIC" name="cnic">
                <div class="input-box">
                    <label for="fname">First Name:</label>
                    <input type="text" id="Fname" name="fname">
                </div>
                <div class="input-box">
                    <label for="lanme">Last Name:</label>
                    <input type="text" id="Lname" name="lname">
                </div>
                <div class="input-box">
                    <label for="email">Email:</label>
                    <input type="text" id="Email" name="email">
                </div>
                <div class="input-box">
                    <label for="password">Password:</label>
                    <input type="text" id="Password" name="password">
                </div>
                <div class="input-box">
                    <label for="gender">Gender:</label>
                    <input type="text" id="Gender" name="gender">
                </div>
                <div class="input-box">
                    <label for="v1">Vote (PA):</label>
                    <input type="text" id="V1" name="v1">
                </div>
                <div class="input-box">
                    <label for="v2">Vote (NA):</label>
                    <input type="text" id="V2" name="v2">
                </div>
                
                <div class="input-box">
                    <label for="s1">Seat (PA):</label>
                    <input type="text" id="S1" name="s1">
                </div>
                <div class="input-box">
                    <label for="s2">Seat (NA):</label>
                    <input type="text" id="S2" name="s2">
                </div>
                <div class="input-box">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address">
                </div>
                <div class="input-box">
                    <label for="town">Town:</label>
                    <input type="text" id="town" name="town">
                </div> 
                <div class="input-box">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city">
                </div> 
                <div class="input-box">
                    <label for="province">Province:</label>
                    <input type="text" id="province" name="province">
                </div> 
                <button type="submit" class="submit-button">Update</button>  
            </form>  
        </div>
    </div>
</div>



<br>
<br>

<div class="dropdown" id="deleteDropdown">

    <button class="dropdown-button" onclick="toggleDeleteDropdown()">delete</button>
    <div class="dropdown-content">
        <div class="input-container">
            <form method = "post" action="delete_user.php">            
            <div class="input-box">
                    <label for="cnic">CNIC:</label>
                    <select name="user_id">
                        <option disabled selected>Choose</option>
                        <?php
                        $sql = "select CNIC from user order by CNIC asc;";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) { ?>

                            <option value=<?php echo $row["CNIC"]; ?>> <?php echo $row["CNIC"]; ?></option>

                        <?php } ?>
                    </select>
                </div>
        </div>
        <button type="submit" class="submit-button">Delete</button>  
     </form>  
    </div>
</div>



<script>

function toggleInsertDropdown() {
    var dropdown = document.getElementById("insertDropdown");
    dropdown.classList.toggle("active");
    
    // Remove 'active' class from the other dropdowns
    var otherDropdowns = ["updateDropdown", "deleteDropdown"];
    otherDropdowns.forEach(id => {
        var otherDropdown = document.getElementById(id);
        otherDropdown.classList.remove("active");
    });
}


function toggleUpdateDropdown() {
    var dropdown = document.getElementById("updateDropdown");
    dropdown.classList.toggle("active");
    var dropdown1 = document.getElementById("deleteDropdown");
    dropdown1.classList.remove("active");
    var dropdown2 = document.getElementById("insertDropdown");
    dropdown2.classList.remove("active");
}

function toggleDeleteDropdown() {
    var dropdown = document.getElementById("deleteDropdown");
    dropdown.classList.toggle("active");
    var dropdown1 = document.getElementById("updateDropdown");
    dropdown1.classList.remove("active");
    var dropdown2 = document.getElementById("insertDropdown");
    dropdown2.classList.remove("active");
}

function fetchUserInfo() {
    var selectElement = document.getElementById("userSelect");
    var selectedOption = selectElement.options[selectElement.selectedIndex];

    var cnic = selectedOption.value;
    var fname = selectedOption.getAttribute('data-Fname');
    var lname = selectedOption.getAttribute('data-Lname');
    var email = selectedOption.getAttribute('data-Email');
    var pass = selectedOption.getAttribute('data-Password');
    var gender = selectedOption.getAttribute('data-Gender');
    var v1 = selectedOption.getAttribute('data-V1');
    var v2 = selectedOption.getAttribute('data-V2');
    var s1 = selectedOption.getAttribute('data-S1');
    var s2 = selectedOption.getAttribute('data-S2');
    var add = selectedOption.getAttribute('data-address');
    var town = selectedOption.getAttribute('data-town');
    var city = selectedOption.getAttribute('data-city');
    var province = selectedOption.getAttribute('data-province');


    document.getElementById('CNIC').value = cnic;
    document.getElementById('Fname').value = fname;
    document.getElementById('Lname').value = lname;
    document.getElementById('Email').value = email;
    document.getElementById('Password').value = pass;
    document.getElementById('Gender').value = gender;
    document.getElementById('V1').value = v1;
    document.getElementById('V2').value = v2;
    document.getElementById('S1').value = s1;
    document.getElementById('S2').value = s2;
    document.getElementById('address').value = add;
    document.getElementById('town').value = town;
    document.getElementById('city').value = city;
    document.getElementById('province').value = province;


}


    // Function to redirect to admin.html
    function redirectToAdminPage() {
        window.location.href = "admin.html";
    }
</script>



        
</body>
</head>
</html>