<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CrimeDataAI Navbar</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #0f172a;
    }
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #1e293b;
      padding: 12px 40px;
      position: sticky;
      top: 0;
      z-index: 1000;
    }
    .navbar .logo {
      color: #3b82f6;
      font-size: 24px;
      font-weight: bold;
      text-decoration: none;
    }
    .navbar ul {
      list-style: none;
      display: flex;
      margin: 0;
      padding: 0;
      gap: 25px;
    }
    .navbar ul li a {
      color: #3b82f6;
      text-decoration: none;
      font-size: 18px;
      transition: 0.3s;
    }
    .navbar ul li a.active {
      color: #fff;
      font-weight: bold;
    }
    .auth-buttons {
      display: flex;
      gap: 10px;
    }
    .auth-buttons a {
      padding: 6px 14px;
      border-radius: 6px;
      text-decoration: none;
      font-size: 14px;
      font-weight: bold;
      transition: 0.3s;
      background-color: #374151;
      color: white;
    }
    .login-btn:hover {
      background-color: #4b5563;
    }
    .register-btn {
      background-color: #2563eb;
      color: white;
    }
    .register-btn:hover {
      background-color: #1d4ed8;
    }
    .user-info {
      display: flex;
      align-items: center;
      gap: 10px;
      color: #fff;
      font-size: 16px;
    }
    .user-icon {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background: #2563eb;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      color: #fff;
    }
    .logout-btn {
      background: #ef4444;
      color: #fff;
      padding: 6px 12px;
      border-radius: 6px;
      text-decoration: none;
      font-size: 14px;
      font-weight: bold;
      margin-left: 10px;
      transition: 0.3s;
    }
    .logout-btn:hover {
      background: #b91c1c;
    }
  </style>
</head>
<body>
  <nav class="navbar">
    <a href="index.html" class="logo">CrimeDataAI</a>
    <ul>
      <li><a href="home.html">Home</a></li>
      <li><a href="data.html">Data</a></li>
      <li><a href="dashboard.html">Dashboard</a></li>
      <li><a href="reports.html">Reports</a></li>
      <li><a href="AI Insights.html">AI Insights</a></li>
      <li><a href="about.html">About</a></li>
    </ul>
    <?php if (isset($_SESSION['email'])): ?>
      <div class="user-info">
        <span class="user-icon">
          <?php echo strtoupper(substr($_SESSION['firstname'],0,1)); ?>
        </span>
        <span><?php echo htmlspecialchars($_SESSION['firstname'] . ' ' . $_SESSION['lastname']); ?></span>
        <span>(<?php echo htmlspecialchars($_SESSION['email']); ?>)</span>
        <a href="logout.php" class="logout-btn">Logout</a>
      </div>
    <?php else: ?>
      <div class="auth-buttons">
        <a href="sign in.html" class="login-btn">Login</a>
        <a href="sign up.html" class="register-btn">Register</a>
      </div>
    <?php endif; ?>
  </nav>
  <script>
    // Highlight current page link in navbar
    function highlightCurrentNav() {
      var path = window.location.pathname.split('/').pop();
      var links = document.querySelectorAll('.navbar ul li a');
      links.forEach(function(link) {
        if (link.getAttribute('href') === path) {
          link.classList.add('active');
        } else {
          link.classList.remove('active');
        }
      });
    }
    highlightCurrentNav();
  </script>
</body>
</html>
