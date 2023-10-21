<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $country = $_POST["country"];
    $nationality = $_POST["nationality"];

    // Handle the picture upload
    $picture_tmp = $_FILES["picture"]["tmp_name"];
    $picture_name = $_FILES["picture"]["name"];
    $picture_extension = pathinfo($picture_name, PATHINFO_EXTENSION);
    $picture_new_name = uniqid() . '.' . $picture_extension;
    $upload_directory = 'uploads/';

    if (move_uploaded_file($picture_tmp, $upload_directory . $picture_new_name)) {
        // Insert data into the database (you'll need to set up your database connection)
        $conn = new mysqli("localhost", "root", "", "echurch");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO registrations (name, email, phone, address, dob, gender, city, state, country, nationality, picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssss", $name, $email, $phone, $address, $dob, $gender, $city, $state, $country, $nationality, $picture_new_name);
        $stmt->execute();
        $stmt->close();
        $conn->close();

        // Send an email (using PHPMailer library)
        require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/SMTP.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'mail.liberationprayerministries.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@liberationprayerministries.com';
        $mail->Password = 'your_email_password';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('info@liberationprayerministries.com', 'Registration Notification');
        $mail->addAddress($email, $name);

        $mail->isHTML(true);
        $mail->Subject = 'eChurch Registration Confirmation';
        $mail->Body = 'Thank you for registering with eChurch.';

        if ($mail->send()) {
            echo 'Registration successful. Confirmation email sent.';
        } else {
            echo 'Registration successful, but email could not be sent.';
        }
    } else {
        echo 'Failed to upload the picture.';
    }
}
?>
