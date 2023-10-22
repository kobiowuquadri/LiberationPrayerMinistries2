<?php
$servername = "localhost";
$port = 3306;
$username = "liberati_user_admin";
$password = "yj]NJ-d;JtTC";
$database = "liberati_echurch_form_page";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);}
$name = $_POST['fullName'];
$email = $_POST['email'];
$phone = $_POST['phoneNo'];

$sql = "INSERT INTO page-message (fullName, email, phoneNo)
        VALUES ('$fullName', '$email', '$phoneNo')";
if ($conn->query($sql) === TRUE) {
    $to = "developertest@liberationprayerministries.com, iamabdullahitijani@gmail.com,info@liberationprayerministries.com,liberationprayerministries1@gmail.com";
    $subject = "Registration Success";
    $message = "Submitted Details\n\n";
    $message .= "Name: $fullName\n";
    $message .= "Email: $email\n";
    $message .= "Phone Number: $phoneNo\n";
    $headers = "From: developertest@liberationprayerministries.com\r\n";
    $headers .= "Reply-To: developertest@liberationprayerministries.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    mail($to, $subject, $message, $headers);
    header('Location: #');
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
