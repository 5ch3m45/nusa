<div class="mt-4 mb-4">
  <h2 class="font-display text-xl font-bold">Book Store</h2>
  <p class="text-sm text-ink/60">Ambil buku dari Super Admin untuk kelas Anda</p>
</div>

<!-- Search & Filter -->
<div class="space-y-3 mb-4">
  <form action="/guru/book-store" method="get" class="flex gap-2">
    <input type="text" name="search" value="<?= esc($search ?? '') ?>" placeholder="Cari judul atau mapel..." class="flex-1 bg-white/50 nb-border rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-nbblue">
    <button type="submit" class="px-4 py-2.5 bg-nbblue text-white rounded-xl text-sm font-bold nb-btn shrink-0">
      <i class="fa-solid fa-search"></i>
    </button>
  </form>
  <div class="flex gap-2 overflow-x-auto pb-1">
    <a href="/guru/book-store" class="px-3 py-1.5 rounded-full text-xs font-bold whitespace-nowrap <?= empty($class) && empty($subject) ? 'bg-ink text-white' : 'bg-white/50 text-ink/60 nb-border' ?>">Semua</a>
    <?php foreach ($classes as $c): ?>
      <a href="/guru/book-store?class=<?= urlencode($c) ?>" class="px-3 py-1.5 rounded-full text-xs font-bold whitespace-nowrap <?= ($class ?? '') === $c ? 'bg-ink text-white' : 'bg-white/50 text-ink/60 nb-border' ?>"><?= esc($c) ?></a>
    <?php endforeach; ?>
    <?php foreach ($subjects as $s): ?>
      <a href="/guru/book-store?subject=<?= urlencode($s) ?>" class="px-3 py-1.5 rounded-full text-xs font-bold whitespace-nowrap <?= ($subject ?? '') === $s ? 'bg-ink text-white' : 'bg-white/50 text-ink/60 nb-border' ?>"><?= esc($s) ?></a>
    <?php endforeach; ?>
  </div>
</div>

<!-- Book List -->
<div class="space-y-3">
  <?php if (empty($books)): ?>
    <div class="nb-card p-8 text-center text-ink/40 text-sm">
      <i class="fa-solid fa-book text-3xl mb-2"></i>
      <p>Tidak ada buku ditemukan.</p>
    </div>
  <?php else: ?>
    <?php foreach ($books as $b): ?>
      <?php $isTaken = in_array($b['title'], $myBookTitles); ?>
      <div class="nb-card p-4">
        <div class="flex items-start gap-3">
          <div class="w-11 h-11 <?= $b['type'] === 'pdf' ? 'bg-nbred/15 text-nbred' : 'bg-nbblue/15 text-nbblue' ?> rounded-xl flex items-center justify-center shrink-0">
            <i class="fa-solid <?= $b['type'] === 'pdf' ? 'fa-file-pdf' : 'fa-link' ?> text-lg"></i>
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-sm font-bold truncate"><?= esc($b['title']) ?></p>
            <p class="text-[11px] text-ink/50"><?= esc($b['subject']) ?> • Kelas <?= esc($b['class']) ?> • Semester <?= esc($b['semester']) ?></p>
            <?php if (!empty($b['description'])): ?>
              <p class="text-[11px] text-ink/40 mt-1 line-clamp-2"><?= esc($b['description']) ?></p>
            <?php endif; ?>
          </div>
        </div>
        <div class="flex gap-2 mt-3">
          <a href="/guru/book-store/<?= $b['id'] ?>" class="flex-1 py-2.5 bg-nbblue text-white rounded-xl text-xs font-bold text-center nb-btn">
            <i class="fa-solid fa-eye mr-1"></i> Detail
          </a>
          <?php if ($isTaken): ?>
            <span class="flex-1 py-2.5 bg-nbgreen/10 text-nbgreen rounded-xl text-xs font-bold text-center">
              <i class="fa-solid fa-check mr-1"></i> Sudah Diambil
            </span>
          <?php else: ?>
            <a href="/guru/book-store/take/<?= $b['id'] ?>" onclick="return confirm('Ambil buku ini? Buku, materi, dan tugas akan ditambahkan ke daftar Anda.')" class="flex-1 py-2.5 bg-nbgreen text-white rounded-xl text-xs font-bold text-center nb-btn">
              <i class="fa-solid fa-plus mr-1"></i> Ambil Buku
            </a>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>