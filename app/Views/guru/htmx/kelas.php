<div class="mt-4 mb-4">
  <h2 class="font-display text-xl font-bold">Data Kelas</h2>
  <p class="text-sm text-ink/60">Kelola kelas yang Anda ampu</p>
</div>

<!-- Class List -->
<div class="space-y-3">
  <?php if (empty($classes)): ?>
    <div class="nb-card p-8 text-center text-ink/40 text-sm">
      <i class="fa-solid fa-users text-3xl mb-2"></i>
      <p>Belum ada kelas. Tambahkan murid untuk membuat kelas.</p>
    </div>
  <?php else: ?>
    <?php foreach ($classes as $class => $count): ?>
      <div class="nb-card p-4">
        <div class="flex items-center gap-3">
          <div class="w-11 h-11 bg-nbblue/15 text-nbblue rounded-xl flex items-center justify-center shrink-0">
            <i class="fa-solid fa-users text-lg"></i>
          </div>
          <div class="flex-1">
            <p class="text-sm font-bold">Kelas <?= esc($class) ?></p>
            <p class="text-[11px] text-ink/50"><?= $count ?> murid</p>
          </div>
          <a href="/guru/murid?class=<?= urlencode($class) ?>" class="px-3 py-2 bg-nbblue text-white rounded-xl text-xs font-bold nb-btn">
            Lihat
          </a>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>