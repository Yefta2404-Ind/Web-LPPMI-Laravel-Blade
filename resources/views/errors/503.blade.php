<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pemeliharaan — LPM Universitas Gunung Kidul</title>
<meta name="robots" content="noindex, nofollow">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500&family=DM+Serif+Display:ital@0;1&family=DM+Mono:wght@400;500&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

<style>
/* ─── Reset & Base ─── */
*, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

:root {
  --white:    #ffffff;
  --off:      #fafafa;
  --f1:       #f4f4f5;
  --f2:       #eeeeef;
  --border:   #e4e4e7;
  --border2:  #d4d4d8;
  --t1:       #09090b;
  --t2:       #52525b;
  --t3:       #a1a1aa;
  --blue:     #2563eb;
  --blue-lt:  #eff6ff;
  --blue-mid: #bfdbfe;
  --green:    #16a34a;
  --green-lt: #f0fdf4;
  --amber:    #d97706;
  --serif: 'DM Serif Display', Georgia, serif;
  --sans:  'DM Sans', system-ui, sans-serif;
  --mono:  'DM Mono', monospace;
  --radius: 14px;
  --shadow: 0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
  --shadow-md: 0 4px 16px rgba(0,0,0,.07), 0 1px 4px rgba(0,0,0,.04);
}

html { scroll-behavior: smooth; }

body {
  font-family: var(--sans);
  background: var(--white);
  color: var(--t1);
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  -webkit-font-smoothing: antialiased;
}

/* ─── Top Nav ─── */
.topnav {
  position: sticky;
  top: 0;
  z-index: 100;
  background: rgba(255,255,255,.92);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border-bottom: 1px solid var(--border);
  padding: 0 clamp(1.2rem, 5vw, 3rem);
  height: 56px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.nav-logo {
  display: flex;
  align-items: center;
  gap: 10px;
  text-decoration: none;
}
.nav-logo-icon {
  width: 32px;
  height: 32px;
  border-radius: 8px;
  border: 1px solid var(--border);
  background: var(--f1);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.nav-logo-icon svg { color: var(--blue); }
.nav-logo-label {
  font-size: 13px;
  font-weight: 500;
  color: var(--t1);
  line-height: 1.3;
}
.nav-logo-label span {
  display: block;
  font-size: 11px;
  font-weight: 400;
  color: var(--t3);
}

.nav-badge {
  display: flex;
  align-items: center;
  gap: 7px;
  font-family: var(--mono);
  font-size: 11px;
  font-weight: 500;
  color: var(--amber);
  background: #fffbeb;
  border: 1px solid #fde68a;
  border-radius: 100px;
  padding: 5px 12px;
  letter-spacing: .04em;
}
.nav-dot {
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: var(--amber);
  animation: pulse 2s ease-in-out infinite;
}
@keyframes pulse {
  0%,100% { opacity: 1; box-shadow: 0 0 0 0 rgba(217,119,6,.4); }
  50%      { opacity: .6; box-shadow: 0 0 0 5px rgba(217,119,6,0); }
}

/* ─── Main Layout ─── */
main {
  flex: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: clamp(2.5rem, 8vw, 5rem) clamp(1.2rem, 5vw, 2rem);
}

.hero {
  width: 100%;
  max-width: 520px;
  text-align: center;
  animation: fadeUp .7s cubic-bezier(.16,1,.3,1) both;
}
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(18px); }
  to   { opacity: 1; transform: none; }
}

/* ─── Icon ─── */
.icon-wrap {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 72px;
  height: 72px;
  border-radius: 20px;
  background: var(--f1);
  border: 1px solid var(--border);
  margin-bottom: 28px;
  animation: fadeUp .7s .05s cubic-bezier(.16,1,.3,1) both;
}
.icon-wrap svg {
  color: var(--blue);
  animation: rock 3.5s ease-in-out infinite;
  transform-origin: center;
}
@keyframes rock { 0%,100% { transform: rotate(-10deg); } 50% { transform: rotate(10deg); } }

/* ─── Typography ─── */
.eyebrow {
  font-family: var(--mono);
  font-size: 11px;
  font-weight: 500;
  letter-spacing: .1em;
  text-transform: uppercase;
  color: var(--blue);
  margin-bottom: 14px;
  animation: fadeUp .7s .08s cubic-bezier(.16,1,.3,1) both;
}

h1 {
  font-family: var(--serif);
  font-size: clamp(2rem, 5vw, 2.9rem);
  font-weight: 400;
  color: var(--t1);
  line-height: 1.12;
  letter-spacing: -.02em;
  margin-bottom: 16px;
  animation: fadeUp .7s .1s cubic-bezier(.16,1,.3,1) both;
}
h1 em {
  font-style: italic;
  color: var(--t3);
}

.desc {
  font-size: 15px;
  color: var(--t2);
  line-height: 1.72;
  font-weight: 300;
  max-width: 400px;
  margin: 0 auto 36px;
  animation: fadeUp .7s .12s cubic-bezier(.16,1,.3,1) both;
}

/* ─── Countdown ─── */
.countdown-wrap {
  margin-bottom: 32px;
  animation: fadeUp .7s .14s cubic-bezier(.16,1,.3,1) both;
}
.countdown-label {
  font-family: var(--mono);
  font-size: 10.5px;
  color: var(--t3);
  letter-spacing: .09em;
  text-transform: uppercase;
  margin-bottom: 14px;
}
.countdown {
  display: inline-flex;
  align-items: flex-end;
  gap: 0;
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 16px 24px 14px;
  box-shadow: var(--shadow);
}
.t-unit { display: flex; flex-direction: column; align-items: center; min-width: 56px; }
.t-num {
  font-family: 'Roboto', 'Google Sans', sans-serif;
  font-size: clamp(2.8rem, 6vw, 3.6rem);
  font-weight: 300;
  color: var(--t1);
  line-height: 1;
  font-variant-numeric: tabular-nums;
  letter-spacing: -.02em;
}
.t-lbl {
  font-family: var(--mono);
  font-size: 9.5px;
  color: var(--t3);
  letter-spacing: .09em;
  text-transform: uppercase;
  margin-top: 6px;
}
.t-sep {
  font-family: 'Roboto', sans-serif;
  font-size: clamp(2rem, 4vw, 2.6rem);
  color: var(--border2);
  font-weight: 300;
  line-height: 1;
  padding: 0 4px;
  margin-bottom: 20px;
  flex-shrink: 0;
}

/* ─── Progress ─── */
.progress-wrap {
  margin-bottom: 32px;
  animation: fadeUp .7s .16s cubic-bezier(.16,1,.3,1) both;
}
.progress-top {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 8px;
}
.progress-top span {
  font-size: 12px;
  color: var(--t3);
  font-family: var(--mono);
  letter-spacing: .04em;
}
.progress-top strong {
  font-size: 12px;
  font-weight: 500;
  color: var(--blue);
  font-family: var(--mono);
}
.progress-track {
  height: 3px;
  background: var(--f2);
  border-radius: 100px;
  overflow: hidden;
}
.progress-fill {
  height: 100%;
  background: var(--blue);
  border-radius: 100px;
  transition: width 1.5s ease;
  position: relative;
  overflow: hidden;
}
.progress-fill::after {
  content: '';
  position: absolute; inset: 0;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,.45), transparent);
  animation: shim 2.4s ease-in-out infinite;
  transform: translateX(-100%);
}
@keyframes shim { to { transform: translateX(200%); } }

@keyframes spin { to { transform: rotate(360deg); } }

/* ─── ETA Row ─── */
.eta-row {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 13px 16px;
  background: var(--off);
  border: 1px solid var(--border);
  border-radius: 10px;
  margin-bottom: 28px;
  text-align: left;
  animation: fadeUp .7s .18s cubic-bezier(.16,1,.3,1) both;
}
.eta-icon {
  width: 28px; height: 28px;
  border-radius: 8px;
  background: var(--f2);
  border: 1px solid var(--border);
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}
.eta-icon svg { color: var(--t2); }
.eta-text { font-size: 12.5px; color: var(--t2); line-height: 1.5; }
.eta-text strong { color: var(--t1); font-weight: 500; }

/* ─── Contact ─── */
.contact {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  font-size: 13px;
  color: var(--t3);
  animation: fadeUp .7s .20s cubic-bezier(.16,1,.3,1) both;
}
.contact a {
  color: var(--blue);
  text-decoration: none;
  font-weight: 500;
}
.contact a:hover { text-decoration: underline; }

/* ─── Footer ─── */
footer {
  border-top: 1px solid var(--border);
  padding: 20px clamp(1.2rem, 5vw, 3rem);
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 12px;
  background: var(--off);
}
.foot-copy {
  font-size: 12px;
  color: var(--t3);
}
.foot-links {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
}
.foot-links a {
  font-size: 12px;
  color: var(--t3);
  text-decoration: none;
  transition: color .15s;
}
.foot-links a:hover { color: var(--t2); }

/* ─── Responsive ─── */
@media (max-width: 600px) {
  .nav-logo-label span { display: none; }
  .countdown { padding: 14px 16px; }
  .t-unit { min-width: 46px; }
  .t-sep { padding: 0 2px; }
  footer {
    flex-direction: column;
    align-items: flex-start;
    text-align: left;
  }
  .foot-links { gap: 14px; }
}

@media (max-width: 400px) {
  .countdown { padding: 12px; gap: 0; }
  .t-unit { min-width: 38px; }
}

/* ─── Print ─── */
@media print {
  .topnav, .countdown-wrap, .progress-wrap, .eta-row { display: none; }
  body { background: white; }
}
</style>
</head>
<body>

<!-- ═══ TOP NAV ═══ -->
<nav class="topnav">
  <a href="#" class="nav-logo">
    <div class="nav-logo-icon">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
        <path d="M6 12v5c0 1.7 2.7 3 6 3s6-1.3 6-3v-5"/>
      </svg>
    </div>
    <div class="nav-logo-label">
      LPM Universitas Gunung Kidul
      <span>Lembaga Penjaminan Mutu</span>
    </div>
  </a>
  <div class="nav-badge">
    <span class="nav-dot"></span>
    Maintenance
  </div>
</nav>

<!-- ═══ MAIN ═══ -->
<main>
  <div class="hero">

    <div class="icon-wrap">
      <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
        <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
      </svg>
    </div>

    <p class="eyebrow">Pemeliharaan Terjadwal</p>

    <h1>Kami sedang<br>memperbarui <em>sistem</em></h1>

    <p class="desc">Website LPM sedang dalam pemeliharaan rutin untuk meningkatkan performa dan keandalan layanan. Mohon bersabar — kami segera kembali.</p>

    <!-- Countdown -->
    <div class="countdown-wrap">
      <p class="countdown-label">Estimasi waktu selesai</p>
      <div class="countdown">
        <div class="t-unit">
          <span class="t-num" id="hours">02</span>
          <span class="t-lbl">Jam</span>
        </div>
        <div class="t-sep">:</div>
        <div class="t-unit">
          <span class="t-num" id="minutes">00</span>
          <span class="t-lbl">Menit</span>
        </div>
        <div class="t-sep">:</div>
        <div class="t-unit">
          <span class="t-num" id="seconds">00</span>
          <span class="t-lbl">Detik</span>
        </div>
      </div>
    </div>

    <!-- Progress -->
    <div class="progress-wrap">
      <div class="progress-top">
        <span>Progress pemeliharaan</span>
        <strong id="pctLabel">74%</strong>
      </div>
      <div class="progress-track">
        <div class="progress-fill" id="progressFill" style="width:74%"></div>
      </div>
    </div>


    <!-- ETA -->
    <div class="eta-row">
      <div class="eta-icon">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"/>
          <polyline points="12 6 12 12 16 14"/>
        </svg>
      </div>
      <div class="eta-text">Perkiraan selesai: <strong id="etaText">± 1–2 jam lagi</strong></div>
    </div>

    <!-- Contact -->
    <div class="contact">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
        <polyline points="22,6 12,13 2,6"/>
      </svg>
      Ada pertanyaan? Hubungi kami di <a href="/cdn-cgi/l/email-protection#caa6baa78abfada1e4aba9e4a3ae"><span class="__cf_email__" data-cfemail="573b273a1722303c793634793e33">[email&#160;protected]</span></a>
    </div>

  </div>
</main>

<!-- ═══ FOOTER ═══ -->
<footer>
  <p class="foot-copy">© 2025 LPM Universitas Gunung Kidul. Semua hak dilindungi.</p>
  <nav class="foot-links">
    <a href="#">Kebijakan Privasi</a>
    <a href="#">Ketentuan Layanan</a>
    <a href="#">Hubungi Kami</a>
  </nav>
</footer>

<script>
(function () {
  /* ── Countdown — persist via localStorage ── */
  var KEY = 'lpm_maint_end';
  var stored = localStorage.getItem(KEY);
  var end = stored ? parseInt(stored, 10) : Date.now() + (2 * 60 + 8) * 60000;
  if (!stored) localStorage.setItem(KEY, String(end));

  function pad(n) { return String(Math.floor(n)).padStart(2, '0'); }

  function tick() {
    var d = end - Date.now();
    if (d <= 0) {
      document.getElementById('hours').textContent   = '00';
      document.getElementById('minutes').textContent = '00';
      document.getElementById('seconds').textContent = '00';
      document.getElementById('etaText').textContent = 'sebentar lagi';
      return;
    }
    document.getElementById('hours').textContent   = pad(d / 3600000);
    document.getElementById('minutes').textContent = pad(d % 3600000 / 60000);
    document.getElementById('seconds').textContent = pad(d % 60000 / 1000);
  }
  tick();
  setInterval(tick, 1000);

  /* ── Progress — persist via localStorage ── */
  var PKEY = 'lpm_maint_pct';
  var p = parseFloat(localStorage.getItem(PKEY) || '74');
  var fill  = document.getElementById('progressFill');
  var label = document.getElementById('pctLabel');
  var eta   = document.getElementById('etaText');

  fill.style.width  = p + '%';
  label.textContent = Math.round(p) + '%';
  if      (p >= 88) eta.textContent = '< 30 menit lagi';
  else if (p >= 78) eta.textContent = '± 1 jam lagi';

  setInterval(function () {
    if (p >= 94) return;
    p = Math.min(94, parseFloat((p + Math.random() * 0.8 + 0.25).toFixed(1)));
    localStorage.setItem(PKEY, String(p));
    fill.style.width  = p + '%';
    label.textContent = Math.round(p) + '%';
    if      (p >= 88) eta.textContent = '< 30 menit lagi';
    else if (p >= 78) eta.textContent = '± 1 jam lagi';
  }, 7000);
})();
</script>
</body>
</html>