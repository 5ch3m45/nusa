<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
  <div id="loginView" class="absolute inset-0 z-50 bg-gradient-to-b from-[#EAF2FF] via-[#F4F0FF] to-[#FFF1F6] flex flex-col overflow-y-auto overflow-x-hidden">
    <div class="absolute -z-10 top-40 -left-16 w-60 h-60 rounded-full bg-nbpink/35 blur-3xl pointer-events-none"></div>
    <div class="absolute -z-10 bottom-10 -right-16 w-64 h-64 rounded-full bg-nbyellow/45 blur-3xl pointer-events-none"></div>
    <div class="absolute -z-10 top-1/2 left-1/3 w-52 h-52 rounded-full bg-nbblue/35 blur-3xl pointer-events-none"></div>
    <div class="bg-gradient-to-br from-nbscarlet to-nbtruered text-white text-center px-6 pb-14 shrink-0" style="padding-top:calc(env(safe-area-inset-top,0px) + 2.5rem);">
      <div class="w-20 h-20 mx-auto bg-white rounded-3xl flex items-center justify-center text-4xl shadow-nb text-nbscarlet">
        <i class="fa-solid fa-compass"></i>
      </div>
      <h1 class="font-display text-2xl font-bold tracking-wide mt-4">JELAJAH NUSA</h1>
      <p class="text-xs font-semibold opacity-90 mt-1">Petualangan Bahasa &amp; IPAS &bull; Kelas 4</p>
    </div>
    <div class="flex-1 glass !border-b-0 -mt-8 rounded-t-[2rem] px-6 pt-7 space-y-4" style="padding-bottom:calc(env(safe-area-inset-bottom,0px) + 1.5rem);">
      <div>
        <h2 class="font-display text-lg font-bold">Halo, Ksatria! 👋</h2>
        <p class="text-xs text-ink/60 font-semibold">Masuk dulu untuk mulai petualanganmu.</p>
      </div>
      <form class="space-y-3">
        <div>
          <label for="loginName" class="text-[11px] font-extrabold text-ink/60 block mb-1">Nama</label>
          <div class="relative">
            <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-ink/30"></i>
            <input type="text" id="loginName" placeholder="Tulis namamu" autocomplete="off" onkeydown="if(event.key==='Enter')doLogin()" class="w-full bg-white/50 nb-border rounded-xl pl-11 pr-4 py-3 text-base focus:outline-none focus:border-nbblue">
          </div>
        </div>
        <div>
          <label for="loginPin" class="text-[11px] font-extrabold text-ink/60 block mb-1">PIN (4 angka)</label>
          <div class="relative">
            <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-ink/30"></i>
            <input type="password" id="loginPin" placeholder="&bull;&bull;&bull;&bull;" inputmode="numeric" maxlength="4" autocomplete="off" onkeydown="if(event.key==='Enter')doLogin()" class="w-full bg-white/50 nb-border rounded-xl pl-11 pr-4 py-3 text-base tracking-[.4em] focus:outline-none focus:border-nbblue">
          </div>
        </div>
        <p id="loginError" class="text-xs font-bold text-nbred min-h-[1rem]"></p>
      </form>
      <div class="space-y-2.5">
        <button onclick="doLogin()" class="w-full py-3 bg-nbscarlet text-white nb-btn text-sm">Masuk sebagai Murid <i class="fa-solid fa-arrow-right ml-1"></i></button>
        <button onclick="loginAsGuest()" class="w-full py-3 bg-cream text-ink/70 nb-btn text-sm">Masuk sebagai Orang Tua</button>
      </div>
      <p class="text-[11px] text-ink/40 text-center font-semibold">Masuk sebagai Guru</p>
    </div>
  </div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
  function doLogin() {
    // const name = document.getElementById('loginName').value.trim();
    // const pin = document.getElementById('loginPin').value.trim();
    // const err = document.getElementById('loginError');
    // err.innerText = '';
    // if (!name) { err.innerText = 'Tulis namamu dulu ya!'; return; }
    // if (!/^\d{4}$/.test(pin)) { err.innerText = 'PIN harus 4 angka.'; return; }
    // const users = getUsers();
    // const key = name.toLowerCase();
    // if (users[key] !== undefined && users[key] !== pin) { err.innerText = 'PIN salah, coba lagi ya.'; return; }
    // if (users[key] === undefined) {
    //   users[key] = pin;
    //   LS.set('jn_users', JSON.stringify(users));
    // }
    // startSession(name, false);
    // LS.set('jn_session', name);
    window.location.href = '/';
  }
</script>
<?= $this->endSection() ?>