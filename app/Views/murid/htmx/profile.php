<div id="view-profile" class=" space-y-4">
  <div class="nb-card p-5 text-center space-y-3">
    <div class="w-20 h-20 mx-auto bg-nbpurple/20 rounded-full flex items-center justify-center text-3xl text-nbpurple">
      <i class="fa-solid fa-user-astronaut"></i>
    </div>
    <div>
      <label for="studentNameInput" class="text-[11px] font-extrabold uppercase text-ink/50 block mb-1">Nama Ksatria</label>
      <input type="text" id="studentNameInput" value="<?= esc($profile['name'] ?? 'Siswa') ?>" readonly disabled class="w-full text-center bg-white/50 nb-border rounded-xl px-3 py-2 text-sm font-bold focus:outline-none focus:border-nbblue">
    </div>
    <p class="text-xs text-ink/60 font-semibold">Siswa Kelas <?= esc($profile['class'] ?? '-') ?></p>
  </div>
  <div class="nb-card p-4 text-xs text-ink/60 space-y-1 text-center">
    <p class="font-bold text-ink/80">LENTERA &copy; 2026</p>
    <p>Aplikasi Edukasi Integratif &bull; Kurikulum Merdeka</p>
  </div>
  <a href="/murid/logout" class="block w-full py-3 bg-white/70 text-nbred nb-btn text-sm text-center"><i class="fa-solid fa-right-from-bracket mr-1"></i> Keluar</a>
</div>