<div id="view-home" class="space-y-4">
  <div class="bg-gradient-to-br from-nbblue to-nbpurple nb-card p-5 text-white">
    <p class="text-xs font-semibold opacity-90">Selamat datang,</p>
    <h2 class="font-display text-xl font-bold leading-tight" id="homeGreeting"><?= esc($profile['name'] ?? 'Siswa') ?> 👋</h2>
    <p class="text-xs mt-2 leading-relaxed font-semibold opacity-95">Baca, nonton, main game, lalu kerjakan ujian untuk mendapat Piagam Penghargaan!</p>
  </div>
  <div class="grid grid-cols-3 gap-3">
    <div class="nb-card !rounded-2xl p-3 text-center">
      <i class="fa-solid fa-star text-nbyellow text-lg"></i>
      <p class="font-display text-lg font-bold" id="homeStars"><?= esc($profile['stats']['stars'] ?? 0) ?></p>
      <p class="text-[11px] font-semibold text-ink/50">Bintang</p>
    </div>
    <div class="nb-card !rounded-2xl p-3 text-center">
      <i class="fa-solid fa-map-location-dot text-nbgreen text-lg"></i>
      <p class="font-display text-lg font-bold" id="homeMissions"><?= esc($profile['stats']['missions'] ?? 0) ?></p>
      <p class="text-[11px] font-semibold text-ink/50">Misi</p>
    </div>
    <div class="nb-card !rounded-2xl p-3 text-center">
      <i class="fa-solid fa-chart-line text-nbblue text-lg"></i>
      <p class="font-display text-lg font-bold" id="homeAvg"><?= esc($profile['stats']['average'] ?? 92) ?></p>
      <p class="text-[11px] font-semibold text-ink/50">Rata-rata</p>
    </div>
  </div>
  <div>
    <h3 class="font-display text-base font-bold mb-2">Lanjutkan Belajar</h3>
    <div class="nb-card p-4 space-y-3">
      <span id="homeContBab" class="text-[11px] font-extrabold bg-nbgreen text-white nb-pill px-2.5 py-1 inline-block">Bab <?= esc($profile['latest_progress']['mission']['chapter'] ?? 'Bab 1') ?></span>
      <h4 id="homeContTitle" class="font-display font-bold text-sm leading-snug"><?= esc($profile['latest_progress']['mission']['title'] ?? 'Judul') ?></h4>
      <button onclick="openChapter(currentChapter.id)" class="w-full py-2.5 bg-nbgreen text-white nb-btn text-xs">Lanjutkan <i class="fa-solid fa-arrow-right ml-1"></i></button>
    </div>
  </div>
  <button hx-get="/htmx/missions" 
    hx-push-url="/missions"
    hx-swap="innerHTML show:top"
    hx-target="#mainScroll"
    onclick="setActiveNav('missions')" 
    class="w-full py-3 nb-card !rounded-2xl text-sm font-bold text-ink">
    <i class="fa-solid fa-map mr-1 text-nbgreen"></i> Lihat Semua Misi
  </button>
</div>