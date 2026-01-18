<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session only if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require 'db.php';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Check if passwords match
    if ($confirm_password && $password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Check if email or username already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
        $stmt->execute([$email, $username]);
        if ($stmt->fetch()) {
            $error = "Email or username already taken.";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user into database
            $stmt = $pdo->prepare("INSERT INTO users (fullname, email, username, password) VALUES (?, ?, ?, ?)");
            $stmt->execute([$fullname, $email, $username, $hashed_password]);

            // Set session variables and redirect
            $_SESSION['user_id'] = $pdo->lastInsertId();
            $_SESSION['username'] = $username;
            header("Location: profile.php");
            exit;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <title>GreenBridge - Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-900 via-black to-emerald-700 overflow-hidden">

  <!-- Register Card -->
  <div class="p-8 rounded-2xl shadow-xl bg-white/10 backdrop-blur-xl border border-green-400/20 w-full max-w-md animate-fadeIn hover:shadow-green-500/40 transition-all duration-500">
    
    <!-- Logo -->
    <div class="flex justify-center mb-5">
      <div class="h-12 w-12 flex items-center justify-center rounded-full bg-gradient-to-br from-green-500 to-emerald-700 shadow-md">
        <i class="fa-solid fa-leaf text-white"></i>
      </div>
    </div>

    <h1 class="text-3xl font-bold text-center text-gradient bg-clip-text text-transparent bg-gradient-to-r from-green-400 to-emerald-500 mb-1">
      Join GreenBridge
    </h1>
    <p class="text-center text-gray-300 text-sm mb-6">Empowering youth for a greener future 🌍</p>

    <!-- Error message -->
    <?php if (!empty($error)) echo "<div class='bg-red-500/80 text-white text-sm p-2 rounded mb-4 text-center animate-bounce'>$error</div>"; ?>

    <!-- Form -->
    <form method="POST" class="space-y-3">
      <div class="relative">
        <i class="fa-solid fa-user absolute left-3 top-3 text-green-300"></i>
        <input type="text" name="fullname" placeholder="Full Name" required
          class="w-full pl-9 pr-3 py-2 rounded-xl bg-white/10 text-white placeholder-gray-400 focus:ring-1 focus:ring-green-400 outline-none border border-white/20 text-sm">
      </div>

      <div class="relative">
        <i class="fa-solid fa-at absolute left-3 top-3 text-green-300"></i>
        <input type="text" name="username" placeholder="Username" required
          class="w-full pl-9 pr-3 py-2 rounded-xl bg-white/10 text-white placeholder-gray-400 focus:ring-1 focus:ring-green-400 outline-none border border-white/20 text-sm">
      </div>

      <div class="relative">
        <i class="fa-solid fa-envelope absolute left-3 top-3 text-green-300"></i>
        <input type="email" name="email" placeholder="Email Address" required
          class="w-full pl-9 pr-3 py-2 rounded-xl bg-white/10 text-white placeholder-gray-400 focus:ring-1 focus:ring-green-400 outline-none border border-white/20 text-sm">
      </div>

      <div class="relative">
        <i class="fa-solid fa-lock absolute left-3 top-3 text-green-300"></i>
        <input type="password" name="password" placeholder="Password" required
          class="w-full pl-9 pr-3 py-2 rounded-xl bg-white/10 text-white placeholder-gray-400 focus:ring-1 focus:ring-green-400 outline-none border border-white/20 text-sm">
      </div>

      <div class="relative">
        <i class="fa-solid fa-lock absolute left-3 top-3 text-green-300"></i>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required
          class="w-full pl-9 pr-3 py-2 rounded-xl bg-white/10 text-white placeholder-gray-400 focus:ring-1 focus:ring-green-400 outline-none border border-white/20 text-sm">
      </div>

      <button type="submit"
        class="w-full py-2.5 rounded-xl bg-gradient-to-r from-green-400 via-emerald-600 to-green-500 text-white font-semibold text-sm shadow-md hover:shadow-green-500/50 hover:scale-105 transform transition duration-300">
        Create Account
      </button>
    </form>

    <p class="text-gray-300 text-center text-sm mt-5">Already have an account?  
      <a href="login.php" class="text-green-300 font-medium hover:underline">Login</a>
    </p>
  </div>

</body>
</html>

<style>
@keyframes fadeIn { 
  from {opacity:0; transform:translateY(20px);} 
  to {opacity:1; transform:translateY(0);} 
}
.animate-fadeIn { animation: fadeIn 1s ease-in-out; }

.text-gradient {
  background-clip: text;
  -webkit-background-clip: text;
}
</style>
