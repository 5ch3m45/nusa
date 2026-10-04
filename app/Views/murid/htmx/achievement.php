<div id="view-achievements" class=" space-y-4">
  <h3 class="font-display text-base font-bold">🏆 Prestasi Saya</h3>
  <div class="grid grid-cols-2 gap-3">
    <div class="nb-card p-4 flex items-center gap-3">
      <div class="w-12 h-12 bg-nbyellow/30 rounded-2xl flex items-center justify-center text-xl text-nborange"><i class="fa-solid fa-star"></i></div>
      <div>
        <p class="text-[11px] font-semibold text-ink/50">Total Bintang</p>
        <p class="font-display text-xl font-bold" id="achStars"><?= $totalStars ?? 0 ?></p>
      </div>
    </div>
    <div class="nb-card p-4 flex items-center gap-3">
      <div class="w-12 h-12 bg-nbgreen/20 rounded-2xl flex items-center justify-center text-xl text-nbgreen"><i class="fa-solid fa-chart-simple"></i></div>
      <div>
        <p class="text-[11px] font-semibold text-ink/50">Rata-rata</p>
        <p class="font-display text-xl font-bold"><?= $averageScore ?? 0 ?></p>
      </div>
    </div>
  </div>

  <div>
    <h4 class="font-display text-sm font-bold mb-2">🎓 Piagam Saya</h4>
    <?php if (empty($certificates)): ?>
      <div class="nb-card p-8 text-center text-ink/40 text-sm">
        <i class="fa-solid fa-certificate text-3xl mb-2"></i>
        <p>Belum ada piagam. Selesaikan tugas dan tunggu penilaian guru.</p>
      </div>
    <?php else: ?>
      <div class="space-y-3">
        <?php foreach ($certificates as $c): ?>
          <div class="nb-card p-4">
            <p class="text-sm font-bold truncate"><?= esc($c['assignment_title']) ?></p>
            <p class="text-[11px] text-ink/50"><?= esc($c['subject'] ?? '') ?><?= !empty($c['material_title']) ? ' • ' . esc($c['material_title']) : '' ?></p>
            <p class="text-[11px] text-nbgreen font-semibold mt-1"><i class="fa-solid fa-star mr-1"></i>Nilai: <?= esc($c['score']) ?></p>
            <a href="/murid/sertifikat/<?= $c['id'] ?>" target="_blank" class="block w-full py-2.5 mt-2 bg-nbyellow text-ink rounded-xl text-[11px] font-bold text-center nb-btn">
              <i class="fa-solid fa-download mr-1"></i> Unduh Piagam PDF
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
