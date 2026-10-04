<div class="mt-4 mb-4">
  <h2 class="font-display text-xl font-bold">Data Tugas</h2>
  <p class="text-sm text-ink/60">Kelola tugas untuk murid</p>
</div>

<!-- Filter -->
<div class="flex gap-2 overflow-x-auto pb-1 mb-4">
  <a hx-get="/guru/tugas" hx-push-url="/guru/tugas" hx-swap="innerHTML show:top" hx-target="#guru-content" class="px-3 py-1.5 rounded-full text-xs font-bold whitespace-nowrap cursor-pointer <?= empty($class) && empty($subject) ? 'bg-ink text-white' : 'bg-white/50 text-ink/60 nb-border' ?>">Semua</a>
  <?php foreach ($classes as $c): ?>
    <a hx-get="/guru/tugas?class=<?= urlencode($c) ?>" hx-push-url="/guru/tugas?class=<?= urlencode($c) ?>" hx-swap="innerHTML show:top" hx-target="#guru-content" class="px-3 py-1.5 rounded-full text-xs font-bold whitespace-nowrap cursor-pointer <?= ($class ?? '') === $c ? 'bg-ink text-white' : 'bg-white/50 text-ink/60 nb-border' ?>"><?= esc($c) ?></a>
  <?php endforeach; ?>
  <?php foreach ($subjects as $s): ?>
    <a hx-get="/guru/tugas?subject=<?= urlencode($s) ?>" hx-push-url="/guru/tugas?subject=<?= urlencode($s) ?>" hx-swap="innerHTML show:top" hx-target="#guru-content" class="px-3 py-1.5 rounded-full text-xs font-bold whitespace-nowrap cursor-pointer <?= ($subject ?? '') === $s ? 'bg-ink text-white' : 'bg-white/50 text-ink/60 nb-border' ?>"><?= esc($s) ?></a>
  <?php endforeach; ?>
</div>

<!-- Assignment List -->
<div class="space-y-3">
  <?php if (empty($assignments)): ?>
    <div class="nb-card p-8 text-center text-ink/40 text-sm">
      <i class="fa-solid fa-clipboard-list text-3xl mb-2"></i>
      <p>Tidak ada tugas ditemukan.</p>
    </div>
  <?php else: ?>
    <?php foreach ($assignments as $a): ?>
      <div class="nb-card p-4">
        <div class="flex items-start gap-3">
          <div class="w-11 h-11 bg-nbpurple/15 text-nbpurple rounded-xl flex items-center justify-center shrink-0">
            <i class="fa-solid fa-clipboard-list text-lg"></i>
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-sm font-bold truncate"><?= esc($a['title']) ?></p>
            <p class="text-[11px] text-ink/50"><?= esc($a['subject']) ?> • Kelas <?= esc($a['class']) ?> • Semester <?= esc($a['semester']) ?></p>
            <p class="text-[11px] text-nbred font-semibold"><i class="fa-solid fa-calendar mr-1"></i>Deadline: <?= date('d M Y', strtotime($a['due_date'])) ?></p>
            <?php if (!empty($a['book_title'])): ?>
              <p class="text-[11px] text-nbblue font-semibold mt-1">
                <i class="fa-solid fa-book mr-1"></i><?= esc($a['book_title']) ?>
              </p>
            <?php endif; ?>
            <?php if (!empty($a['material_title'])): ?>
              <p class="text-[11px] text-nbgreen font-semibold mt-0.5">
                <i class="fa-solid fa-file-lines mr-1"></i><?= esc($a['material_title']) ?>
              </p>
            <?php endif; ?>
          </div>
          <div class="flex gap-2 shrink-0">
            <button hx-get="/guru/tugas/edit/<?= $a['id'] ?>" hx-push-url="/guru/tugas/edit/<?= $a['id'] ?>" hx-swap="innerHTML show:top" hx-target="#guru-content" class="w-9 h-9 bg-nbblue/10 text-nbblue rounded-xl flex items-center justify-center active:bg-nbblue active:text-white transition">
              <i class="fa-solid fa-pen text-xs"></i>
            </button>
            <button hx-get="/guru/tugas/<?= $a['id'] ?>/submissions" hx-push-url="/guru/tugas/<?= $a['id'] ?>/submissions" hx-swap="innerHTML show:top" hx-target="#guru-content" class="w-9 h-9 bg-nborange/10 text-nborange rounded-xl flex items-center justify-center active:bg-nborange active:text-white transition" title="Lihat upload murid">
              <i class="fa-solid fa-list-check text-xs"></i>
            </button>
            <a href="/guru/tugas/delete/<?= $a['id'] ?>" onclick="return confirm('Hapus tugas ini?')" class="w-9 h-9 bg-nbred/10 text-nbred rounded-xl flex items-center justify-center active:bg-nbred active:text-white transition">
              <i class="fa-solid fa-trash text-xs"></i>
            </a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<!-- FAB -->
<button hx-get="/guru/tugas/tambah" hx-push-url="/guru/tugas/tambah" hx-swap="innerHTML show:top" hx-target="#guru-content" class="fixed right-4 w-14 h-14 bg-nbgreen text-white rounded-2xl shadow-nblg flex items-center justify-center text-xl z-30 active:scale-90 transition" style="bottom: calc(env(safe-area-inset-bottom, 0px) + 6rem);">
  <i class="fa-solid fa-list-ol"></i>
</button>
