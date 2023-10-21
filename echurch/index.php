<!-- <?php
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

    // Insert data into the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "echurch";

    $conn = new mysqli($servername, $username, $password, $database);

    // Check for database connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO registrations (name, email, phone, address, dob, gender, city, state, country, nationality) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    // Check for SQL statement preparation errors
    if (!$stmt) {
        die("SQL statement preparation failed: " . $conn->error);
    }

    $stmt->bind_param("ssssssssss", $name, $email, $phone, $address, $dob, $gender, $city, $state, $country, $nationality);

    // Check for binding parameters errors
    if ($stmt->errno) {
        die("Binding parameters failed: " . $stmt->error);
    }

    $stmt->execute();

    // Check for execution errors
    if ($stmt->errno) {
        die("Execution of SQL statement failed: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();

    // Redirect to google.com after successful registration
    header("Location: https://www.google.com");
    exit; // Ensure that no further code is executed after the redirection
}
?>
