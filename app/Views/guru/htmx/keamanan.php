<div class="mt-4 mb-4 flex items-center gap-3">
  <button hx-get="/guru/pengaturan" hx-push-url="/guru/pengaturan" hx-swap="innerHTML show:top" hx-target="#guru-content" class="w-9 h-9 bg-ink/10 rounded-xl flex items-center justify-center">
    <i class="fa-solid fa-arrow-left"></i>
  </button>
  <div>
    <h2 class="font-display text-xl font-bold">Keamanan</h2>
    <p class="text-sm text-ink/60">Ganti password akun Anda</p>
  </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
  <div class="nb-card p-3 mb-4 text-sm font-bold text-nbgreen">
    <i class="fa-solid fa-circle-check mr-1"></i> <?= session()->getFlashdata('success') ?>
  </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
  <div class="nb-card p-3 mb-4 text-sm font-bold text-nbred">
    <i class="fa-solid fa-circle-exclamation mr-1"></i> <?= session()->getFlashdata('error') ?>
  </div>
<?php endif; ?>

<div class="nb-card p-4">
  <h3 class="font-display text-base font-bold mb-3"><i class="fa-solid fa-lock mr-1 text-nbpurple"></i> Ganti Password</h3>
  <form action="/guru/pengaturan/keamanan" method="post" class="space-y-4">
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Password Lama</label>
      <input type="password" name="current_password" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Password Baru</label>
      <input type="password" name="new_password" required minlength="6" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Konfirmasi Password Baru</label>
      <input type="password" name="confirm_password" required minlength="6" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
    <button type="submit" class="w-full py-3.5 bg-nbpurple text-white rounded-xl text-sm font-bold nb-btn">
      Ubah Password
    </button>
  </form>
</div>
