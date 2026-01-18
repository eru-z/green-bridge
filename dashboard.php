<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>GreenBridge — Command Center Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Bootstrap + Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<!-- AOS for scroll animations -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

<!-- Lottie -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.11.0/lottie.min.js"></script>

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">

  <style>
*{box-sizing:border-box}
body{margin:0;font-family:"Poppins",sans-serif;background-color:rgb(2, 48, 64);color:#eaf7f0;overflow-x:hidden;scroll-behavior:smooth;}
h1,h2,h3,h4,h5{font-weight:900;letter-spacing:.6px;}
    .glass { background: rgba(255,255,255,0.06); backdrop-filter: blur(14px); border: 1px solid rgba(255,255,255,0.08); }
    .glow { box-shadow: 0 10px 30px rgba(16,185,129,0.18); }
    .btn-neon { background: linear-gradient(90deg,#10B981,#34D399); box-shadow:0 0 10px #10B981,0 0 20px #34D399; transition: all .2s ease; }
    .btn-neon:hover { transform: translateY(-1px); box-shadow:0 0 16px #10B981,0 0 30px #34D399; }
    h1 span, h2 span { background: linear-gradient(90deg,#22c55e,#06b6d4,#a855f7); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-size: 200% auto; animation: shine 8s linear infinite; }
    @keyframes shine { to { background-position: 200% center; } }
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-thumb { background: #10B981; border-radius: 6px; }

/* Scroll progress bar */
#progress-bar{position:fixed;top:0;left:0;width:0;height:5px;background:linear-gradient(90deg,var(--gb-primary),var(--gb-secondary),var(--gb-accent));z-index:99999;transition:width .25s ease}

/* Cursor glow & sparks */
.cursor-glow{position:fixed;left:0;top:0;width:280px;height:280px;border-radius:50%;pointer-events:none;mix-blend-mode:screen;background:radial-gradient(circle, rgba(52,232,158,.5), rgba(0,198,255,.25), transparent 60%);filter:blur(40px);transform:translate(-50%,-50%);z-index:9999;transition:transform .15s ease-out;}
.spark{position:absolute;width:4px;height:4px;border-radius:50%;background:var(--gb-accent);pointer-events:none;opacity:0.8;animation:fadeSpark 0.7s linear forwards;}
@keyframes fadeSpark{0%{opacity:1;transform:translate(0,0) scale(1)}100%{opacity:0;transform:translate(30px,30px) scale(0)}}

/* Navbar */
.navbar{background:rgba(10,18,28,.65);backdrop-filter:blur(18px);border-bottom:1px solid var(--glass-border);}
.navbar-brand{font-weight:900;color:var(--gb-primary)!important;text-shadow:0 0 14px var(--gb-primary),0 0 28px var(--gb-secondary);}
.nav-link{color:#e6fff5!important;font-weight:700;position:relative;transition:.3s;}
.nav-link:after{content:"";position:absolute;left:0;bottom:-6px;height:3px;width:0;background:linear-gradient(90deg,var(--gb-primary),var(--gb-secondary),var(--gb-accent));box-shadow:0 0 12px var(--gb-primary);transition:width .35s ease;}
.nav-link:hover:after,.nav-link.active:after{width:100%}

.quick-actions a {
  color: white !important;   /* make text white */
  text-decoration: none;     /* remove underline */
}

.quick-actions a:hover {
  color: #ddd;  /* lighter white/gray on hover */
}


/* Footer */
footer{background:#081019;position:relative;overflow:hidden;padding:60px 0;}
footer::before{content:"";position:absolute;inset:auto 0 0 0;height:2px;background:linear-gradient(90deg,var(--gb-primary),var(--gb-secondary),var(--gb-accent));background-size:250% 100%;animation:flow 5s linear infinite;}
  </style>
</head>
<body class="min-h-screen flex flex-col">

<!-- Scroll Progress -->
<div id="progress-bar"></div>

<!-- Cursor Glow -->
<div class="cursor-glow" aria-hidden="true"></div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#"><i class="fas fa-leaf me-2"></i>GreenBridge</a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="profile.php" class="nav-link">Profile</a></li>
        <li class="nav-item"><a href="dashboard.php" class="nav-link active">Dashboard</a></li>
        <li class="nav-item"><a href="generate_qr.php" class="nav-link">QR Code Generation</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero / Welcome -->
<header class="px-6 md:px-10 pt-28">
  <div class="glass rounded-3xl p-6 md:p-8 glow transition hover:shadow-2xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
      
      <!-- Welcome text -->
      <div>
        <h2 class="text-3xl md:text-5xl font-extrabold leading-tight">
          Welcome back, <span>Erudita</span> 👋
        </h2>
        <p class="text-green-300 mt-2 text-lg">Your eco impact hub — plan events, track points, and inspire change.</p>
      </div>

      <!-- Profile mini-card -->
      <div class="flex items-center gap-6">
        <div class="flex items-center gap-3">
          <img src="https://i.pinimg.com/736x/5f/49/3d/5f493d835e9a6201eef663db2e14fb94.jpg" class="w-14 h-14 rounded-full ring-4 ring-green-500/40" alt="User">
          <div>
            <p class="font-bold text-green-100">User</p>
            <span class="text-xs text-gray-400">Eco Leader</span>
          </div>
        </div>
        <div class="text-center">
          <p class="text-xs text-gray-400">GreenPoints</p>
          <p class="text-2xl font-extrabold text-teal-300">750</p>
        </div>
        <div class="text-center">
          <p class="text-xs text-gray-400">CO₂ Saved</p>
          <p class="text-2xl font-extrabold text-green-300">12.4 kg</p>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- MAIN -->
<main class="flex-1 px-6 md:px-10 py-10 space-y-10">

  <!-- Section: Impact + Chart -->
  <section class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    
    <!-- Event card -->
    <div class="glass rounded-3xl p-6 lg:col-span-5 hover:scale-[1.02] transition">
      <div class="flex items-start justify-between">
        <h3 class="font-semibold text-green-200">Next Event</h3>
        <a href="events.php" class="text-xs text-gray-400 hover:text-green-300">View all</a>
      </div>
      <div class="mt-4 flex items-center gap-4">
        <img class="w-20 h-20 object-cover rounded-2xl" src="https://images.unsplash.com/photo-1552083375-1447ce886485?auto=format&fit=crop&w=160&q=80" alt="Event" />
        <div>
          <p class="text-lg font-bold text-green-100">Tree Planting Campaign</p>
          <p class="text-sm text-gray-300">City park • Jun 1, 2025</p>
        </div>
      </div>
      <!-- Countdown -->
      <div class="mt-5">
        <p class="text-xs text-gray-400 mb-2">Starts in</p>
        <div id="countdown" class="grid grid-cols-4 gap-2">
          <div class="glass rounded-xl p-3 text-center"><div id="cdDays" class="text-2xl font-extrabold">00</div><div class="text-xxs text-gray-400">Days</div></div>
          <div class="glass rounded-xl p-3 text-center"><div id="cdHours" class="text-2xl font-extrabold">00</div><div class="text-xxs text-gray-400">Hours</div></div>
          <div class="glass rounded-xl p-3 text-center"><div id="cdMins" class="text-2xl font-extrabold">00</div><div class="text-xxs text-gray-400">Mins</div></div>
          <div class="glass rounded-xl p-3 text-center"><div id="cdSecs" class="text-2xl font-extrabold">00</div><div class="text-xxs text-gray-400">Secs</div></div>
        </div>
      </div>
      <div class="mt-5 flex gap-3">
        <button class="btn-neon px-4 py-2 rounded-xl">Join Event</button>
        <a href="generate_qr.php" class="px-4 py-2 rounded-xl border border-green-500 text-green-300 hover:bg-green-500 hover:text-gray-900 transition">QR Check-in</a>
      </div>
    </div>

    <!-- Chart -->
    <div class="glass rounded-3xl p-6 lg:col-span-7 hover:scale-[1.02] transition">
      <div class="flex items-center justify-between">
        <h3 class="font-semibold text-green-200">Attendance Trend</h3>
        <div class="text-xs text-gray-400">Last 6 months</div>
      </div>
      <canvas id="attendanceChart" class="mt-6"></canvas>
    </div>
  </section>

  <!-- Section: KPIs -->
  <section class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <div class="glass rounded-3xl p-6 text-center hover:scale-105 transition">
      <canvas id="donutEvents" class="mx-auto w-36 h-36"></canvas>
      <p class="mt-3 text-sm text-gray-300">Events attended 3/5</p>
    </div>
    <div class="glass rounded-3xl p-6 text-center hover:scale-105 transition">
      <canvas id="donutApprovals" class="mx-auto w-36 h-36"></canvas>
      <p class="mt-3 text-sm text-gray-300">Photos approved 8/12</p>
    </div>
    <div class="glass rounded-3xl p-6 hover:scale-105 transition">
      <p class="text-center font-semibold text-green-200 mb-3">GreenPoints Progress</p>
      <div class="space-y-3">
        <div><div class="flex justify-between text-xs text-gray-400 mb-1"><span>This month</span><span>65%</span></div><div class="w-full bg-gray-800 rounded-full h-2"><div class="bg-teal-400 h-2 rounded-full" style="width:65%"></div></div></div>
        <div><div class="flex justify-between text-xs text-gray-400 mb-1"><span>Volunteer hours</span><span>40%</span></div><div class="w-full bg-gray-800 rounded-full h-2"><div class="bg-green-500 h-2 rounded-full" style="width:40%"></div></div></div>
        <div><div class="flex justify-between text-xs text-gray-400 mb-1"><span>CO₂ saved goal</span><span>24%</span></div><div class="w-full bg-gray-800 rounded-full h-2"><div class="bg-emerald-400 h-2 rounded-full" style="width:24%"></div></div></div>
      </div>
    </div>
  </section>

  <!-- Section: Leaderboard + Notifications + Actions -->
  <section class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    
    <div class="glass rounded-3xl p-6 lg:col-span-5 hover:scale-[1.02] transition">
      <div class="flex items-start justify-between">
        <h3 class="font-semibold text-green-200">Top Contributors</h3>
        <a href="leaderboard.php" class="text-xs text-gray-400 hover:text-green-300">Full leaderboard</a>
      </div>
      <ul class="mt-4 text-sm text-gray-300 space-y-2">
        <li class="flex justify-between"><span>1️⃣ Alice</span><span class="text-green-300">1200 🌱</span></li>
        <li class="flex justify-between"><span>2️⃣ Bob</span><span class="text-green-300">950 🌱</span></li>
        <li class="flex justify-between"><span>3️⃣ Carol</span><span class="text-green-300">870 🌱</span></li>
        <li class="flex justify-between"><span>4️⃣ Dave</span><span class="text-green-300">750 🌱</span></li>
      </ul>
    </div>

    <div class="glass rounded-3xl p-6 lg:col-span-4 hover:scale-[1.02] transition">
      <h3 class="font-semibold text-green-200">Notifications</h3>
      <ul class="mt-4 text-xs text-gray-300 space-y-2 max-h-52 overflow-auto pr-2">
        <li>📷 3 new photos pending approval</li>
        <li>📅 "Tree Planting" gained 5 registrations</li>
        <li>🏆 Leaderboard updated</li>
        <li>📰 New article published: "Urban Gardens 101"</li>
        <li>🔔 Reminder: Submit volunteer hours</li>
      </ul>
    </div>

<div class="glass rounded-3xl p-6 lg:col-span-3 hover:scale-[1.02] transition">
  <h3 class="font-semibold text-green-200 mb-3">Quick Actions</h3>
  <div class="grid grid-cols-1 gap-3">
    <a href="events.php" class="btn-neon py-2 rounded-xl text-center text-white">Browse Events</a>
    <a href="generate_qr.php" class="py-2 rounded-xl text-center border border-green-500 text-white hover:bg-green-500 hover:text-gray-900 transition">Generate QR</a>
    <a href="events.php" class="py-2 rounded-xl text-center border border-teal-400 text-white hover:bg-teal-400 hover:text-gray-900 transition">Upload Photos</a>
    <a href="news.php" class="py-2 rounded-xl text-center border border-indigo-400 text-white hover:bg-indigo-400 hover:text-gray-900 transition">Write News</a>
  </div>
</div>

  </section>

</main>




<!-- Footer -->
<footer class="position-relative py-5" style="background:#0b1620;overflow:hidden;">
  <!-- Particle Background -->
  <canvas id="footerParticles" style="position:absolute;inset:0;width:100%;height:100%;z-index:0;"></canvas>

  <div class="container position-relative text-light" style="z-index:2;">
    <div class="row text-center text-md-start g-4 mb-4">
      <!-- About -->
      <div class="col-md-4">
        <div class="glass p-4 rounded-4">
          <h5 class="text-gradient-green mb-3">About GreenBridge</h5>
          <p>Connecting youth with sustainable opportunities and rewarding eco-engagement worldwide.</p>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="col-md-4">
        <div class="glass p-4 rounded-4">
          <h5 class="text-gradient-green mb-3">Quick Links</h5>
          <a href="#features" class="footer-link d-block mb-2">Features</a>
          <a href="#events" class="footer-link d-block mb-2">Events</a>
          <a href="#recognition" class="footer-link d-block mb-2">Recognition</a>
        </div>
      </div>

      <!-- Contact -->
      <div class="col-md-4">
        <div class="glass p-4 rounded-4">
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

<style>
/* Glass Effect */
footer .glass{
  background:rgba(255,255,255,0.05);
  backdrop-filter:blur(12px);
  border-radius:16px;
  transition:transform .35s ease,box-shadow .35s ease;
}
footer .glass:hover{
  transform:scale(1.03);
  box-shadow:0 0 40px #34e89e,0 0 60px #00c6ff;
}

/* Gradient Text */
.text-gradient-green{
  background:linear-gradient(90deg,#34e89e,#00c6ff,#79ff4d);
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  text-shadow:0 0 15px rgba(52,232,158,.6);
}

/* Footer Links Hover */
.footer-link{
  color:#fff;
  text-decoration:none;
  transition:color .3s ease,transform .3s ease;
}
.footer-link:hover{
  color:#34e89e;
  transform:translateX(5px);
}

/* Social Icons */
.social-icon{
  color:#fff;
  margin-right:10px;
  transition:transform .3s ease,color .3s ease;
}
.social-icon:hover{
  color:#34e89e;
  transform:scale(1.2);
}
</style>

<script>
// Particle Background
const canvasFtr=document.getElementById('footerParticles');
const ctxFtr=canvasFtr.getContext('2d');
canvasFtr.width=window.innerWidth;canvasFtr.height=window.innerHeight;
let particlesFtr=[];
for(let i=0;i<60;i++){
  particlesFtr.push({x:Math.random()*canvasFtr.width,y:Math.random()*canvasFtr.height,r:Math.random()*2+1,dx:(Math.random()-0.5)*0.2,dy:(Math.random()-0.5)*0.2});
}
function animateParticlesFtr(){
  ctxFtr.clearRect(0,0,canvasFtr.width,canvasFtr.height);
  particlesFtr.forEach(p=>{
    ctxFtr.beginPath();
    ctxFtr.arc(p.x,p.y,p.r,0,Math.PI*2);
    ctxFtr.fillStyle="rgba(52,232,158,0.15)";
    ctxFtr.fill();
    p.x+=p.dx;p.y+=p.dy;
    if(p.x<0)p.x=canvasFtr.width;if(p.x>canvasFtr.width)p.x=0;
    if(p.y<0)p.y=canvasFtr.height;if(p.y>canvasFtr.height)p.y=0;
  });
  requestAnimationFrame(animateParticlesFtr);
}
animateParticlesFtr();
window.addEventListener('resize',()=>{canvasFtr.width=window.innerWidth;canvasFtr.height=window.innerHeight});
</script>
  <script>
    // ===== Charts =====
    const lineCtx = document.getElementById('attendanceChart').getContext('2d');
    new Chart(lineCtx, {
      type: 'line',
      data: {
        labels: ['Jan','Feb','Mar','Apr','May','Jun'],
        datasets: [{
          label: 'Attended',
          data: [2,3,5,4,3,6],
          borderColor: '#10B981',
          backgroundColor: 'rgba(16,185,129,0.2)',
          tension: 0.35,
          fill: true,
          borderWidth: 2
        }]
      },
      options: { responsive:true, plugins:{ legend:{ display:false } }, scales:{ y:{ beginAtZero:true, grid:{ color:'rgba(148,163,184,0.1)'} }, x:{ grid:{ color:'rgba(148,163,184,0.06)'} } } }
    });

    function donut(id, a, b, colors){
      return new Chart(document.getElementById(id).getContext('2d'), {
        type:'doughnut',
        data:{ labels:['Completed','Remaining'], datasets:[{ data:[a,b], backgroundColor:colors, borderWidth:0 }] },
        options:{ cutout:'70%', plugins:{ legend:{ display:false } } }
      });
    }
    donut('donutEvents', 3, 2, ['#10B981','#1e293b']);
    donut('donutApprovals', 8, 4, ['#22c55e','#1e293b']);

    // ===== Countdown to next event (example date: 2025-06-01T10:00:00) =====
    const target = new Date('2025-06-01T10:00:00').getTime();
    const pad = (n)=> String(n).padStart(2,'0');
    const tick = () => {
      const now = Date.now();
      let diff = Math.max(0, target - now);
      const days = Math.floor(diff / (1000*60*60*24)); diff -= days*24*60*60*1000;
      const hrs  = Math.floor(diff / (1000*60*60));   diff -= hrs*60*60*1000;
      const mins = Math.floor(diff / (1000*60));      diff -= mins*60*1000;
      const secs = Math.floor(diff / 1000);
      document.getElementById('cdDays').textContent = pad(days);
      document.getElementById('cdHours').textContent = pad(hrs);
      document.getElementById('cdMins').textContent = pad(mins);
      document.getElementById('cdSecs').textContent = pad(secs);
    };
    tick(); setInterval(tick, 1000);

    // ===== Animate monthly goal bar on load =====
    window.addEventListener('load', () => {
      const bar = document.getElementById('goalBar');
      bar.style.width = '0%';
      setTimeout(()=>{ bar.style.transition = 'width 900ms ease'; bar.style.width = '62%'; }, 150);
    });
  </script>
</body>
</html>