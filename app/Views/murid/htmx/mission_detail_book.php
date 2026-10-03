<?php if (empty($book)): ?>
  <div class="text-center text-ink/40 text-sm py-8">
    <i class="fa-solid fa-book text-3xl mb-2"></i>
    <p>Materi ini belum memiliki buku.</p>
  </div>
<?php else: ?>
  <div class="space-y-3">
    <div class="flex items-center gap-3">
      <div class="w-12 h-12 rounded-2xl bg-nbpurple/15 nb-border border-nbpurple flex items-center justify-center text-lg text-nbpurple shrink-0">
        <i class="fa-solid fa-book"></i>
      </div>
      <div class="flex-1 min-w-0">
        <h4 class="font-display font-bold text-sm leading-snug"><?= esc($book['title']) ?></h4>
        <p class="text-[11px] text-ink/50 font-semibold"><?= esc($book['subject'] ?? '') ?> &bull; Kelas <?= esc($book['class'] ?? '') ?> &bull; Semester <?= esc($book['semester'] ?? '') ?></p>
      </div>
      <span class="text-[10px] font-extrabold uppercase bg-ink/10 text-ink/60 nb-pill px-2 py-0.5 shrink-0"><?= $book['type'] === 'pdf' ? 'PDF' : 'Tautan' ?></span>
    </div>
    <?php if ($book['type'] === 'pdf'): ?>
      <a href="/<?= esc(ltrim((string) $book['url_or_path'], '/')) ?>" target="_blank" rel="noopener" class="w-full py-2.5 bg-nbpurple text-white nb-btn text-xs flex items-center justify-center gap-2">
        <i class="fa-solid fa-file-pdf mr-1"></i> Lihat PDF
      </a>
    <?php else: ?>
      <a href="<?= esc((string) $book['url_or_path']) ?>" target="_blank" rel="noopener" class="w-full py-2.5 bg-nbpurple text-white nb-btn text-xs flex items-center justify-center gap-2">
        <i class="fa-solid fa-book-open mr-1"></i> Buka Buku
      </a>
    <?php endif; ?>
  </div>
<?php endif; ?>
