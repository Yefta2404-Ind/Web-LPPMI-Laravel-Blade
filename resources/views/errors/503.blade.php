<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pemeliharaan — LPM Universitas Gunung Kidul</title>
<meta name="robots" content="noindex, nofollow">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=Space+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">

<style>
/* ───── RESET & BASE ───── */
*, *::before, *::after {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

:root {
  /* Warna utama #11009E (Deep Royal Blue) */
  --bg-deep: #11009E;
  --bg-gradient-start: #11009E;
  --bg-gradient-end: #1e1a6b;
  --accent-glow: #4d3eff;
  --accent-light: #6b5eff;
  --accent-soft: #938aff;
  --white: #FFFFFF;
  --white-muted: rgba(255, 255, 255, 0.85);
  --white-dim: rgba(255, 255, 255, 0.55);
  --glass-bg: rgba(255, 255, 255, 0.08);
  --glass-border: rgba(255, 255, 255, 0.15);
  --card-bg: rgba(20, 5, 110, 0.55);
  --shadow-xl: 0 20px 35px -12px rgba(0, 0, 0, 0.4);
  --radius-lg: 32px;
  --radius-md: 24px;
  --radius-sm: 18px;
  --font-sans: 'Inter', system-ui, -apple-system, sans-serif;
  --font-mono: 'Space Grotesk', monospace;
}

body {
  background: var(--bg-deep);
  background-image: radial-gradient(circle at 10% 20%, rgba(77, 62, 255, 0.18) 0%, rgba(17, 0, 158, 0.4) 90%),
                    linear-gradient(125deg, var(--bg-gradient-start) 0%, #0a0470 100%);
  min-height: 100vh;
  font-family: var(--font-sans);
  color: var(--white);
  display: flex;
  flex-direction: column;
  -webkit-font-smoothing: antialiased;
  position: relative;
  overflow-x: hidden;
}

/* Dekorasi geometris animasi */
body::before {
  content: '';
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" opacity="0.1"><path fill="none" stroke="white" stroke-width="0.8" d="M20 20 L80 20 M20 40 L80 40 M20 60 L80 60 M20 80 L80 80 M40 20 L40 80 M60 20 L60 80 M80 20 L80 80"/><circle cx="50" cy="50" r="18" stroke="white" fill="none" stroke-width="0.8"/><path d="M50 32 L50 68 M32 50 L68 50" stroke="white" stroke-width="0.6"/></svg>');
  background-repeat: repeat;
  background-size: 42px;
  pointer-events: none;
  z-index: 0;
}

.glow-orb {
  position: fixed;
  width: 70vw;
  height: 70vw;
  background: radial-gradient(circle, rgba(77, 62, 255, 0.25) 0%, rgba(17, 0, 158, 0) 70%);
  border-radius: 50%;
  top: -30vh;
  right: -20vw;
  filter: blur(70px);
  pointer-events: none;
  z-index: 0;
}

.glow-orb-bottom {
  position: fixed;
  width: 80vw;
  height: 80vw;
  background: radial-gradient(circle, rgba(147, 138, 255, 0.2) 0%, rgba(17, 0, 158, 0) 70%);
  bottom: -40vh;
  left: -20vw;
  filter: blur(80px);
  pointer-events: none;
  z-index: 0;
}

/* ───── TOP NAVIGATION ───── */
.topnav {
  position: relative;
  z-index: 20;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1rem clamp(1.5rem, 6vw, 3.5rem);
  background: rgba(10, 4, 70, 0.55);
  backdrop-filter: blur(16px);
  border-bottom: 1px solid var(--glass-border);
  flex-wrap: wrap;
  gap: 12px;
}

.nav-logo {
  display: flex;
  align-items: center;
  gap: 12px;
  text-decoration: none;
}

.logo-icon {
  width: 42px;
  height: 42px;
  background: linear-gradient(135deg, var(--accent-light), #3b2cff);
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
}

.logo-text {
  font-weight: 600;
  font-size: 1.1rem;
  letter-spacing: -0.2px;
  background: linear-gradient(120deg, #fff, #c7c2ff);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
}

.logo-text small {
  display: block;
  font-size: 0.7rem;
  font-weight: 400;
  color: var(--white-dim);
  background: none;
  -webkit-background-clip: unset;
  background-clip: unset;
}

.maintenance-badge {
  background: rgba(255, 215, 0, 0.12);
  backdrop-filter: blur(4px);
  border: 1px solid rgba(255, 215, 0, 0.35);
  border-radius: 100px;
  padding: 6px 16px;
  font-family: var(--font-mono);
  font-size: 0.75rem;
  font-weight: 500;
  letter-spacing: 0.5px;
  display: flex;
  align-items: center;
  gap: 8px;
  color: #ffec9e;
}

.pulse-dot {
  width: 8px;
  height: 8px;
  background: #ffd966;
  border-radius: 50%;
  animation: pulse-ring 1.8s infinite;
}

@keyframes pulse-ring {
  0% { box-shadow: 0 0 0 0 rgba(255, 217, 102, 0.6); transform: scale(0.9);}
  70% { box-shadow: 0 0 0 8px rgba(255, 217, 102, 0); transform: scale(1);}
  100% { box-shadow: 0 0 0 0 rgba(255, 217, 102, 0); transform: scale(0.9);}
}

/* ───── MAIN CONTENT ───── */
main {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2rem 1.5rem 4rem;
  position: relative;
  z-index: 10;
}

.hero-card {
  max-width: 680px;
  width: 100%;
  background: var(--card-bg);
  backdrop-filter: blur(20px);
  border-radius: var(--radius-lg);
  border: 1px solid var(--glass-border);
  padding: 2.5rem 2rem;
  box-shadow: var(--shadow-xl);
  transition: transform 0.25s ease;
  animation: floatUp 0.8s cubic-bezier(0.2, 0.9, 0.4, 1.1) both;
}

@keyframes floatUp {
  0% { opacity: 0; transform: translateY(30px) scale(0.98);}
  100% { opacity: 1; transform: translateY(0) scale(1);}
}

.icon-orbit {
  display: flex;
  justify-content: center;
  margin-bottom: 1.2rem;
}

.rounded-icon {
  background: linear-gradient(145deg, rgba(255,255,255,0.12), rgba(100, 80, 255, 0.2));
  width: 80px;
  height: 80px;
  border-radius: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1px solid rgba(255,255,255,0.2);
  box-shadow: 0 15px 25px -8px rgba(0,0,0,0.3);
}

.rounded-icon svg {
  filter: drop-shadow(0 2px 5px rgba(0,0,0,0.2));
}

.eyebrow {
  text-align: center;
  font-family: var(--font-mono);
  font-size: 0.7rem;
  letter-spacing: 3px;
  text-transform: uppercase;
  color: var(--accent-soft);
  margin-bottom: 1rem;
  font-weight: 500;
}

h1 {
  text-align: center;
  font-size: clamp(2rem, 6vw, 3rem);
  font-weight: 700;
  letter-spacing: -0.02em;
  line-height: 1.2;
  background: linear-gradient(to right, #ffffff, #cbc6ff);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
  margin-bottom: 0.9rem;
}

.subhead {
  text-align: center;
  font-size: 1rem;
  color: var(--white-muted);
  max-width: 440px;
  margin: 0 auto 2rem auto;
  line-height: 1.55;
  font-weight: 400;
}

/* Countdown */
.countdown-section {
  margin: 1.8rem 0 1.5rem;
}

.countdown-label {
  text-align: center;
  font-family: var(--font-mono);
  font-size: 0.7rem;
  text-transform: uppercase;
  letter-spacing: 2px;
  color: var(--white-dim);
  margin-bottom: 1rem;
}

.countdown-grid {
  display: flex;
  justify-content: center;
  gap: 0.5rem;
  flex-wrap: wrap;
}

.time-card {
  background: rgba(0, 0, 0, 0.35);
  backdrop-filter: blur(8px);
  border-radius: 28px;
  padding: 0.9rem 1rem;
  min-width: 80px;
  text-align: center;
  border: 1px solid rgba(255,255,255,0.1);
  box-shadow: 0 5px 12px rgba(0,0,0,0.2);
}

.time-number {
  font-family: var(--font-mono);
  font-size: 2.5rem;
  font-weight: 700;
  letter-spacing: 2px;
  color: white;
  line-height: 1;
  text-shadow: 0 2px 8px rgba(0,0,0,0.3);
}

.time-unit {
  font-size: 0.7rem;
  text-transform: uppercase;
  color: var(--white-dim);
  display: block;
  margin-top: 6px;
}

.separator {
  font-size: 2.2rem;
  font-weight: 600;
  align-self: center;
  color: var(--white-dim);
  margin-bottom: 0.3rem;
}

/* Progress Bar */
.progress-wrapper {
  margin: 1.8rem 0 1.5rem;
}

.progress-header {
  display: flex;
  justify-content: space-between;
  font-size: 0.75rem;
  margin-bottom: 8px;
  color: var(--white-muted);
}

.progress-track {
  background: rgba(255,255,255,0.15);
  border-radius: 40px;
  height: 8px;
  overflow: hidden;
  backdrop-filter: blur(4px);
}

.progress-fill {
  background: linear-gradient(90deg, #ffd966, #ffe19e);
  width: 0%;
  height: 100%;
  border-radius: 40px;
  box-shadow: 0 0 6px rgba(255, 217, 102, 0.5);
  transition: width 1s cubic-bezier(0.2, 0.9, 0.4, 1.1);
  position: relative;
}

/* ETA Card */
.eta-card {
  background: rgba(255, 255, 255, 0.05);
  border-radius: 60px;
  padding: 0.9rem 1.5rem;
  display: inline-flex;
  align-items: center;
  gap: 12px;
  margin: 1rem auto 1.8rem;
  justify-content: center;
  width: auto;
  border: 1px solid rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(8px);
}

.eta-icon {
  background: var(--accent-light);
  border-radius: 50%;
  width: 32px;
  height: 32px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.eta-text {
  font-size: 0.9rem;
  font-weight: 500;
  color: #fff4dd;
}

/* Contact Row */
.contact-row {
  display: flex;
  justify-content: center;
  margin-top: 0.5rem;
  gap: 8px;
  font-size: 0.85rem;
  color: var(--white-dim);
}

.contact-link {
  color: #ffecb3;
  text-decoration: none;
  border-bottom: 1px dotted rgba(255,236,179,0.5);
  transition: all 0.2s;
}

.contact-link:hover {
  color: white;
  border-bottom-color: white;
}

/* Footer */
footer {
  position: relative;
  z-index: 10;
  border-top: 1px solid rgba(255,255,255,0.1);
  padding: 1.3rem clamp(1.5rem, 6vw, 3rem);
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 15px;
  background: rgba(0, 0, 0, 0.25);
  backdrop-filter: blur(10px);
  font-size: 0.7rem;
  color: var(--white-dim);
}

.footer-links {
  display: flex;
  gap: 24px;
}

.footer-links a {
  color: var(--white-dim);
  text-decoration: none;
  transition: color 0.2s;
}

.footer-links a:hover {
  color: white;
}

/* Responsive */
@media (max-width: 550px) {
  .hero-card {
    padding: 1.8rem 1.2rem;
  }
  .time-card {
    min-width: 60px;
    padding: 0.6rem 0.5rem;
  }
  .time-number {
    font-size: 1.8rem;
  }
  .separator {
    font-size: 1.6rem;
  }
  .eta-card {
    padding: 0.6rem 1rem;
  }
}
</style>
</head>
<body>

<div class="glow-orb"></div>
<div class="glow-orb-bottom"></div>

<nav class="topnav">
  <a href="#" class="nav-logo">
    <div class="logo-icon">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
      </svg>
    </div>
    <div class="logo-text">
      LPM UGK
      <small>Lembaga Penjaminan Mutu</small>
    </div>
  </a>
  <div class="maintenance-badge">
    <span class="pulse-dot"></span>
    PEMELIHARAAN AKTIF
  </div>
</nav>

<main>
  <div class="hero-card">
    <div class="icon-orbit">
      <div class="rounded-icon">
        <svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
          <path d="m12.5 11.5-2 2"/>
        </svg>
      </div>
    </div>
    <p class="eyebrow">Peningkatan & Optimalisasi</p>
    <h1>Sedang menyegarkan<br>sistem mutu</h1>
    <p class="subhead">Kami sedang membawa pengalaman baru untuk LPM Universitas Gunung Kidul. Halaman akan aktif kembali dalam hitungan waktu.</p>

    <!-- Countdown smart -->
    <div class="countdown-section">
      <p class="countdown-label">⌛ Estimasi penyelesaian</p>
      <div class="countdown-grid" id="countdownContainer">
        <div class="time-card"><span class="time-number" id="hours">02</span><span class="time-unit">Jam</span></div>
        <div class="separator">:</div>
        <div class="time-card"><span class="time-number" id="minutes">00</span><span class="time-unit">Menit</span></div>
        <div class="separator">:</div>
        <div class="time-card"><span class="time-number" id="seconds">00</span><span class="time-unit">Detik</span></div>
      </div>
    </div>

    <!-- Progress dengan nilai dinamis -->
    <div class="progress-wrapper">
      <div class="progress-header">
        <span>⚙️ Proses pemeliharaan</span>
        <strong id="pctValue">74%</strong>
      </div>
      <div class="progress-track">
        <div class="progress-fill" id="progressFillBar" style="width: 74%;"></div>
      </div>
    </div>

    <!-- ETA Card -->
    <div style="display: flex; justify-content: center;">
      <div class="eta-card">
        <div class="eta-icon">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
            <circle cx="12" cy="12" r="10"/>
            <polyline points="12 6 12 12 16 14"/>
          </svg>
        </div>
        <div class="eta-text">Perkiraan kembali: <strong id="etaMessage">± 1–2 jam lagi</strong></div>
      </div>
    </div>

    <!-- Kontak -->

  </div>
</main>

<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script>
(function() {
  // ----- COUNTDOWN dengan localStorage (2 jam 4 menit dari pertama kali load)
  const STORAGE_KEY = 'lpm_maintenance_end_ts';
  let endTimestamp = localStorage.getItem(STORAGE_KEY);
  const now = Date.now();
  if (!endTimestamp || isNaN(parseInt(endTimestamp))) {
    // set durasi maintenance sekitar 2 jam 5 menit (lebih natural)
    endTimestamp = now + (2 * 60 * 60 * 1000) + (5 * 60 * 1000);
    localStorage.setItem(STORAGE_KEY, endTimestamp);
  } else {
    endTimestamp = parseInt(endTimestamp, 10);
    // jika endTimestamp sudah lewat (misal browser cache) reset +2 jam
    if (endTimestamp < now) {
      endTimestamp = now + (2 * 60 * 60 * 1000) + (6 * 60 * 1000);
      localStorage.setItem(STORAGE_KEY, endTimestamp);
    }
  }

  function formatTwoDigits(num) {
    return Math.floor(num).toString().padStart(2, '0');
  }

  function updateCountdown() {
    const diff = endTimestamp - Date.now();
    if (diff <= 0) {
      document.getElementById('hours').innerText = '00';
      document.getElementById('minutes').innerText = '00';
      document.getElementById('seconds').innerText = '00';
      return;
    }
    const hours = diff / 3600000;
    const minutes = (diff % 3600000) / 60000;
    const seconds = (diff % 60000) / 1000;
    document.getElementById('hours').innerText = formatTwoDigits(hours);
    document.getElementById('minutes').innerText = formatTwoDigits(minutes);
    document.getElementById('seconds').innerText = formatTwoDigits(seconds);
  }
  updateCountdown();
  setInterval(updateCountdown, 1000);

  // ----- PROGRESS BAR dinamis + localStorage / simulasi seperti maintenance nyata
  const PROGRESS_KEY = 'lpm_maint_progress_pct';
  let progressValue = parseFloat(localStorage.getItem(PROGRESS_KEY));
  if (isNaN(progressValue) || progressValue < 10) {
    // default awal 68% agar natural
    progressValue = 68;
    localStorage.setItem(PROGRESS_KEY, progressValue);
  } else if (progressValue > 98) {
    progressValue = 88; // safety kalau pernah terlalu tinggi
    localStorage.setItem(PROGRESS_KEY, progressValue);
  }

  const fillElement = document.getElementById('progressFillBar');
  const pctLabel = document.getElementById('pctValue');
  const etaMsgSpan = document.getElementById('etaMessage');

  function updateProgressUI(value) {
    const rounded = Math.min(98, Math.max(0, value));
    fillElement.style.width = rounded + '%';
    pctLabel.innerText = Math.floor(rounded) + '%';
    // Update ETA Text berdasarkan persentase
    if (rounded >= 92) {
      etaMsgSpan.innerText = 'kurang dari 20 menit!';
    } else if (rounded >= 85) {
      etaMsgSpan.innerText = 'sekitar 30 menit lagi';
    } else if (rounded >= 75) {
      etaMsgSpan.innerText = '± 1 jam lagi';
    } else if (rounded >= 65) {
      etaMsgSpan.innerText = 'sekitar 1–1.5 jam';
    } else {
      etaMsgSpan.innerText = '± 1.5 – 2 jam lagi';
    }
  }

  updateProgressUI(progressValue);

  // Simulasi progress bertambah secara bertahap setiap 9 detik (lebih alami) hingga ~96%
  const interval = setInterval(() => {
    if (progressValue >= 96) {
      if (progressValue >= 98) {
        clearInterval(interval);
        return;
      }
      progressValue = Math.min(98, progressValue + (Math.random() * 0.45));
    } else {
      // naik antara 0.5% ~ 1.2% per step
      let increment = 0.4 + Math.random() * 1.2;
      progressValue = Math.min(97, progressValue + increment);
    }
    progressValue = parseFloat(progressValue.toFixed(1));
    localStorage.setItem(PROGRESS_KEY, progressValue);
    updateProgressUI(progressValue);
  }, 8900);

  // Opsional: ketika halaman ditutup pun progress tersimpan, beri efek lancar
  // juga jika progress sudah tinggi dan countdown masih lama -> tidak masalah konsisten
  // untuk sinkronisasi lebih keren menggunakan warna gold progres #FFD966
})();
</script>
</body>
</html>