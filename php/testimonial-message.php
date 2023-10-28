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

$fullName = $_POST['fullName'];
$email = $_POST['email'];
$phoneNo = $_POST['phoneNo'];
$prayerRequest = $_POST['prayerRequest'];

// SQL query to insert data into the "message" table
$sql = "INSERT INTO prayer (fullName, email, phoneNo, prayerRequest)
        VALUES ('$fullName', '$email', '$phoneNo', '$prayerRequest')";

if ($conn->query($sql) === TRUE) {
    $to = "liberationprayerministries1@gmail.com";
    $subject = "Prayer Request";
    $message = "Prayer Request\n\n";
    $message .= "Name: $fullName\n";
    $message .= "Email: $email\n";
    $message .= "Phone Number: $phoneNo\n";
    $message .= "Prayer Request: $prayerRequest\n";

    $headers = "From: info@liberationprayerministries.com\r\n";
    $headers .= "Reply-To: liberationprayerministries1@gmail.com\r\n";
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
