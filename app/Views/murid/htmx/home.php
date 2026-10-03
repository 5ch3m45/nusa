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
  <div id="continueLearning">
    <h3 class="font-display text-base font-bold mb-2">Lanjutkan Belajar</h3>
    <div class="nb-card p-4 space-y-3">
      <?php if (!empty($profile['latest_progress'])): ?>
        <?php $lp = $profile['latest_progress']; ?>
        <span id="homeContBab" class="text-[11px] font-extrabold <?= $lp['is_done'] ? 'bg-ink/20 text-ink/70' : 'bg-nbgreen text-white' ?> nb-pill px-2.5 py-1 inline-block"><?= esc($lp['material']['chapter'] ?? 'Bab 1') ?></span>
        <h4 id="homeContTitle" class="font-display font-bold text-sm leading-snug"><?= esc($lp['material']['title'] ?? '') ?></h4>
        <p class="text-[11px] font-semibold text-ink/50">
          <?php if ($lp['is_done']): ?>
            <i class="fa-solid fa-circle-check text-nbgreen mr-1"></i>Selesai<?= !empty($lp['done_at']) ? ' · ' . esc(date('d M Y', strtotime($lp['done_at']))) : '' ?><?= ($lp['score'] ?? null) !== null ? ' · Nilai ' . esc($lp['score']) : '' ?>
          <?php else: ?>
            <i class="fa-solid fa-book-open text-nbblue mr-1"></i>Sedang dipelajari<?= !empty($lp['started_at']) ? ' · mulai ' . esc(date('d M Y', strtotime($lp['started_at']))) : '' ?>
          <?php endif; ?>
        </p>
        <a href="/murid/missions" class="w-full py-2.5 bg-nbgreen text-white nb-btn text-xs text-center block">Lanjutkan <i class="fa-solid fa-arrow-right ml-1"></i></a>
      <?php else: ?>
        <p class="text-xs text-ink/50 font-semibold">Belum ada materi yang dipelajari.</p>
        <a href="/murid/missions" class="w-full py-2.5 bg-nbgreen text-white nb-btn text-xs text-center block">Mulai Belajar <i class="fa-solid fa-arrow-right ml-1"></i></a>
      <?php endif; ?>
    </div>
  </div>
  <button hx-get="/murid/htmx/missions" 
    hx-push-url="/murid/missions"
    hx-swap="innerHTML show:top"
    hx-target="#mainScroll"
    onclick="setActiveNav('missions')" 
    class="w-full py-3 nb-card !rounded-2xl text-sm font-bold text-ink">
    <i class="fa-solid fa-map mr-1 text-nbgreen"></i> Lihat Semua Misi
  </button>
</div>