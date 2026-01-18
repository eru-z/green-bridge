<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>🌱 GreenBridge — ULTRA MAX Cinematic Experience</title>

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
:root{
  --gb-primary:#34e89e;
  --gb-secondary:#00c6ff;
  --gb-accent:#ff6ec7;
  --gb-bg:#0b1620;
  --glass:rgba(255,255,255,.06);
  --glass-border:rgba(255,255,255,.14);
}
*{box-sizing:border-box}
body{margin:0;font-family:"Poppins",sans-serif;background:var(--gb-bg);color:#eaf7f0;overflow-x:hidden;scroll-behavior:smooth;}
h1,h2,h3,h4,h5{font-weight:900;letter-spacing:.6px;}
section{padding:120px 0;position:relative;z-index:1}

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

/* Preloader */
.preloader{position:fixed;inset:0;background:#070e14;display:grid;place-items:center;z-index:99999;}
.spinner-logo{font-size:60px;color:var(--gb-primary);animation:spin 2s linear infinite;text-shadow:0 0 24px var(--gb-primary);}
@keyframes spin{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}

/* Hero */
.hero{height:100vh;display:grid;place-items:center;text-align:center;position:relative;overflow:hidden;background:radial-gradient(ellipse at center, rgba(0,198,255,.05), transparent);}
#globe3d{position:absolute;inset:0;z-index:0;}
.hero-overlay{position:absolute;inset:0;background:radial-gradient(1200px 800px at 50% 60%, rgba(0,198,255,.2), transparent), linear-gradient(180deg, rgba(0,0,0,.5), rgba(0,0,0,.2) 40%, transparent);}
.hero-content{position:relative;z-index:2;max-width:1200px;padding:0 24px;}
.mega-title{font-size:clamp(3rem,7vw,6rem);line-height:1.05;background:linear-gradient(90deg,var(--gb-primary),var(--gb-secondary),var(--gb-accent));background-size:400% 100%;-webkit-background-clip:text;-webkit-text-fill-color:transparent;animation:flow 6s linear infinite, glitch 1.8s infinite;}
.mega-sub{font-size:clamp(1.2rem,2vw,1.5rem);opacity:.95;margin:.8rem auto 2rem;max-width:900px;}
@keyframes flow{0%{background-position:0 0}100%{background-position:250% 0}}
@keyframes glitch{0%{transform:translate(0,0)}20%{transform:translate(-2px,2px)}40%{transform:translate(2px,-2px)}60%{transform:translate(-2px,-2px)}80%{transform:translate(2px,2px)}100%{transform:translate(0,0)}}

/* CTA Buttons */
.btn-neo{position:relative;overflow:hidden;border:none;border-radius:50px;padding:16px 40px;font-weight:900;color:#061017;background:linear-gradient(90deg,var(--gb-primary),var(--gb-secondary));box-shadow:0 12px 36px rgba(0,198,255,.3), inset 0 0 16px rgba(255,255,255,.28);transition:transform .25s ease, box-shadow .3s ease;}
.btn-neo:hover{transform:translateY(-4px) scale(1.02);box-shadow:0 16px 48px rgba(0,198,255,.35), inset 0 0 22px rgba(255,255,255,.3);}
.btn-neo:active{transform:translateY(0) scale(1);}
.btn-ghost{background:transparent;color:#eafff7;border:1px solid var(--glass-border);backdrop-filter:blur(10px);box-shadow:inset 0 0 0 1px rgba(255,255,255,.05);}

/* Glass Cards */
.glass{background:var(--glass);border:1px solid var(--glass-border);backdrop-filter:blur(20px);border-radius:26px;}
.feature-card, .event-card{padding:44px;transition:.5s;position:relative;box-shadow:0 8px 40px rgba(0,198,255,.1);}
.feature-card:hover, .event-card:hover{transform:translateY(-12px) scale(1.02);box-shadow:0 26px 80px rgba(52,232,158,.25);}
.feature-icon{font-size:3rem;color:var(--gb-primary);text-shadow:0 0 20px var(--gb-primary);}
.event-card img{height:280px;object-fit:cover;border-radius:24px;transition:.3s;}
.event-card:hover img{filter:brightness(1.1) saturate(1.2);}

/* Stats Boxes */
.stats-box{background:linear-gradient(150deg,var(--gb-primary),var(--gb-secondary));padding:64px;border-radius:28px;color:#00130c;box-shadow:0 24px 70px rgba(0,198,255,.25);transition:transform .35s;}
.stats-box:hover{transform:scale(1.03);}

/* Footer */
footer{background:#081019;position:relative;overflow:hidden;padding:60px 0;}
footer::before{content:"";position:absolute;inset:auto 0 0 0;height:2px;background:linear-gradient(90deg,var(--gb-primary),var(--gb-secondary),var(--gb-accent));background-size:250% 100%;animation:flow 5s linear infinite;}
</style>
</head>
<body>

<!-- Scroll Progress -->
<div id="progress-bar"></div>

<!-- Preloader -->
<div class="preloader"><div class="spinner-logo"><i class="fas fa-leaf"></i></div></div>

<!-- Cursor Glow -->
<div class="cursor-glow" aria-hidden="true"></div>

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
        <li class="nav-item"><a href="generate_qr.php" class="nav-link">QR code generation</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero -->
<section class="hero">
  <div id="globe3d"></div>
  <div class="hero-overlay"></div>
  <div class="hero-content" data-aos="fade-up">
    <h1 class="mega-title">Green Opportunities for Youth</h1>
    <p class="mega-sub">Join eco-events, earn GreenPoints, and become a recognized eco-hero 🌱</p>
    <div class="cta-row">
      <a href="#events" class="btn btn-neo">Explore Events</a>
      <a href="login.php" class="btn btn-ghost">Login</a>
    </div>
  </div>
</section>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r152/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/three-globe"></script>

<script>
// AOS init
AOS.init({ duration: 1200, once: true });

// Preloader hide
window.addEventListener("load",()=>document.querySelector(".preloader").style.display="none");

// Scroll Progress
window.addEventListener("scroll",()=>{const p=document.getElementById("progress-bar");p.style.width=(window.scrollY/(document.body.scrollHeight-window.innerHeight))*100+"%";});

// Cursor Glow Movement + Sparks
document.addEventListener("mousemove",e=>{
  const c=document.querySelector(".cursor-glow"); c.style.transform=`translate(${e.clientX}px,${e.clientY}px)`;
  for(let i=0;i<2;i++){
    const spark=document.createElement("div"); spark.className="spark"; spark.style.left=e.clientX+"px"; spark.style.top=e.clientY+"px";
    document.body.appendChild(spark); setTimeout(()=>spark.remove(),700);
  }
});

// 3D Globe
const Globe = new ThreeGlobe({globeImageUrl: 'https://unpkg.com/three-globe/example/img/earth-dark.jpg'});
const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75,window.innerWidth/window.innerHeight,0.1,2000);
camera.position.z = 400;
const renderer = new THREE.WebGLRenderer({alpha:true,antialias:true});
renderer.setSize(window.innerWidth,window.innerHeight);
document.getElementById("globe3d").appendChild(renderer.domElement);
scene.add(Globe);
scene.add(new THREE.AmbientLight(0xffffff,0.6));
const directional = new THREE.DirectionalLight(0xffffff,0.5); directional.position.set(1,1,1); scene.add(directional);
function animate(){Globe.rotateY(0.001);renderer.render(scene,camera);requestAnimationFrame(animate);}
animate();
</script>

<!-- Features -->
<section id="features" class="text-center">
  <div class="container">
    <h2 class="section-title mb-5" data-aos="fade-up">How GreenBridge Works</h2>
    <div class="row g-4">
      <div class="col-md-3" data-aos="zoom-in">
        <div class="feature-card glass">
          <div class="feature-icon"><i class="fas fa-user-plus"></i></div>
          <h5 class="mt-3">Sign Up</h5>
          <p>Create your account and start your eco journey.</p>
          <div id="lottie-signup" style="height:80px;"></div>
        </div>
      </div>
      <div class="col-md-3" data-aos="zoom-in" data-aos-delay="200">
        <div class="feature-card glass">
          <div class="feature-icon"><i class="fas fa-calendar-check"></i></div>
          <h5 class="mt-3">Browse Events</h5>
          <p>Register for upcoming eco-events.</p>
          <div id="lottie-events" style="height:80px;"></div>
        </div>
      </div>
      <div class="col-md-3" data-aos="zoom-in" data-aos-delay="400">
        <div class="feature-card glass">
          <div class="feature-icon"><i class="fas fa-camera"></i></div>
          <h5 class="mt-3">Share Photos</h5>
          <p>Inspire others with your eco moments.</p>
          <div id="lottie-photos" style="height:80px;"></div>
        </div>
      </div>
      <div class="col-md-3" data-aos="zoom-in" data-aos-delay="600">
        <div class="feature-card glass">
          <div class="feature-icon"><i class="fas fa-award"></i></div>
          <h5 class="mt-3">Earn Rewards</h5>
          <p>Win recognition, badges & certificates.</p>
          <div id="lottie-rewards" style="height:80px;"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Events -->
<section id="events" class="position-relative py-5" style="background:#0b1620;overflow:hidden;">
  <!-- Particle Background -->
  <canvas id="eventParticles" style="position:absolute;inset:0;width:100%;height:100%;z-index:0;"></canvas>

  <div class="container position-relative" style="z-index:2;">
    <div class="text-center mb-5" data-aos="fade-down">
      <h2 class="text-gradient-green display-5 fw-bold mb-2">Latest Events</h2>
      <p class="text-light fs-6">Join our eco-friendly initiatives and make a difference!</p>
    </div>

    <div class="row g-4 justify-content-center text-center">
      <!-- Event 1 -->
      <div class="col-12 col-md-6 col-lg-4" data-aos="fade-right">
        <div class="event-card glass py-4 px-3 d-flex flex-column align-items-center hover-glow">
          <div class="event-icon mb-3 d-flex justify-content-center align-items-center">
            <i class="fas fa-broom fa-3x text-gradient-green"></i>
          </div>
          <h5 class="fw-bold text-gradient mb-2">City Park Cleanup</h5>
          <p class="text-light mb-3">📅 June 12 — 📍 City Park</p>
          <a href="#" class="btn btn-neo w-75">Register</a>
        </div>
      </div>

      <!-- Event 2 -->
      <div class="col-12 col-md-6 col-lg-4" data-aos="fade-left" data-aos-delay="150">
        <div class="event-card glass py-4 px-3 d-flex flex-column align-items-center hover-glow">
          <div class="event-icon mb-3 d-flex justify-content-center align-items-center">
            <i class="fas fa-seedling fa-3x text-gradient-green"></i>
          </div>
          <h5 class="fw-bold text-gradient mb-2">Tree Planting Day</h5>
          <p class="text-light mb-3">📅 June 20 — 📍 School</p>
          <a href="#" class="btn btn-neo w-75">Register</a>
        </div>
      </div>

      <!-- Event 3 (Optional) -->
      <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
        <div class="event-card glass py-4 px-3 d-flex flex-column align-items-center hover-glow">
          <div class="event-icon mb-3 d-flex justify-content-center align-items-center">
            <i class="fas fa-recycle fa-3x text-gradient-green"></i>
          </div>
          <h5 class="fw-bold text-gradient mb-2">Community Recycling</h5>
          <p class="text-light mb-3">📅 June 25 — 📍 Downtown Square</p>
          <a href="#" class="btn btn-neo w-75">Register</a>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
/* Glassmorphic Event Cards */
.event-card{
  background:rgba(255,255,255,0.05);
  backdrop-filter:blur(12px);
  border-radius:16px;
  transition:transform .35s ease,box-shadow .35s ease;
}
.hover-glow:hover{transform:scale(1.05);box-shadow:0 0 40px #34e89e,0 0 60px #00c6ff;}
.text-gradient-green{
  background:linear-gradient(90deg,#34e89e,#00c6ff,#79ff4d);
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  text-shadow:0 0 15px rgba(52,232,158,.6);
}
.event-icon i{transition:transform .3s ease;}
.event-card:hover .event-icon i{transform:scale(1.2);}
.btn-neo{
  background:linear-gradient(90deg,#34e89e,#00c6ff);
  color:#fff;
  border:none;
  border-radius:12px;
  transition:transform .3s ease,box-shadow .3s ease;
}
.btn-neo:hover{transform:scale(1.05);box-shadow:0 0 30px #34e89e,0 0 50px #00c6ff;}
</style>

<script>
// Particle Background
const canvasEvt=document.getElementById('eventParticles');
const ctxEvt=canvasEvt.getContext('2d');
canvasEvt.width=window.innerWidth;canvasEvt.height=window.innerHeight;
let particlesEvt=[];
for(let i=0;i<80;i++){
  particlesEvt.push({x:Math.random()*canvasEvt.width,y:Math.random()*canvasEvt.height,r:Math.random()*2+1,dx:(Math.random()-0.5)*0.3,dy:(Math.random()-0.5)*0.3});
}
function animateParticlesEvt(){
  ctxEvt.clearRect(0,0,canvasEvt.width,canvasEvt.height);
  particlesEvt.forEach(p=>{
    ctxEvt.beginPath();
    ctxEvt.arc(p.x,p.y,p.r,0,Math.PI*2);
    ctxEvt.fillStyle="rgba(52,232,158,0.15)";
    ctxEvt.fill();
    p.x+=p.dx;p.y+=p.dy;
    if(p.x<0)p.x=canvasEvt.width;if(p.x>canvasEvt.width)p.x=0;
    if(p.y<0)p.y=canvasEvt.height;if(p.y>canvasEvt.height)p.y=0;
  });
  requestAnimationFrame(animateParticlesEvt);
}
animateParticlesEvt();
window.addEventListener('resize',()=>{canvasEvt.width=window.innerWidth;canvasEvt.height=window.innerHeight});
</script>


<!-- Include Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<section id="impact" class="position-relative py-5" style="background:#0b1620;overflow:hidden;">
  <!-- Particle Background -->
  <canvas id="impactParticles" style="position:absolute;inset:0;width:100%;height:100%;z-index:0;"></canvas>

  <div class="container position-relative" style="z-index:2;">
    <div class="text-center mb-5" data-aos="fade-down">
      <h2 class="text-gradient-green display-5 fw-bold mb-2">GreenBridge Impact</h2>
      <p class="text-light fs-6">See the real-world difference our Eco-Heroes make every day!</p>
    </div>

    <div class="row g-4 justify-content-center text-center">
      <!-- Stat 1 -->
      <div class="col-6 col-md-3" data-aos="zoom-in">
        <div class="stats-box glass stats-glow py-4 px-3 d-flex flex-column align-items-center">
          <div class="stat-icon mb-3 d-flex justify-content-center align-items-center">
            <i class="fas fa-calendar-check fa-2x text-gradient-green"></i>
          </div>
          <h3 class="count fs-3 mb-1" data-target="150">0</h3>
          <p class="text-light fs-6 mb-0">Events</p>
        </div>
      </div>

      <!-- Stat 2 -->
      <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="150">
        <div class="stats-box glass stats-glow py-4 px-3 d-flex flex-column align-items-center">
          <div class="stat-icon mb-3 d-flex justify-content-center align-items-center">
            <i class="fas fa-users fa-2x text-gradient-green"></i>
          </div>
          <h3 class="count fs-3 mb-1" data-target="3000">0</h3>
          <p class="text-light fs-6 mb-0">Participants</p>
        </div>
      </div>

      <!-- Stat 3 -->
      <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="300">
        <div class="stats-box glass stats-glow py-4 px-3 d-flex flex-column align-items-center">
          <div class="stat-icon mb-3 d-flex justify-content-center align-items-center">
            <i class="fas fa-camera fa-2x text-gradient-green"></i>
          </div>
          <h3 class="count fs-3 mb-1" data-target="12000">0</h3>
          <p class="text-light fs-6 mb-0">Photos</p>
        </div>
      </div>

      <!-- Stat 4 -->
      <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="450">
        <div class="stats-box glass stats-glow py-4 px-3 d-flex flex-column align-items-center">
          <div class="stat-icon mb-3 d-flex justify-content-center align-items-center">
            <i class="fas fa-award fa-2x text-gradient-green"></i>
          </div>
          <h3 class="count fs-3 mb-1" data-target="50">0</h3>
          <p class="text-light fs-6 mb-0">Rewards</p>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
/* Glassmorphic Stats */
.stats-box{
  background:rgba(255,255,255,0.05);
  backdrop-filter:blur(12px);
  border-radius:16px;
  transition:transform .35s ease,box-shadow .35s ease;
}
.stats-box:hover{transform:scale(1.05);box-shadow:0 0 40px #34e89e,0 0 60px #00c6ff;}
.stats-glow{box-shadow:0 0 20px #34e89e,0 0 30px #00c6ff;}

/* Font Awesome Icon Gradient */
.text-gradient-green{
  background:linear-gradient(90deg,#34e89e,#00c6ff,#79ff4d);
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  text-shadow:0 0 15px rgba(52,232,158,.6);
}

/* Particle Animations */
</style>

<script>
// Particle Background
const canvasImp=document.getElementById('impactParticles');
const ctxImp=canvasImp.getContext('2d');
canvasImp.width=window.innerWidth;canvasImp.height=window.innerHeight;
let particlesImp=[];
for(let i=0;i<80;i++){
  particlesImp.push({x:Math.random()*canvasImp.width,y:Math.random()*canvasImp.height,r:Math.random()*2+1,dx:(Math.random()-0.5)*0.3,dy:(Math.random()-0.5)*0.3});
}
function animateParticlesImp(){
  ctxImp.clearRect(0,0,canvasImp.width,canvasImp.height);
  particlesImp.forEach(p=>{
    ctxImp.beginPath();
    ctxImp.arc(p.x,p.y,p.r,0,Math.PI*2);
    ctxImp.fillStyle="rgba(52,232,158,0.2)";
    ctxImp.fill();
    p.x+=p.dx;p.y+=p.dy;
    if(p.x<0)p.x=canvasImp.width;if(p.x>canvasImp.width)p.x=0;
    if(p.y<0)p.y=canvasImp.height;if(p.y>canvasImp.height)p.y=0;
  });
  requestAnimationFrame(animateParticlesImp);
}
animateParticlesImp();
window.addEventListener('resize',()=>{canvasImp.width=window.innerWidth;canvasImp.height=window.innerHeight});

// Counter Animation
const counters=document.querySelectorAll('.count');
counters.forEach(counter=>{
  const updateCount=()=>{
    const target=+counter.getAttribute('data-target');
    const count=+counter.innerText;
    const increment=Math.ceil(target/200);
    if(count<target){
      counter.innerText=count+increment;
      requestAnimationFrame(updateCount);
    }else{
      counter.innerText=target;
    }
  };
  updateCount();
});
</script>


<!-- Recognition -->
<section id="recognition" class="position-relative py-5" style="background:#0b1620;overflow:hidden;">
  <!-- Particle Background -->
  <canvas id="ecoParticles" style="position:absolute;inset:0;width:100%;height:100%;z-index:0;"></canvas>

  <div class="container position-relative" style="z-index:2;">
    <div class="text-center mb-4" data-aos="fade-down">
      <h2 class="text-gradient-green fw-bold mb-2 display-5">🏆 Recognition & Rewards</h2>
      <p class="text-light fs-6 mb-0">
        Earn <strong>real certificates</strong>, <strong>eco-badges</strong>, and rise as a true <span class="text-gradient-green">Eco-Hero</span>! 🌱
      </p>
    </div>

    <!-- Compact Horizontal Cards -->
    <div class="d-flex flex-wrap justify-content-center gap-3 align-items-start">
      
      <!-- Certificates Card -->
      <div class="glass-card tilt-card hover-glow text-center" style="flex:1 1 280px;max-width:300px;padding:1rem;">
        <h5 class="text-light mb-3">🎓 Certificates</h5>
        <div class="carousel3d" style="height:120px;display:flex;justify-content:center;align-items:center;">
          <div class="carousel3d-card bg-gradient-to-r from-green-400 to-blue-400 text-dark fw-bold d-flex justify-content-center align-items-center rounded-3" style="height:100%;width:80%;">Certificate 1</div>
          <div class="carousel3d-card bg-gradient-to-r from-green-400 to-blue-400 text-dark fw-bold d-flex justify-content-center align-items-center rounded-3" style="height:100%;width:80%;">Certificate 2</div>
          <div class="carousel3d-card bg-gradient-to-r from-green-400 to-blue-400 text-dark fw-bold d-flex justify-content-center align-items-center rounded-3" style="height:100%;width:80%;">Certificate 3</div>
        </div>
        <button class="btn glow-btn btn-sm mt-2 w-100">Download All</button>
      </div>

      <!-- Trophy Tree Card -->
      <div class="glass-card tilt-card hover-glow text-center" style="flex:1 1 280px;max-width:300px;padding:1rem;">
        <h5 class="text-light mb-3">🌳 Trophy Tree</h5>
        <div class="trophy-tree mb-2 d-flex justify-content-center align-items-center" style="height:120px;">
          <div class="bg-gradient-to-r from-yellow-400 to-orange-400 rounded-circle" style="width:60px;height:60px;animation:floaty 3s ease-in-out infinite;"></div>
        </div>
        <h6 class="fw-bold text-light mb-1 fs-6">Eco Streak: 12 Weeks</h6>
        <div class="progress rounded-pill mb-1" style="height:18px;background:rgba(255,255,255,0.1);">
          <div class="progress-bar" style="width:85%;background:linear-gradient(90deg,#34e89e,#00c6ff,#ff6ec7);" role="progressbar"></div>
        </div>
        <p class="text-light mb-1 fs-7">Level 5 Eco Guardian</p>
        <div class="sparkle-animation mt-1"></div>
      </div>

      <!-- Badge Garden Card -->
      <div class="glass-card tilt-card hover-glow text-center" style="flex:1 1 280px;max-width:300px;padding:1rem;">
        <h5 class="text-light mb-3">🍃 Badge Garden</h5>
        <div class="d-flex flex-wrap justify-content-center gap-2">
          <div class="badge-card glow-card pulse-animation d-flex justify-content-center align-items-center rounded-circle" style="width:50px;height:50px;background:linear-gradient(90deg,#34e89e,#00c6ff);color:#0b1620;font-weight:bold;">TP</div>
          <div class="badge-card glow-card pulse-animation d-flex justify-content-center align-items-center rounded-circle" style="width:50px;height:50px;background:linear-gradient(90deg,#ff6ec7,#ffb347);color:#0b1620;font-weight:bold;">CC</div>
          <div class="badge-card glow-card pulse-animation d-flex justify-content-center align-items-center rounded-circle" style="width:50px;height:50px;background:linear-gradient(90deg,#00c6ff,#34e89e);color:#0b1620;font-weight:bold;">EL</div>
          <div class="badge-card glow-card pulse-animation d-flex justify-content-center align-items-center rounded-circle" style="width:50px;height:50px;background:linear-gradient(90deg,#ffb347,#ff6ec7);color:#0b1620;font-weight:bold;">WS</div>
        </div>
      </div>

    </div>
  </div>

  <!-- Floating Leaves -->
  <div class="parallax">
    <div class="leaf floaty-slow" style="position:absolute;top:10%;left:10%;width:45px;height:45px;background:linear-gradient(45deg,#34e89e,#00c6ff);border-radius:50%;"></div>
    <div class="leaf floaty-medium" style="position:absolute;top:60%;left:85%;width:40px;height:40px;background:linear-gradient(45deg,#ff6ec7,#ffb347);border-radius:50%;"></div>
    <div class="leaf floaty-fast" style="position:absolute;top:80%;left:25%;width:35px;height:35px;background:linear-gradient(45deg,#00c6ff,#34e89e);border-radius:50%;"></div>
  </div>
</section>

<style>
/* Cards */
.glass-card{
  background:rgba(255,255,255,0.05);
  backdrop-filter:blur(12px);
  border-radius:16px;
  transition:transform .35s ease,box-shadow .35s ease;
  padding:1rem;
}
.tilt-card:hover{transform:scale(1.05) rotateY(3deg) rotateX(3deg);}
.hover-glow:hover{box-shadow:0 0 40px #34e89e,0 0 60px #00c6ff;}

/* Text Gradient */
.text-gradient-green{
  background:linear-gradient(90deg,#34e89e,#00c6ff,#79ff4d);
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  text-shadow:0 0 20px rgba(52,232,158,.8);
}

/* Animations */
@keyframes pulse{0%,100%{transform:scale(1)}50%{transform:scale(1.1)}}
@keyframes floaty{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}
@keyframes glowSpark{0%{opacity:.5}50%{opacity:1}100%{opacity:.5}}

.pulse-animation{animation:pulse 1.5s infinite;}
.float-animation{animation:floaty 3s ease-in-out infinite;}
.sparkle-animation{width:100%;height:4px;background:linear-gradient(90deg,#34e89e,#00c6ff,#ff6ec7);border-radius:3px;animation:glowSpark 2s infinite linear;}

/* Carousel Cards */
.carousel3d{perspective:1200px;overflow:hidden;}
.carousel3d-container{display:flex;transform-style:preserve-3d;gap:8px;transition:transform .5s ease;}
.carousel3d-card{flex:0 0 auto;height:100%;border-radius:12px;display:flex;justify-content:center;align-items:center;color:#0b1620;font-weight:bold;transition:transform .4s;}

/* Badge Cards */
.badge-card{cursor:pointer;transition:.3s;}
.badge-card:hover{transform:scale(1.2);box-shadow:0 0 30px #00c6ff;}
.glow-card{box-shadow:0 0 20px #34e89e,0 0 30px #00c6ff;}
</style>

<script>
// Particle Background
const canvas2=document.getElementById('ecoParticles');
const ctx2=canvas2.getContext('2d');
canvas2.width=window.innerWidth;canvas2.height=window.innerHeight;
let particles2=[];
for(let i=0;i<100;i++){
  particles2.push({x:Math.random()*canvas2.width,y:Math.random()*canvas2.height,r:Math.random()*2+1,dx:(Math.random()-0.5)*0.5,dy:(Math.random()-0.5)*0.5});
}
function animateParticles2(){
  ctx2.clearRect(0,0,canvas2.width,canvas2.height);
  particles2.forEach(p=>{
    ctx2.beginPath();
    ctx2.arc(p.x,p.y,p.r,0,Math.PI*2);
    ctx2.fillStyle="rgba(52,232,158,0.2)";
    ctx2.fill();
    p.x+=p.dx;p.y+=p.dy;
    if(p.x<0)p.x=canvas2.width;if(p.x>canvas2.width)p.x=0;
    if(p.y<0)p.y=canvas2.height;if(p.y>canvas2.height)p.y=0;
  });
  requestAnimationFrame(animateParticles2);
}
animateParticles2();
window.addEventListener('resize',()=>{canvas2.width=window.innerWidth;canvas2.height=window.innerHeight});
</script>


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


<style>
/* Event Card Neon Overlays */
.event-card {
  position: relative;
  overflow: hidden;
  border-radius:28px;
  transition:.6s;
}
.event-card img{border-radius:28px;transition:transform .5s ease;}
.event-card:hover img{transform:scale(1.05);}
.event-card .event-overlay{
  position:absolute;inset:0;
  background:linear-gradient(120deg, rgba(52,232,158,.25), rgba(0,198,255,.2));
  mix-blend-mode:overlay;
  opacity:0;transition:.5s;
  border-radius:28px;
}
.event-card:hover .event-overlay{opacity:1;}
.event-card .spark{
  position:absolute;width:12px;height:12px;border-radius:50%;
  background:radial-gradient(circle,#34e89e,#00c6ff);animation:sparkMove 3s infinite;
  pointer-events:none;top:50%;left:50%;
}
@keyframes sparkMove{
  0%{transform:translate(-50%, -50%) scale(0.5);}
  50%{transform:translate(calc(-50% + 30px), calc(-50% + 20px)) scale(1);}
  100%{transform:translate(-50%, -50%) scale(0.5);}
}

/* Stats Glow Animation */
.stats-glow{
  background:linear-gradient(145deg,#34e89e,#00c6ff);
  box-shadow:0 20px 60px rgba(52,232,158,.4),0 0 30px rgba(0,198,255,.3);
  transition:transform .35s, box-shadow .35s;
}
.stats-glow:hover{transform:scale(1.05);box-shadow:0 26px 80px rgba(52,232,158,.45),0 0 40px rgba(0,198,255,.35);}
.count{font-size:2.5rem;font-weight:900;animation:countup 2s forwards;}
.text-gradient{background:linear-gradient(90deg,#34e89e,#00c6ff,#ff6ec7);-webkit-background-clip:text;-webkit-text-fill-color:transparent;animation:flow 5s linear infinite;}
</style>

<script>
// Animated stats counters
document.addEventListener("DOMContentLoaded",()=>{
  const counters=document.querySelectorAll(".count");
  counters.forEach(counter=>{
    const updateCount=()=>{
      const target=parseInt(counter.getAttribute("data-target"));
      const count=parseInt(counter.innerText)||0;
      const inc=Math.ceil(target/120);
      if(count<target){
        counter.innerText=count+inc;
        requestAnimationFrame(updateCount);
      }else counter.innerText=target;
    };
    updateCount();
  });
});
</script>


<script>
// Count animation
const counters = document.querySelectorAll(".count");
counters.forEach(counter=>{
  const updateCount=()=>{
    const target = +counter.innerText.replace(/\D/g,'');
    let count = 0;
    const step = Math.ceil(target/100);
    const interval = setInterval(()=>{
      count += step;
      if(count>=target){counter.innerText=counter.innerText; clearInterval(interval);}
      else counter.innerText=count+'+';
    },20);
  };
  updateCount();
});

// Floating leaves animation
const leaves = document.querySelectorAll(".leaf");
leaves.forEach((leaf,i)=>{
  let direction = Math.random()*2*Math.PI;
  let speed = 0.3+Math.random()*0.5;
  const floatLeaf=()=>{
    const top = parseFloat(leaf.style.top);
    const left = parseFloat(leaf.style.left);
    leaf.style.top = (top+speed)%100 + "%";
    leaf.style.left = (left+speed*Math.sin(direction))%100 + "%";
    requestAnimationFrame(floatLeaf);
  };
  floatLeaf();
});

// Lottie animations
lottie.loadAnimation({container:document.getElementById('lottie-signup'),renderer:'svg',loop:true,autoplay:true,path:'https://assets2.lottiefiles.com/packages/lf20_jzqtwf3y.json'});
lottie.loadAnimation({container:document.getElementById('lottie-events'),renderer:'svg',loop:true,autoplay:true,path:'https://assets2.lottiefiles.com/packages/lf20_5gldkb.json'});
lottie.loadAnimation({container:document.getElementById('lottie-photos'),renderer:'svg',loop:true,autoplay:true,path:'https://assets2.lottiefiles.com/packages/lf20_5twhg3.json'});
lottie.loadAnimation({container:document.getElementById('lottie-rewards'),renderer:'svg',loop:true,autoplay:true,path:'https://assets2.lottiefiles.com/packages/lf20_vx3cbl.json'});
</script>
<!-- Scroll Progress Bar -->
<div id="progressBar" style="position:fixed;top:0;left:0;height:4px;width:0;background:linear-gradient(90deg,var(--gb-primary),var(--gb-secondary));z-index:9999;"></div>

<style>
/* Glitch effect for section titles */
@keyframes glitch {
  0% { text-shadow: 2px 0 var(--accent-1), -2px 0 var(--accent-2); }
  20% { text-shadow: -2px 0 var(--accent-2), 2px 0 var(--accent-1); }
  40% { text-shadow: 2px 0 var(--accent-2), -2px 0 var(--accent-1); }
  60% { text-shadow: -2px 0 var(--accent-1), 2px 0 var(--accent-2); }
  80% { text-shadow: 2px 0 var(--accent-1), -2px 0 var(--accent-2); }
  100% { text-shadow: -2px 0 var(--accent-2), 2px 0 var(--accent-1); }
}
.section-title { animation: glitch 2s infinite; }

/* Particle background */
#particles-js { position:fixed; inset:0; z-index:0; pointer-events:none; }

/* Cursor sparks */
.cursor-sparks {position:fixed;width:8px;height:8px;border-radius:50%;background:var(--gb-secondary);pointer-events:none;mix-blend-mode:screen;box-shadow:0 0 8px var(--gb-primary),0 0 14px var(--gb-secondary);z-index:9999;transition:transform .08s ease-out;}
</style>

<!-- Particle JS -->
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.12.0/lottie.min.js"></script>

<script>
// Scroll progress
window.addEventListener("scroll",()=> {
  const scrollTop = window.scrollY;
  const docHeight = document.body.scrollHeight - window.innerHeight;
  const scrollPercent = (scrollTop/docHeight)*100;
  document.getElementById("progressBar").style.width = scrollPercent+"%";
});

// Cursor trailing sparks
const cursorSparks=[];
for(let i=0;i<20;i++){
  const div=document.createElement("div");
  div.className="cursor-sparks";
  document.body.appendChild(div);
  cursorSparks.push(div);
}
document.addEventListener("mousemove",(e)=>{
  cursorSparks.forEach((spark,i)=>{
    setTimeout(()=>{spark.style.transform=`translate(${e.clientX}px,${e.clientY}px)`;},i*10);
  });
});

// Particle JS configuration
particlesJS("particles-js",{
  "particles":{
    "number":{"value":80,"density":{"enable":true,"value_area":800}},
    "color":{"value":["#34e89e","#00c6ff","#ff6ec7"]},
    "shape":{"type":"circle"},
    "opacity":{"value":0.5,"random":true},
    "size":{"value":3,"random":true},
    "line_linked":{"enable":true,"distance":120,"color":"#34e89e","opacity":0.3,"width":1},
    "move":{"enable":true,"speed":2,"direction":"none","random":true,"straight":false,"out_mode":"out"}
  },
  "interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"repulse"}},"modes":{"repulse":{"distance":100,"duration":0.4}}}
});

// Leaf floating already defined in previous script

</script>

</body>
</html>
