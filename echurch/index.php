<!-- <?php

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


    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "echurch";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO registrations (name, email, phone, address, dob, gender, city, state, country, nationality) VALUES ('$name', '$email', '$phone', '$address', '$dob', '$gender', '$city', '$state', '$country', '$nationality')";


    $stmt = $conn->prepare($sql);


    if (!$stmt) {
        die("SQL statement preparation failed: " . $conn->error);
    }

    $stmt->bind_param("ssssssssss", $name, $email, $phone, $address, $dob, $gender, $city, $state, $country, $nationality);

    if ($stmt->errno) {
        die("Binding parameters failed: " . $stmt->error);
    }

    $stmt->execute();

    if ($stmt->errno) {
        die("Execution of SQL statement failed: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();


    header("Location: https://www.google.com");
    exit; 
}
?>
