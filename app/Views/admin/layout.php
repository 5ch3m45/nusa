<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
  <title>Admin - LENTERA</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,200..800&family=Plus+Jakarta+Sans:wght@400;700;800&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            ink: '#2D3348', cream: '#F4F7FF', nbyellow: '#FFCF48',
            nborange: '#FF9F5A', nbred: '#FF6B7A', nbgreen: '#34C98E',
            nbblue: '#4DABF7', nbpurple: '#9F8CFB', nbpink: '#F783AC',
            nbscarlet: '#ff2400', nbtruered: '#ff0000',
          },
          fontFamily: {
            sans: ['Plus Jakarta Sans', 'sans-serif'],
            display: ['Bricolage Grotesque', 'system-ui', 'sans-serif']
          },
          boxShadow: {
            nb: 'none',
            nbsm: 'none',
            nblg: 'none'
          }
        }
      }
    }
  </script>
  <style>
    :root{ color-scheme: light; }
    html,body{ height:100%; }
    body{ background-color:#E9EEFB; overscroll-behavior:none; -webkit-tap-highlight-color:transparent; }
    .nb-border{ border:1.5px solid rgba(45,51,72,.10); }
    .nb-card{ background-color:rgba(255,255,255,.62); -webkit-backdrop-filter:blur(18px) saturate(170%); backdrop-filter:blur(18px) saturate(170%); border:1px solid rgba(255,255,255,.8); border-radius:1.5rem; }
    .nb-btn{ border-radius:1rem; font-weight:400; transition:transform .1s ease; }
    .nb-btn:active{ transform:scale(.97); }
    .glass-header{ background-color:rgba(255,255,255,.55); -webkit-backdrop-filter:blur(18px) saturate(170%); backdrop-filter:blur(18px) saturate(170%); border-bottom:1px solid rgba(255,255,255,.8); }
    .bottom-nav{ padding-bottom: env(safe-area-inset-bottom, 0px); }
    .bottom-nav-item{ transition: all .15s ease; }
    .bottom-nav-item.active{ color: #9F8CFB; }
    .bottom-nav-item.active .nav-icon{ background: #9F8CFB; color: white; }
    input, select, textarea{ font-size: 16px !important; }
  </style>
</head>
<body class="font-sans text-ink flex flex-col antialiased" style="width: 100vw; overflow-x: hidden; overscroll-behavior: none;">

  <!-- Top Header -->
  <header class="glass-header sticky top-0 z-40 px-4 py-3 flex items-center justify-between" style="padding-top: calc(env(safe-area-inset-top, 0px) + 0.75rem);">
    <div class="flex items-center gap-3">
      <div class="w-9 h-9 bg-gradient-to-br from-nbpurple to-nbpink rounded-xl flex items-center justify-center text-white text-sm">
        <i class="fa-solid fa-shield-halved"></i>
      </div>
      <div>
        <h1 class="font-display text-sm font-bold leading-tight">LENTERA</h1>
        <p class="text-[10px] text-ink/50 font-semibold">Super Admin</p>
      </div>
    </div>
    <a href="/logout" class="w-9 h-9 bg-nbred/10 text-nbred rounded-xl flex items-center justify-center">
      <i class="fa-solid fa-right-from-bracket text-sm"></i>
    </a>
  </header>

  <!-- Main Content -->
  <main class="flex-1 overflow-y-auto px-4 pb-24" style="padding-bottom: calc(env(safe-area-inset-bottom, 0px) + 6rem);">
    <?php if (session()->getFlashdata('success')): ?>
      <div class="mt-3 p-3 bg-nbgreen/10 border border-nbgreen/30 rounded-xl text-xs font-bold text-nbgreen flex items-center gap-2">
        <i class="fa-solid fa-circle-check"></i> <?= session()->getFlashdata('success') ?>
      </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
      <div class="mt-3 p-3 bg-nbred/10 border border-nbred/30 rounded-xl text-xs font-bold text-nbred flex items-center gap-2">
        <i class="fa-solid fa-circle-exclamation"></i> <?= session()->getFlashdata('error') ?>
      </div>
    <?php endif; ?>

    <?= $this->renderSection('content') ?>
  </main>

  <!-- Bottom Navigation -->
  <nav class="fixed bottom-0 left-0 right-0 glass-header z-40 bottom-nav">
    <div class="max-w-md mx-auto flex items-center py-2">
      <a href="/admin" class="bottom-nav-item flex-1 flex flex-col items-center gap-0.5 py-1 <?= (uri_string() === 'admin') ? 'active' : 'text-ink/50' ?>">
        <span class="nav-icon w-8 h-8 rounded-xl flex items-center justify-center text-sm transition">
          <i class="fa-solid fa-gauge"></i>
        </span>
        <span class="text-[10px] font-bold">Home</span>
      </a>
      <a href="/admin/buku" class="bottom-nav-item flex-1 flex flex-col items-center gap-0.5 py-1 <?= (strpos(uri_string(), 'admin/buku') !== false) ? 'active' : 'text-ink/50' ?>">
        <span class="nav-icon w-8 h-8 rounded-xl flex items-center justify-center text-sm transition">
          <i class="fa-solid fa-book"></i>
        </span>
        <span class="text-[10px] font-bold">Buku</span>
      </a>
      <a href="/admin/materi" class="bottom-nav-item flex-1 flex flex-col items-center gap-0.5 py-1 <?= (strpos(uri_string(), 'admin/materi') !== false) ? 'active' : 'text-ink/50' ?>">
        <span class="nav-icon w-8 h-8 rounded-xl flex items-center justify-center text-sm transition">
          <i class="fa-solid fa-file-lines"></i>
        </span>
        <span class="text-[10px] font-bold">Materi</span>
      </a>
      <a href="/admin/tugas" class="bottom-nav-item flex-1 flex flex-col items-center gap-0.5 py-1 <?= (strpos(uri_string(), 'admin/tugas') !== false) ? 'active' : 'text-ink/50' ?>">
        <span class="nav-icon w-8 h-8 rounded-xl flex items-center justify-center text-sm transition">
          <i class="fa-solid fa-clipboard-list"></i>
        </span>
        <span class="text-[10px] font-bold">Tugas</span>
      </a>
    </div>
  </nav>

</body>
</html>
