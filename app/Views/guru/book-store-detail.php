<?= $this->extend('guru/layout') ?>
<?= $this->section('content') ?>

<div class="mt-4 mb-4">
  <a href="/guru/book-store" class="text-xs text-nbblue font-bold"><i class="fa-solid fa-arrow-left mr-1"></i> Kembali</a>
</div>

<!-- Book Info -->
<div class="nb-card p-4 mb-4">
  <div class="flex items-start gap-3 mb-3">
    <div class="w-14 h-14 <?= $book['type'] === 'pdf' ? 'bg-nbred/15 text-nbred' : 'bg-nbblue/15 text-nbblue' ?> rounded-2xl flex items-center justify-center shrink-0">
      <i class="fa-solid <?= $book['type'] === 'pdf' ? 'fa-file-pdf' : 'fa-link' ?> text-2xl"></i>
    </div>
    <div class="flex-1 min-w-0">
      <p class="text-base font-bold"><?= esc($book['title']) ?></p>
      <p class="text-xs text-ink/50"><?= esc($book['subject']) ?> • Kelas <?= esc($book['class']) ?> • Semester <?= esc($book['semester']) ?></p>
      <span class="inline-block mt-1 px-2 py-0.5 rounded-lg text-[10px] font-bold <?= $book['type'] === 'pdf' ? 'bg-nbred/10 text-nbred' : 'bg-nbblue/10 text-nbblue' ?>">
        <?= $book['type'] === 'pdf' ? 'PDF' : 'Link' ?>
      </span>
    </div>
  </div>
  <?php if (!empty($book['description'])): ?>
    <p class="text-xs text-ink/60"><?= esc($book['description']) ?></p>
  <?php endif; ?>
</div>

<!-- Materials -->
<div class="mb-4">
  <h3 class="font-display text-base font-bold mb-3">Materi (<?= count($book['materials']) ?>)</h3>
  <div class="space-y-2">
    <?php if (empty($book['materials'])): ?>
      <div class="nb-card p-4 text-center text-ink/40 text-xs">Belum ada materi</div>
    <?php else: ?>
      <?php foreach ($book['materials'] as $m): ?>
        <div class="nb-card p-3 flex items-center gap-3">
          <div class="w-9 h-9 bg-nborange/15 text-nborange rounded-lg flex items-center justify-center shrink-0">
            <i class="fa-solid fa-file-lines text-sm"></i>
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-xs font-bold truncate"><?= esc($m['title']) ?></p>
            <p class="text-[10px] text-ink/50"><?= esc($m['chapter']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>

<!-- Assignments -->
<div class="mb-4">
  <h3 class="font-display text-base font-bold mb-3">Tugas (<?= count($book['assignments']) ?>)</h3>
  <div class="space-y-2">
    <?php if (empty($book['assignments'])): ?>
      <div class="nb-card p-4 text-center text-ink/40 text-xs">Belum ada tugas</div>
    <?php else: ?>
      <?php foreach ($book['assignments'] as $a): ?>
        <div class="nb-card p-3 flex items-center gap-3">
          <div class="w-9 h-9 bg-nbpurple/15 text-nbpurple rounded-lg flex items-center justify-center shrink-0">
            <i class="fa-solid fa-clipboard-list text-sm"></i>
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-xs font-bold truncate"><?= esc($a['title']) ?></p>
            <p class="text-[10px] text-nbred"><?= date('d M Y', strtotime($a['due_date'])) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>

<!-- Take Book Button -->
<a href="/guru/book-store/take/<?= $book['id'] ?>" onclick="return confirm('Ambil buku ini? Buku, materi, dan tugas akan ditambahkan ke daftar Anda.')" class="block w-full py-3.5 bg-nbgreen text-white rounded-xl text-sm font-bold text-center nb-btn">
  <i class="fa-solid fa-plus mr-1"></i> Ambil Buku Ini
</a>

<?= $this->endSection() ?>
