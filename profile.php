<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() == PHP_SESSION_NONE) session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Handle profile update
if (isset($_POST['update_profile'])) {
    $fullname = $_POST['fullname'] ?? '';
    $bio = $_POST['bio'] ?? '';
    $email = $_POST['email'] ?? '';
    $location = $_POST['location'] ?? '';

    $stmt = $pdo->prepare("UPDATE users SET fullname=?, bio=?, email=?, location=? WHERE id=?");
    $stmt->execute([$fullname, $bio, $email, $location, $user_id]);
}

// Handle account deletion
if (isset($_POST['delete_account'])) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id=?");
    $stmt->execute([$user_id]);
    session_destroy();
    header("Location: register.php");
    exit;
}

// Fetch user info
$stmt = $pdo->prepare("SELECT * FROM users WHERE id=?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>🌱 GreenBridge — Profile</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">

<style>
:root {
    --gb-primary:#00c6ff;
    --gb-secondary:#0055ff;
    --gb-accent:#34e8ff;
    --gb-bg:#0b1620;
    --glass:rgba(255,255,255,.06);
    --glass-border:rgba(255,255,255,.14);
}
body {
    margin:0;
    font-family:"Poppins",sans-serif;
    background:linear-gradient(135deg,#0b1620,#071012);
    color:#d0f0ff;
    overflow-x:hidden;
}
h1,h2,h3,h4,h5{font-weight:700;letter-spacing:.5px;}
.navbar {
    background:rgba(10,18,28,.65);
    backdrop-filter:blur(18px);
    border-bottom:1px solid var(--glass-border);
}
.navbar-brand {
    font-weight:900;
    color:var(--gb-primary)!important;
    text-shadow:0 0 10px var(--gb-primary);
}
.nav-link {
    color:#c0f0ff!important;
    font-weight:600;
    position:relative;
    transition:.3s;
}
.nav-link:after {
    content:"";
    position:absolute;
    left:0;
    bottom:-5px;
    height:2px;
    width:0;
    background:linear-gradient(90deg,var(--gb-primary),var(--gb-secondary));
    box-shadow:0 0 8px var(--gb-primary);
    transition:width .35s ease;
}
.nav-link:hover:after,.nav-link.active:after{width:100%;}
.profile-container {
    max-width:900px;
    margin:150px auto 60px;
    padding:30px;
    background:var(--glass);
    backdrop-filter:blur(18px);
    border-radius:20px;
    box-shadow:0 0 25px rgba(0,198,255,.3);
    position:relative;
}
.profile-container::before {
    content:"";
    position:absolute;
    top:-40%;
    left:-40%;
    width:180%;
    height:180%;
    background:radial-gradient(circle at 30% 30%,#00c6ff33,#0055ff00);
    transform:rotate(0deg);
    animation:rotateBG 18s linear infinite;
    z-index:0;
}
@keyframes rotateBG {0%{transform:rotate(0deg);}100%{transform:rotate(360deg);}}
.profile-header {
    display:flex;
    align-items:center;
    gap:25px;
    flex-wrap:wrap;
    position:relative;
    z-index:1;
}
.profile-header img {
    width:120px;
    height:120px;
    border-radius:50%;
    object-fit:cover;
    border:3px solid var(--gb-primary);
    box-shadow:0 0 15px var(--gb-primary);
}
.profile-details h2,input.form-control {
    font-size:20px;
    color:var(--gb-primary);
    margin-bottom:6px;
    border-radius:10px;
}
.profile-details p,input.form-control {margin-bottom:10px;color:#d0f0ff;}
.profile-stats {
    display:flex;
    justify-content:space-between;
    margin-top:20px;
    flex-wrap:wrap;
    gap:10px;
}
.profile-stats div {text-align:center;flex:1;}
.profile-stats div h5 {font-size:16px;color:var(--gb-accent);margin-bottom:4px;}
.profile-stats div span {color:#a0e0ff;font-size:13px;}
.profile-actions {margin-top:20px;}
.profile-actions button {
    margin-right:10px;
    transition:.3s;
    padding:10px 16px;
    font-weight:600;
}
.profile-actions button:hover {
    transform:scale(1.05);
    box-shadow:0 0 15px var(--gb-primary);
}
.section-title {
    font-size:24px;
    margin-bottom:25px;
    color:var(--gb-secondary);
    text-shadow:0 0 10px var(--gb-primary);
}
input.form-control {
    background:rgba(255,255,255,0.06);
    border:1px solid var(--glass-border);
    color:#d0f0ff;
    transition:.3s;
    font-size:14px;
}
input.form-control:focus {
    border-color:var(--gb-primary);
    box-shadow:0 0 8px var(--gb-primary);
    outline:none;
}
.orbs {
    position:absolute;
    border-radius:50%;
    filter:blur(100px);
    opacity:0.15;
    animation:floatOrb 12s ease-in-out infinite alternate;
    z-index:0;
}
.orb1{width:180px;height:180px;background:#00c6ff;top:-50px;left:-50px;}
.orb2{width:250px;height:250px;background:#0055ff;bottom:-70px;right:-70px;}
@keyframes floatOrb {0%{transform:translateY(0px);}100%{transform:translateY(20px);}}
</style>
</head>
<body>

<!-- Soft floating orbs -->
<div class="orbs orb1"></div>
<div class="orbs orb2"></div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#"><i class="fas fa-leaf me-2"></i>GreenBridge</a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="profile.php" class="nav-link active">Profile</a></li>
        <li class="nav-item"><a href="dashboard.php" class="nav-link">Dashboard</a></li>
        <li class="nav-item"><a href="generate_qr.php" class="nav-link">QR code generation</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Profile Section -->
<section class="profile-container" data-aos="fade-up">
  <div class="d-flex flex-wrap gap-4 justify-content-between" style="position:relative; z-index:1;">
    
    <!-- Left Column: Profile pic + stats -->
    <div class="d-flex flex-column align-items-center text-center flex-shrink-0" style="width:200px;">
      <div class="profile-pic-wrapper mb-3">
        <img src="https://i.pinimg.com/736x/4b/73/80/4b738083af3e8a5a546c7bfce9438d49.jpg" class="profile-pic">
        <div class="orb small-orb"></div>
      </div>
      <div class="profile-stats d-flex flex-column gap-2 w-100">
        <div><h6><?= $user['events_attended'] ?? 0 ?></h6><span>Events</span></div>
        <div><h6><?= $user['greenpoints'] ?? 0 ?></h6><span>GreenPoints</span></div>
        <div><h6><?= $user['achievements'] ?? 0 ?></h6><span>Achievements</span></div>
      </div>
      <div class="profile-actions mt-3">
        <button type="submit" name="update_profile" class="btn btn-outline-info btn-sm w-100 mb-2"><i class="fas fa-edit me-2"></i>Edit</button>
        <button type="submit" name="delete_account" class="btn btn-outline-danger btn-sm w-100" onclick="return confirm('Are you sure? This cannot be undone.')"><i class="fas fa-trash me-2"></i>Delete</button>
      </div>
    </div>

    <!-- Right Column: Editable info -->
    <div class="flex-grow-1">
      <form method="POST" class="d-flex flex-column gap-2">
        <input type="text" name="fullname" value="<?= htmlspecialchars($user['fullname'] ?? '') ?>" class="form-control form-control-lg" placeholder="Full Name">
        <input type="text" name="bio" value="<?= htmlspecialchars($user['bio'] ?? '') ?>" class="form-control" placeholder="Bio">
        <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" class="form-control" placeholder="Email">
        <input type="text" name="location" value="<?= htmlspecialchars($user['location'] ?? '') ?>" class="form-control" placeholder="Location">
      </form>

      <div class="mt-4">
        <h5 class="section-title">Recent Activities</h5>
        <ul class="list-group list-group-flush text-light">
          <li class="list-group-item bg-transparent border-bottom"><i class="fas fa-check-circle me-2 text-info"></i>Registered for "Tree Planting Day"</li>
          <li class="list-group-item bg-transparent border-bottom"><i class="fas fa-check-circle me-2 text-info"></i>Uploaded photos from "Beach Cleanup"</li>
          <li class="list-group-item bg-transparent border-bottom"><i class="fas fa-check-circle me-2 text-info"></i>Earned 200 GreenPoints for "Recycling Challenge"</li>
        </ul>
      </div>
    </div>

  </div>
</section>

<style>
/* Profile card adjustments */
.profile-container {
    max-width:900px;
    margin:150px auto 60px;
    padding:25px 35px;
    background:rgba(0,0,0,0.25);
    backdrop-filter:blur(18px);
    border-radius:20px;
    box-shadow:0 0 35px rgba(0,198,255,.3);
    position:relative;
}

.profile-pic-wrapper {
    position:relative;
    width:140px;
    height:140px;
}
.profile-pic {
    width:140px;
    height:140px;
    border-radius:50%;
    border:3px solid var(--gb-primary);
    object-fit:cover;
    box-shadow:0 0 20px var(--gb-primary);
}
.orb.small-orb {
    position:absolute;
    width:50px;
    height:50px;
    border-radius:50%;
    background:rgba(0,198,255,.2);
    top:-15px;
    left:-10px;
    filter:blur(15px);
    animation:floatOrb 10s ease-in-out infinite alternate;
}

input.form-control, input.form-control-lg {
    background: rgba(0,0,0,0.25); /* dark transparent background */
    border: 1px solid rgba(255,255,255,0.12);
    color: #ffffff; /* text white */
    transition: all 0.3s ease;
}

input.form-control:focus, input.form-control-lg:focus {
    background: rgba(0,0,0,0.35); /* slightly darker on focus */
    color: #ffffff; /* text remains white */
    border-color: var(--gb-primary); /* glowing border */
    box-shadow: 0 0 10px var(--gb-primary);
    outline: none;
}


.section-title {
    font-size:20px;
    margin-bottom:15px;
    color:#fff;
    text-shadow:0 0 10px var(--gb-primary);
}

@keyframes floatOrb {
  0%{transform:translateY(0px);}
  100%{transform:translateY(15px);}
}
/* Recent Activities text */
.profile-container .list-group-item {
    color: #ffffff !important; /* bright white text */
    background: transparent;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.profile-container .list-group-item i {
    color: #00c6ff; /* keep icons neon blueish */
}

</style>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>AOS.init({ duration:1200, once:true });</script>
</body>
</html>
