<?php
// filepath: c:\xampp\htdocs\prilist\register.php
$host = "localhost";
$user = "root";
$pass = "";
$db = "crime_data"; // Change to your DB name

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$showForm = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT); // password hash

    $sql = "INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $firstname, $lastname, $email, $password);

    if ($stmt->execute()) {
        echo "Registration successful! <a href='sign in.html'>Login here</a>";
        $showForm = false;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<?php if ($showForm): ?>
<form action="register.php" method="POST" class="flex flex-col gap-4 max-w-md mx-auto my-10 bg-gray-800 p-8 rounded-xl shadow-lg">
  <input type="text" name="firstname" placeholder="First Name" required class="px-4 py-2 rounded-lg bg-gray-700 text-white">
  <input type="text" name="lastname" placeholder="Last Name" required class="px-4 py-2 rounded-lg bg-gray-700 text-white">
  <input type="email" name="email" placeholder="Email" required class="px-4 py-2 rounded-lg bg-gray-700 text-white">
  <input type="password" name="password" placeholder="Password" required class="px-4 py-2 rounded-lg bg-gray-700 text-white">
  <button type="submit" class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold">Register</button>
</form>
<?php endif; ?>
