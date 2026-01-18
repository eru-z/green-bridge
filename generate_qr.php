<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>🌱 GreenBridge — QR Generator</title>

  <!-- Bootstrap + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">

  <style>
  :root {
    --gb-primary: #34e89e;
    --gb-secondary: #00c6ff;
    --gb-accent: #ff6ec7;
    --gb-bg: #0b1620;
    --glass: rgba(255,255,255,0.06);
    --glass-border: rgba(255,255,255,0.14);
  }

  body {
    margin: 0;
    font-family: "Poppins", sans-serif;
    background: var(--gb-bg);
    color: #eaf7f0;
    overflow-x: hidden;
  }

  h2 {
    font-weight: 800;
    background: linear-gradient(90deg, var(--gb-primary), var(--gb-secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  /* Navbar */
  .navbar {
    background: rgba(10,18,28,.7);
    backdrop-filter: blur(14px);
    border-bottom: 1px solid var(--glass-border);
  }
  .navbar-brand {
    font-weight: 900;
    color: var(--gb-primary) !important;
    text-shadow: 0 0 14px var(--gb-primary), 0 0 28px var(--gb-secondary);
  }
  .nav-link {
    color: #e6fff5 !important;
    font-weight: 600;
    position: relative;
  }
  .nav-link:after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -6px;
    height: 3px;
    width: 0;
    background: linear-gradient(90deg,var(--gb-primary),var(--gb-secondary),var(--gb-accent));
    box-shadow: 0 0 12px var(--gb-primary);
    transition: width .35s ease;
  }
  .nav-link:hover:after, .nav-link.active:after { width: 100%; }

  /* Glass Card */
  .glass {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(16px);
    padding: 2rem;
    box-shadow: 0 8px 32px rgba(0,0,0,0.35),
                0 0 25px rgba(52, 232, 158, 0.2);
    transition: transform .3s, box-shadow .3s;
  }
  .glass:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.45),
                0 0 40px rgba(52,232,158,.4);
  }

  /* Grid */
  .card-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
  }
  @media(max-width: 768px) {
    .card-grid { grid-template-columns: 1fr; }
  }

  /* QR Preview */
  #qrCanvas {
    background: radial-gradient(circle at center, rgba(52,232,158,.15), transparent 70%);
    border-radius: 16px;
    border: 2px solid rgba(52, 211, 153, 0.4);
    box-shadow: 0 0 20px rgba(52,211,153,0.3),
                0 0 60px rgba(0,198,255,0.25);
    padding: 12px;
  }

  /* Buttons */
  .btn-green {
    background: linear-gradient(135deg, #34e89e, #00c6ff);
    color: white;
    border: none;
    border-radius: 14px;
    padding: 12px 20px;
    font-weight: 700;
    position: relative;
    overflow: hidden;
    transition: all .35s ease;
  }
  .btn-green::after {
    content: "";
    position: absolute;
    top: 0; left: -120%;
    width: 120%; height: 100%;
    background: linear-gradient(120deg, transparent, rgba(255,255,255,.5), transparent);
    transition: left .6s ease;
  }
  .btn-green:hover::after { left: 100%; }
  .btn-green:hover {
    box-shadow: 0 0 25px rgba(52,232,158,.7), 0 0 40px rgba(0,198,255,.4);
    transform: translateY(-3px);
  }

  /* Footer */
  footer {
    border-top: 2px solid;
    border-image: linear-gradient(90deg,#34e89e,#00c6ff,#ff6ec7) 1;
    background: #0b1620;
  }
  footer .glass { background: rgba(255,255,255,0.05); }

  .footer-link { color:#fff; text-decoration:none; }
  .footer-link:hover { color:#34e89e; }

  .social-icon { color:#fff; margin-right:10px; }
  .social-icon:hover { color:#34e89e; }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#"><i class="fas fa-leaf me-2"></i>GreenBridge</a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="profile.php" class="nav-link">Profile</a></li>
        <li class="nav-item"><a href="dashboard.php" class="nav-link">Dashboard</a></li>
        <li class="nav-item"><a href="generate_qr.php" class="nav-link active">QR Generator</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Main -->
<main class="container py-5" style="margin-top:100px;">
  <h2 class="text-center mb-5">✨ Generate Your Event QR Code</h2>
  
  <div class="card-grid">
    <!-- Form -->
    <div class="glass">
      <h4 class="mb-3"><i class="fa-solid fa-qrcode text-success"></i> QR Generator</h4>
      <form id="qrForm" class="d-flex flex-column gap-3">
        <input type="text" id="qrText" placeholder="Enter event link or text" 
               class="form-control rounded-pill p-3 bg-dark text-white border-0">
        <select id="qrSize" class="form-select rounded-pill bg-dark text-white border-0 p-3">
          <option value="150">150x150</option>
          <option value="250" selected>250x250</option>
          <option value="350">350x350</option>
        </select>
        <button type="submit" class="btn-green w-100">
          <i class="fa fa-wand-magic-sparkles"></i> Generate QR
        </button>
      </form>
    </div>

    <!-- Preview -->
    <div class="glass text-center">
      <h4 class="mb-3"><i class="fa-solid fa-eye text-success"></i> Preview</h4>
      <canvas id="qrCanvas"></canvas>
      <div class="mt-4">
        <button id="downloadBtn" class="btn-green">
          <i class="fa fa-download"></i> Download
        </button>
      </div>
    </div>
  </div>
</main>

<!-- Footer -->
<footer class="py-5">
  <div class="container text-light">
    <div class="row text-center text-md-start g-4 mb-4">
      <div class="col-md-4">
        <div class="glass p-4">
          <h5 class="text-gradient-green mb-3">About GreenBridge</h5>
          <p>Connecting youth with sustainable opportunities and rewarding eco-engagement worldwide.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="glass p-4">
          <h5 class="text-gradient-green mb-3">Quick Links</h5>
          <a href="#features" class="footer-link d-block mb-2">Features</a>
          <a href="#events" class="footer-link d-block mb-2">Events</a>
          <a href="#recognition" class="footer-link d-block mb-2">Recognition</a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="glass p-4">
          <h5 class="text-gradient-green mb-3">Contact</h5>
          <p><i class="fas fa-envelope me-2"></i> eruditazilbearids@gmail.com</p>
          <p><i class="fas fa-map-marker-alt me-2"></i> Tetova, North Macedonia</p>
          <div class="mt-2">
            <a href="#" class="social-icon"><i class="fab fa-facebook fa-lg"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-instagram fa-lg"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-twitter fa-lg"></i></a>
          </div>
        </div>
      </div>
    </div>
    <hr class="border-light opacity-25" />
    <div class="text-center mt-3">
      &copy; 2025 GreenBridge | Built with <span class="text-gradient-green">🌱</span>
    </div>
  </div>
</footer>

<script>
  const form = document.getElementById("qrForm");
  const qrCanvas = document.getElementById("qrCanvas");
  const downloadBtn = document.getElementById("downloadBtn");

  form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const text = document.getElementById("qrText").value;
    const size = document.getElementById("qrSize").value;
    if (!text.trim()) {
      alert("Please enter text or a link to generate QR");
      return;
    }
    await QRCode.toCanvas(qrCanvas, text, { width: size });
  });

  downloadBtn.addEventListener("click", () => {
    const link = document.createElement("a");
    link.download = "greenbridge_qr.png";
    link.href = qrCanvas.toDataURL();
    link.click();
  });
</script>

</body>
</html>
