<?php
session_start();
require 'db.php';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
    $stmt->execute([$login, $login]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: profile.php");
        exit;
    } else {
        $error = "Invalid email/username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <title>GreenBridge - Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-black via-green-900 to-emerald-800 overflow-hidden">

  <!-- Background subtle grid -->
  <div class="absolute inset-0 -z-10">
    <div class="absolute inset-0 bg-gradient-to-br from-emerald-900 via-black to-green-900 opacity-90"></div>
    <div class="absolute inset-0 grid grid-cols-12 gap-2 opacity-10">
      <div class="col-span-1 border-r border-green-500/20"></div>
      <div class="col-span-1 border-r border-green-500/20"></div>
      <div class="col-span-1 border-r border-green-500/20"></div>
    </div>
  </div>

  <!-- Card -->
  <div class="p-8 rounded-2xl shadow-xl bg-white/10 backdrop-blur-xl border border-green-400/20 w-full max-w-md animate-fadeIn hover:shadow-green-500/40 transition-all duration-500">
    
    <!-- Logo -->
    <div class="flex justify-center mb-5">
      <div class="h-12 w-12 flex items-center justify-center rounded-full bg-gradient-to-br from-green-500 to-emerald-700 shadow-md">
        <i class="fa-solid fa-leaf text-white"></i>
      </div>
    </div>

    <h1 class="text-3xl font-bold text-center text-gradient bg-clip-text text-transparent bg-gradient-to-r from-green-400 to-emerald-500 mb-1">
      Welcome Back
    </h1>
    <p class="text-center text-gray-300 text-sm mb-6">Login to your GreenBridge account 🌍</p>

    <!-- Error message -->
    <?php if (!empty($error)) echo "<div class='bg-red-500/80 text-white text-sm p-2 rounded mb-4 text-center animate-bounce'>$error</div>"; ?>

    <!-- Form -->
    <form method="POST" class="space-y-3">
      <div class="relative">
        <i class="fa-solid fa-user absolute left-3 top-3 text-green-300"></i>
        <input type="text" name="login" placeholder="Email or Username" required
          class="w-full pl-9 pr-3 py-2 rounded-xl bg-white/10 text-white placeholder-gray-400 focus:ring-1 focus:ring-green-400 outline-none border border-white/20 text-sm">
      </div>

      <div class="relative">
        <i class="fa-solid fa-lock absolute left-3 top-3 text-green-300"></i>
        <input type="password" name="password" placeholder="Password" required
          class="w-full pl-9 pr-3 py-2 rounded-xl bg-white/10 text-white placeholder-gray-400 focus:ring-1 focus:ring-green-400 outline-none border border-white/20 text-sm">
      </div>

      <button type="submit"
        class="w-full py-2.5 rounded-xl bg-gradient-to-r from-green-400 via-emerald-600 to-green-500 text-white font-semibold text-sm shadow-md hover:shadow-green-500/50 hover:scale-105 transform transition duration-300">
        Login
      </button>
    </form>

    <p class="text-gray-300 text-center text-sm mt-5">Don’t have an account?  
      <a href="register.php" class="text-green-300 font-medium hover:underline">Register</a>
    </p>
  </div>

  <!-- Soft glow orbs -->
  <div class="absolute top-10 left-10 w-32 h-32 bg-green-500 rounded-full blur-3xl opacity-20"></div>
  <div class="absolute bottom-10 right-10 w-44 h-44 bg-emerald-600 rounded-full blur-3xl opacity-15"></div>

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
