<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>Dashboard Guru - JELAJAH NUSA</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,200..800&family=Plus+Jakarta+Sans:wght@400;700;800&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/htmx.org@2.0.11/dist/htmx.min.js" integrity="sha384-2OatzQy1H+Zd/IIrjr1TcuDGqLXeHhbooAyJY1KdQMKnr4LZ22k31GBLdYKHmVjg" crossorigin="anonymous"></script>
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
    .nb-pill{ -webkit-backdrop-filter:blur(8px); backdrop-filter:blur(8px); border-radius:999px; font-weight:700; transition:transform .1s ease; }
    .nb-pill:active{ transform:scale(.97); }
    .glass-header{ background-color:rgba(255,255,255,.55); -webkit-backdrop-filter:blur(18px) saturate(170%); backdrop-filter:blur(18px) saturate(170%); border-bottom:1px solid rgba(255,255,255,.8); }
    .bottom-nav{ padding-bottom: env(safe-area-inset-bottom, 0px); }
    .bottom-nav-item{ transition: all .15s ease; }
    .bottom-nav-item.active{ color: #34C98E; }
    .bottom-nav-item.active .nav-icon{ background: #34C98E; color: white; }
    input, select, textarea{ font-size: 16px !important; }

    /* Sidebar Drawer */
    .sidebar-overlay{ position: fixed; inset: 0; background: rgba(0,0,0,.4); z-index: 50; opacity: 0; visibility: hidden; transition: opacity .3s ease, visibility .3s ease; }
    .sidebar-overlay.open{ opacity: 1; visibility: visible; }
    .sidebar-drawer{ position: fixed; top: 0; right: -280px; width: 280px; height: 100dvh; background: white; z-index: 60; transition: right .3s ease; display: flex; flex-direction: column; }
    .sidebar-drawer.open{ right: 0; }
    .sidebar-link{ transition: all .15s ease; }
    .sidebar-link:hover{ background: rgba(45,51,72,.06); }
    .sidebar-link:active{ background: rgba(45,51,72,.1); }
  </style>
</head>
<body class="font-sans text-ink flex flex-col antialiased" style="width: 100vw; overflow-x: hidden; overscroll-behavior: none;">

  <!-- Top Header -->
  <header class="glass-header sticky top-0 z-40 px-4 py-3 flex items-center justify-between" style="padding-top: calc(env(safe-area-inset-top, 0px) + 0.75rem);">
    <div class="flex items-center gap-3">
      <div class="w-9 h-9 bg-gradient-to-br from-nbscarlet to-nbtruered rounded-xl flex items-center justify-center text-white text-sm">
        <i class="fa-solid fa-compass"></i>
      </div>
      <div>
        <h1 class="font-display text-sm font-bold leading-tight">JELAJAH NUSA</h1>
        <p class="text-[10px] text-ink/50 font-semibold">Dashboard Guru</p>
      </div>
    </div>
    <div class="flex items-center gap-3">
      <div class="text-right">
        <p class="text-xs font-bold leading-tight"><?= session()->get('user_name') ?? 'Guru' ?></p>
        <p class="text-[10px] text-ink/50">Guru</p>
      </div>
    </div>
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

    <div id="guru-content">
      <?= $this->renderSection('content') ?>
    </div>
  </main>

  <!-- Bottom Navigation -->
  <nav class="fixed bottom-0 left-0 right-0 glass-header z-40 bottom-nav">
    <div class="max-w-md mx-auto flex items-center py-2">
      <button hx-get="/guru" 
          hx-push-url="/guru"
          hx-swap="innerHTML show:top"
          hx-target="#guru-content" 
          class="bottom-nav-item flex-1 flex flex-col items-center gap-0.5 py-1 <?= (uri_string() === 'guru') ? 'active' : 'text-ink/50' ?>">
        <span class="nav-icon w-8 h-8 rounded-xl flex items-center justify-center text-sm transition">
          <i class="fa-solid fa-gauge"></i>
        </span>
        <span class="text-[10px] font-bold">Home</span>
      </button>
      <button hx-get="/guru/kelas" 
          hx-push-url="/guru/kelas"
          hx-swap="innerHTML show:top"
          hx-target="#guru-content" 
          class="bottom-nav-item flex-1 flex flex-col items-center gap-0.5 py-1 <?= (strpos(uri_string(), 'kelas') !== false) ? 'active' : 'text-ink/50' ?>">
        <span class="nav-icon w-8 h-8 rounded-xl flex items-center justify-center text-sm transition">
          <i class="fa-solid fa-users"></i>
        </span>
        <span class="text-[10px] font-bold">Kelas</span>
      </button>
      <button hx-get="/guru/kategori" 
          hx-push-url="/guru/kategori"
          hx-swap="innerHTML show:top"
          hx-target="#guru-content" 
          class="bottom-nav-item flex-1 flex flex-col items-center gap-0.5 py-1 <?= (strpos(uri_string(), 'kategori') !== false || strpos(uri_string(), 'buku') !== false || strpos(uri_string(), 'materi') !== false || strpos(uri_string(), 'tugas') !== false) ? 'active' : 'text-ink/50' ?>">
        <span class="nav-icon w-8 h-8 rounded-xl flex items-center justify-center text-sm transition">
          <i class="fa-solid fa-book-open"></i>
        </span>
        <span class="text-[10px] font-bold">Pelajaran</span>
      </button>
      <button hx-get="/guru/pengaturan" 
          hx-push-url="/guru/pengaturan"
          hx-swap="innerHTML show:top"
          hx-target="#guru-content" 
          class="bottom-nav-item flex-1 flex flex-col items-center gap-0.5 py-1 <?= (strpos(uri_string(), 'pengaturan') !== false) ? 'active' : 'text-ink/50' ?>">
        <span class="nav-icon w-8 h-8 rounded-xl flex items-center justify-center text-sm transition">
          <i class="fa-solid fa-gear"></i>
        </span>
        <span class="text-[10px] font-bold">Pengaturan</span>
      </button>
      <button onclick="openSidebar()" class="bottom-nav-item flex-1 flex flex-col items-center gap-0.5 py-1 text-ink/50">
        <span class="nav-icon w-8 h-8 rounded-xl flex items-center justify-center text-sm transition">
          <i class="fa-solid fa-bars"></i>
        </span>
        <span class="text-[10px] font-bold">Menu</span>
      </button>
    </div>
  </nav>

  <!-- Sidebar Overlay -->
  <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

  <!-- Sidebar Drawer -->
  <aside id="sidebarDrawer" class="sidebar-drawer">
    <div class="p-4 flex items-center justify-between border-b border-ink/10" style="padding-top: calc(env(safe-area-inset-top, 0px) + 1rem);">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 bg-gradient-to-br from-nbscarlet to-nbtruered rounded-xl flex items-center justify-center text-white">
          <i class="fa-solid fa-compass"></i>
        </div>
        <div>
          <h2 class="font-display text-sm font-bold">JELAJAH NUSA</h2>
          <p class="text-[10px] text-ink/50">Menu Guru</p>
        </div>
      </div>
      <button onclick="closeSidebar()" class="w-9 h-9 bg-ink/10 rounded-xl flex items-center justify-center">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <div class="flex-1 overflow-y-auto p-3 space-y-1">
      <!-- User Info -->
      <div class="nb-card p-3 mb-3 flex items-center gap-3">
        <div class="w-10 h-10 bg-nbgreen rounded-xl flex items-center justify-center text-white font-bold text-sm">
          <?= strtoupper(substr(session()->get('user_name') ?? 'G', 0, 1)) ?>
        </div>
        <div>
          <p class="text-sm font-bold"><?= session()->get('user_name') ?? 'Guru' ?></p>
          <p class="text-[10px] text-ink/50">Guru</p>
        </div>
      </div>

      <!-- DATA Group -->
      <p class="text-[10px] font-extrabold text-ink/40 uppercase tracking-wider px-3 py-2">Data</p>
      <a hx-get="/guru/murid" 
          hx-push-url="/guru/murid"
          hx-swap="innerHTML show:top"
          hx-target="#guru-content"  class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold text-ink/70">
        <span class="w-8 h-8 bg-nbblue/15 text-nbblue rounded-lg flex items-center justify-center">
          <i class="fa-solid fa-users text-xs"></i>
        </span>
        Murid
      </a>
      <a hx-get="/guru/buku" 
          hx-push-url="/guru/buku"
          hx-swap="innerHTML show:top"
          hx-target="#guru-content"  class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold text-ink/70">
        <span class="w-8 h-8 bg-nbgreen/15 text-nbgreen rounded-lg flex items-center justify-center">
          <i class="fa-solid fa-book text-xs"></i>
        </span>
        Buku
      </a>
      <a hx-get="/guru/tugas" 
          hx-push-url="/guru/tugas"
          hx-swap="innerHTML show:top"
          hx-target="#guru-content"  class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold text-ink/70">
        <span class="w-8 h-8 bg-nbpurple/15 text-nbpurple rounded-lg flex items-center justify-center">
          <i class="fa-solid fa-clipboard-list text-xs"></i>
        </span>
        Tugas
      </a>

      <!-- PENILAIAN Group -->
      <p class="text-[10px] font-extrabold text-ink/40 uppercase tracking-wider px-3 py-2 mt-2">Penilaian</p>
      <a hx-get="/guru/nilai" 
          hx-push-url="/guru/nilai"
          hx-swap="innerHTML show:top"
          hx-target="#guru-content"  class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold text-ink/70">
        <span class="w-8 h-8 bg-nbyellow/15 text-nborange rounded-lg flex items-center justify-center">
          <i class="fa-solid fa-star text-xs"></i>
        </span>
        Nilai
      </a>

      <!-- LAINNYA Group -->
      <p class="text-[10px] font-extrabold text-ink/40 uppercase tracking-wider px-3 py-2 mt-2">Lainnya</p>
      <a href="/logout" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold text-nbred">
        <span class="w-8 h-8 bg-nbred/10 text-nbred rounded-lg flex items-center justify-center">
          <i class="fa-solid fa-right-from-bracket text-xs"></i>
        </span>
        Logout
      </a>
    </div>
  </aside>

  <script>
    function openSidebar() {
      document.getElementById('sidebarOverlay').classList.add('open');
      document.getElementById('sidebarDrawer').classList.add('open');
      document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
      document.getElementById('sidebarOverlay').classList.remove('open');
      document.getElementById('sidebarDrawer').classList.remove('open');
      document.body.style.overflow = '';
    }

    function updateActiveNavItem() {
      const navItems = document.querySelectorAll('.bottom-nav-item');
      navItems.forEach(item => {
        item.classList.remove('active')
        item.classList.remove('text-ink/50')
        item.classList.add('text-ink/50')
      });

      const currentPath = window.location.pathname;
      if (currentPath === '/guru') {
        navItems[0].classList.add('active');
      } else if (currentPath.startsWith('/guru/kelas') || currentPath.startsWith('/guru/murid') || currentPath.startsWith('/guru/nilai')) {
        navItems[1].classList.add('active');
      } else if (currentPath.startsWith('/guru/kategori') || currentPath.startsWith('/guru/buku') || currentPath.startsWith('/guru/materi') || currentPath.startsWith('/guru/tugas') || currentPath.startsWith('/guru/book-store')) {
        navItems[2].classList.add('active');
      } else if (currentPath.startsWith('/guru/pengaturan')) {
        navItems[3].classList.add('active');
      } else {
        navItems[4].classList.add('active');
      }
    }

    // Update active nav after htmx pushState (URL already updated)
    document.body.addEventListener('htmx:pushedIntoHistory', updateActiveNavItem);

    // Also update when content swaps (history restore, forms, etc.)
    document.body.addEventListener('htmx:afterSwap', function (evt) {
      console.log('htmx:afterSwap event triggered:', evt.detail.target);
      if (evt.detail.target && evt.detail.target.id === 'guru-content') {
        updateActiveNavItem();
        closeSidebar()
      }
    });

    document.addEventListener('DOMContentLoaded', updateActiveNavItem);
  </script>

</body>
</html>
