<?php
include('db_connect.php');

$error = "";
$success = "";
$loggedIn = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT firstname, lastname, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($firstname, $lastname, $hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $success = "Welcome, <span class='font-bold text-blue-400'>{$firstname} {$lastname}</span>! You have logged in successfully.";
            $loggedIn = true;
            // Set session if needed
            session_start();
            $_SESSION['user'] = $firstname . " " . $lastname;
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "Email not found.";
    }
    $stmt->close();
}

// Handle sign out
if (isset($_GET['logout'])) {
    session_start();
    session_destroy();
    header("Location: login.php");
    exit;
}

// Check session for persistent login
session_start();
if (isset($_SESSION['user'])) {
    $loggedIn = true;
    $success = "Welcome, <span class='font-bold text-blue-400'>{$_SESSION['user']}</span>! You have logged in successfully.";
}
?>

<?php if (!$loggedIn): ?>
<form action="login.php" method="POST" class="flex flex-col gap-4 max-w-md mx-auto my-10 bg-gray-800 p-8 rounded-xl shadow-lg">
  <input type="email" name="email" placeholder="Email" required class="px-4 py-2 rounded-lg bg-gray-700 text-white">
  <input type="password" name="password" placeholder="Password" required class="px-4 py-2 rounded-lg bg-gray-700 text-white">
  <button type="submit" class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold">Login</button>
  <?php if ($error): ?>
    <div class="text-red-400 font-bold mt-2"><?php echo $error; ?></div>
  <?php endif; ?>
</form>
<?php endif; ?>

<?php if ($loggedIn): ?>
  <div class="flex flex-col items-center justify-center max-w-md mx-auto my-10 bg-gray-800 p-8 rounded-xl shadow-lg">
    <div class="text-green-400 font-bold text-xl mb-4"><?php echo $success; ?></div>
    <a href="reports.html" class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold mb-4">Go to Dashboard</a>
    <!-- User Icon with dropdown -->
    <div class="relative">
      <button id="userIconBtn" class="bg-blue-600 rounded-full p-3 text-white text-2xl flex items-center focus:outline-none" onclick="toggleDropdown()">
        <i class='bx bxs-user-circle'></i>
      </button>
      <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-40 bg-gray-700 rounded-lg shadow-lg z-10">
        <a href="?logout=1" class="block px-4 py-2 text-red-400 hover:bg-gray-800 hover:text-red-500 font-semibold text-center">Sign Out</a>
      </div>
    </div>
  </div>
  <script>
    function toggleDropdown() {
      var menu = document.getElementById('dropdownMenu');
      menu.classList.toggle('hidden');
    }
    // Optional: Hide dropdown when clicking outside
    document.addEventListener('click', function(e) {
      var btn = document.getElementById('userIconBtn');
      var menu = document.getElementById('dropdownMenu');
      if (!btn.contains(e.target) && !menu.contains(e.target)) {
        menu.classList.add('hidden');
      }
    });
  </script>
<?php endif; ?>
<?php
session_start();
$isLoggedIn = isset($_SESSION['user']);
?>
<nav class="flex justify-end items-center gap-6 px-8 py-4 bg-gray-900">
  <?php if (!$isLoggedIn): ?>
    <a href="login.php" class="text-white font-semibold hover:text-blue-400">Login</a>
    <a href="register.php" class="text-white font-semibold hover:text-blue-400">Register</a>
  <?php else: ?>
    <div class="relative">
      <button id="userIconBtn" class="rounded-full focus:outline-none" onclick="toggleDropdown()">
        <img src="user-logo.png" alt="User" class="w-10 h-10 rounded-full border-2 border-blue-400" />
      </button>
      <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-40 bg-gray-700 rounded-lg shadow-lg z-10">
        <a href="login.php?logout=1" class="block px-4 py-2 text-red-400 hover:bg-gray-800 hover:text-red-500 font-semibold text-center">Sign Out</a>
      </div>
    </div>
    <script>
      function toggleDropdown() {
        var menu = document.getElementById('dropdownMenu');
        menu.classList.toggle('hidden');
      }
      document.addEventListener('click', function(e) {
        var btn = document.getElementById('userIconBtn');
        var menu = document.getElementById('dropdownMenu');
        if (!btn.contains(e.target) && !menu.contains(e.target)) {
          menu.classList.add('hidden');
        }
      });
    </script>
  <?php endif; ?>
</nav>
