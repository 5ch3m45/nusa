<div class="mt-4 mb-4">
  <h2 class="font-display text-xl font-bold">Pengaturan</h2>
  <p class="text-sm text-ink/60">Kelola akun dan preferensi Anda</p>
</div>

<!-- Profile Card -->
<div class="nb-card p-4 mb-4">
  <div class="flex items-center gap-3 mb-4">
    <div class="w-14 h-14 bg-nbgreen rounded-2xl flex items-center justify-center text-white font-bold text-xl">
      <?= strtoupper(substr(session()->get('user_name') ?? 'G', 0, 1)) ?>
    </div>
    <div>
      <p class="text-base font-bold"><?= session()->get('user_name') ?? 'Guru' ?></p>
      <p class="text-xs text-ink/50"><?= session()->get('user_email') ?? '-' ?></p>
    </div>
  </div>
</div>

<!-- Settings List -->
<div class="space-y-3">
  <button hx-get="/guru/pengaturan/profile" hx-push-url="/guru/pengaturan/profile" hx-swap="innerHTML show:top" hx-target="#guru-content" class="nb-card p-4 flex items-center gap-3 w-full text-left">
    <div class="w-10 h-10 bg-nbblue/15 text-nbblue rounded-xl flex items-center justify-center shrink-0">
      <i class="fa-solid fa-user"></i>
    </div>
    <div class="flex-1">
      <p class="text-sm font-bold">Profil</p>
      <p class="text-[11px] text-ink/50">Nama, email, dan informasi akun</p>
    </div>
    <i class="fa-solid fa-chevron-right text-ink/30 text-xs"></i>
  </button>

  <button hx-get="/guru/pengaturan/keamanan" hx-push-url="/guru/pengaturan/keamanan" hx-swap="innerHTML show:top" hx-target="#guru-content" class="nb-card p-4 flex items-center gap-3 w-full text-left">
    <div class="w-10 h-10 bg-nbpurple/15 text-nbpurple rounded-xl flex items-center justify-center shrink-0">
      <i class="fa-solid fa-lock"></i>
    </div>
    <div class="flex-1">
      <p class="text-sm font-bold">Keamanan</p>
      <p class="text-[11px] text-ink/50">Ganti password dan keamanan akun</p>
    </div>
    <i class="fa-solid fa-chevron-right text-ink/30 text-xs"></i>
  </button>

  <div class="nb-card p-4 flex items-center gap-3">
    <div class="w-10 h-10 bg-nbgreen/15 text-nbgreen rounded-xl flex items-center justify-center shrink-0">
      <i class="fa-solid fa-bell"></i>
    </div>
    <div class="flex-1">
      <p class="text-sm font-bold">Notifikasi</p>
      <p class="text-[11px] text-ink/50">Pengaturan notifikasi aplikasi</p>
    </div>
    <i class="fa-solid fa-chevron-right text-ink/30 text-xs"></i>
  </div>

  <div class="nb-card p-4 flex items-center gap-3">
    <div class="w-10 h-10 bg-nborange/15 text-nborange rounded-xl flex items-center justify-center shrink-0">
      <i class="fa-solid fa-circle-info"></i>
    </div>
    <div class="flex-1">
      <p class="text-sm font-bold">Tentang</p>
      <p class="text-[11px] text-ink/50">Versi aplikasi dan informasi</p>
    </div>
    <i class="fa-solid fa-chevron-right text-ink/30 text-xs"></i>
  </div>
</div>

<!-- Logout Button -->
<a href="/logout" class="block w-full mt-6 py-3.5 bg-nbred/10 text-nbred rounded-xl text-sm font-bold text-center nb-btn">
  <i class="fa-solid fa-right-from-bracket mr-1"></i> Logout
</a>