<?php
$servername = "localhost";
$port = 3306;
$username = "liberati_user_admin";
$password = "yj]NJ-d;JtTC";
$database = "liberati_echurch_form_page";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['fullName'];
$email = $_POST['email'];
$phone = $_POST['phoneNo'];
$prayerRequest = $_POST['prayerRequest'];

// SQL query to insert data into the "message" table
$sql = "INSERT INTO prayer (fullName, email, phoneNo, prayerRequest)
        VALUES ('$name', '$email', '$phone', '$prayerRequest')";

if ($conn->query($sql) === TRUE) {
    $to = "iamabdullahitijani@gmail.com, info@liberationprayerministries.com, liberationprayerministries1@gmail.com";
    $subject = "Prayer Request";
    $message = "Prayer Request\n\n";
    $message .= "Name: $fullName\n";
    $message .= "Email: $email\n";
    $message .= "Phone Number: $phoneNo\n";
    $message .= "Prayer Request: $prayerRequest\n";

    $headers = "From: info@liberationprayerministries.com\r\n";
    $headers .= "Reply-To: info@liberationprayerministries.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send the email
    mail($to, $subject, $message, $headers);

    // Redirect to the current page
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
