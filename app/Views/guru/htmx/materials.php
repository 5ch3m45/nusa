<div class="mt-4 mb-4">
  <h2 class="font-display text-xl font-bold">Data Materi</h2>
  <p class="text-sm text-ink/60">Kelola materi pembelajaran</p>
</div>

<!-- Filter -->
<div class="flex gap-2 overflow-x-auto pb-1 mb-4">
  <a hx-get="/guru/materi" hx-push-url="/guru/materi" hx-swap="innerHTML show:top" hx-target="#guru-content" class="px-3 py-1.5 rounded-full text-xs font-bold whitespace-nowrap cursor-pointer <?= empty($class) && empty($subject) ? 'bg-ink text-white' : 'bg-white/50 text-ink/60 nb-border' ?>">Semua</a>
  <?php foreach ($classes as $c): ?>
    <a hx-get="/guru/materi?class=<?= urlencode($c) ?>" hx-push-url="/guru/materi?class=<?= urlencode($c) ?>" hx-swap="innerHTML show:top" hx-target="#guru-content" class="px-3 py-1.5 rounded-full text-xs font-bold whitespace-nowrap cursor-pointer <?= ($class ?? '') === $c ? 'bg-ink text-white' : 'bg-white/50 text-ink/60 nb-border' ?>"><?= esc($c) ?></a>
  <?php endforeach; ?>
  <?php foreach ($subjects as $s): ?>
    <a hx-get="/guru/materi?subject=<?= urlencode($s) ?>" hx-push-url="/guru/materi?subject=<?= urlencode($s) ?>" hx-swap="innerHTML show:top" hx-target="#guru-content" class="px-3 py-1.5 rounded-full text-xs font-bold whitespace-nowrap cursor-pointer <?= ($subject ?? '') === $s ? 'bg-ink text-white' : 'bg-white/50 text-ink/60 nb-border' ?>"><?= esc($s) ?></a>
  <?php endforeach; ?>
</div>

<!-- Material List -->
<div class="space-y-3">
  <?php if (empty($materials)): ?>
    <div class="nb-card p-8 text-center text-ink/40 text-sm">
      <i class="fa-solid fa-file-lines text-3xl mb-2"></i>
      <p>Tidak ada materi ditemukan.</p>
    </div>
  <?php else: ?>
    <?php foreach ($materials as $m): ?>
      <div class="nb-card p-4">
        <div class="flex items-start gap-3">
          <div class="w-11 h-11 bg-nborange/15 text-nborange rounded-xl flex items-center justify-center shrink-0">
            <i class="fa-solid fa-file-lines text-lg"></i>
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-sm font-bold truncate"><?= esc($m['title']) ?></p>
            <p class="text-[11px] text-ink/50"><?= esc($m['subject']) ?> • <?= esc($m['chapter']) ?></p>
            <p class="text-[11px] text-ink/50">Kelas <?= esc($m['class']) ?> • Semester <?= esc($m['semester']) ?></p>
            <?php if (!empty($m['book_title'])): ?>
              <p class="text-[11px] text-nbblue font-semibold mt-1">
                <i class="fa-solid fa-book mr-1"></i><?= esc($m['book_title']) ?>
              </p>
            <?php endif; ?>
          </div>
          <div class="flex gap-2 shrink-0">
            <button hx-get="/guru/materi/edit/<?= $m['id'] ?>" hx-push-url="/guru/materi/edit/<?= $m['id'] ?>" hx-swap="innerHTML show:top" hx-target="#guru-content" class="w-9 h-9 bg-nbblue/10 text-nbblue rounded-xl flex items-center justify-center active:bg-nbblue active:text-white transition">
              <i class="fa-solid fa-pen text-xs"></i>
            </button>
            <a href="/guru/materi/delete/<?= $m['id'] ?>" onclick="return confirm('Hapus materi ini?')" class="w-9 h-9 bg-nbred/10 text-nbred rounded-xl flex items-center justify-center active:bg-nbred active:text-white transition">
              <i class="fa-solid fa-trash text-xs"></i>
            </a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<!-- FAB -->
<button hx-get="/guru/materi/add" hx-push-url="/guru/materi/add" hx-swap="innerHTML show:top" hx-target="#guru-content" class="fixed right-4 w-14 h-14 bg-nbgreen text-white rounded-2xl shadow-nblg flex items-center justify-center text-xl z-30 active:scale-90 transition" style="bottom: calc(env(safe-area-inset-bottom, 0px) + 6rem);">
  <i class="fa-solid fa-file-circle-plus"></i>
</button>

