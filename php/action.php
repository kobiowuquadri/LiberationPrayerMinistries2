<?php
$servername = "localhost";
$port = 3306;
$username = "liberati_user_admin";
$password = "yj]NJ-d;JtTC";
$database = "liberati_echurch_form_page";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);}
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$city = $_POST['city'];
$state = $_POST['state'];
$country = $_POST['country'];
$sql = "INSERT INTO registrations (name, email, phone, address, dob, gender, city, state, country)
        VALUES ('$name', '$email', '$phone', '$address', '$dob', '$gender', '$city', '$state', '$country')";
if ($conn->query($sql) === TRUE) {
    $to = "liberationprayerministries1@gmail.com";
    $subject = "Registration Success";
    $message = "Submitted Details\n\n";
    $message .= "Name: $name\n";
    $message .= "Email: $email\n";
    $message .= "Phone Number: $phone\n";
    $message .= "Address: $address\n";
    $message .= "Date of Birth: $dob\n";
    $message .= "Gender: $gender\n";
    $message .= "City: $city\n";
    $message .= "State: $state\n";
    $message .= "Country: $country\n";
    $headers = "From: info@liberationprayerministries.com\r\n";
    $headers .= "Reply-To: liberationprayerministries1@gmail.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    mail($to, $subject, $message, $headers);
    header('Location: https://liberationprayerministries.com/');
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
