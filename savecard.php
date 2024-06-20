<?php
// Connect to your database
$conn = mysqli_connect("localhost", "root", "", "course_db");

// Check connection
if (!$conn) {
    die("Connection failed: " + mysqli_connect_error());
}

if(isset($_POST['submit'])){

    $numcard = $_POST['card-number-input'];
    $cardholder = $_POST['card-holder-input'];
    $cvv = $_POST['cvv-input'];
    $Exmonth = $_POST['month-input'];
    $Exyear = $_POST['year-input'];
    
    // Insert the values into the cards table
    $sql = "INSERT INTO cards(numcard, cardholder, cvv, Exmonth, Exyear) VALUES ('$numcard', '$cardholder', '$cvv', '$Exmonth', '$Exyear')";
    
    if (mysqli_query($conn, $sql)) {
        echo "Card saved successfully!";
        header("Location: payment.html");
    } else {
        echo "Error: ". mysqli_error($conn);
        header("Location: mytrack.html");
    }
    
    // Close the database connection
}else{


    echo("submit not work");
}

mysqli_close($conn);
?>