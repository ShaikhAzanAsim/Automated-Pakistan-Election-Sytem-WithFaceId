<?php
 include 'connection.php';


if(isset($_GET['action']) && !empty($_GET['action'])) {
    $action = $_GET['action'];

    // Depending on the action, perform different tasks
    switch($action) {
        case 'get_provinces':
            getProvinces($conn);
            break;
        case 'get_cities':
            if(isset($_GET['province']) && !empty($_GET['province'])) {
                $provinceId = $_GET['province'];
                getCities($conn,$provinceId);
            }
            break;
        case 'get_towns':
            if(isset($_GET['city']) && !empty($_GET['city'])) {
                $cityId = $_GET['city'];
                getTowns($conn,$cityId);
            }
            break;
        default:
            echo 'Invalid action';
    }
}

// Function to fetch provinces from the database
function getProvinces($conn) {
    $provinces = "<option disabled selected>Choose Province</option>";
    $sql = "SELECT distinct province from seat order by province ASC;";
    $result=mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)) 
    {
        
        $provinces .= '<option value="'.$row["province"].'">'.$row["province"].'</option>';

    }
    echo $provinces;
}

// Function to fetch cities based on province from the database
function getCities($conn,$province) {
    $cities = "<option disabled selected>Choose City</option>";
    $sql = "SELECT distinct city from seat where province = '$province' order by city ASC;";
    $result=mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) 
    {
        
        $cities .= '<option value="'.$row["city"].'">'.$row["city"].'</option>';

    }
    echo $cities;
}

// Function to fetch towns based on city from the database
function getTowns($conn,$cities) {
    $towns = "<option disabled selected>Choose Town</option>";
    $sql = "SELECT distinct town from seat where city = '$cities' order by town ASC;";
    $result=mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) 
    {
        
        $towns .= '<option value="'.$row["town"].'">'.$row["town"].'</option>';

    }
    echo $towns;
}

