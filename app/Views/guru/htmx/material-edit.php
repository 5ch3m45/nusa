<?php if (session()->getFlashdata('success')): ?>
  <div class="mb-3 p-3 bg-nbgreen/10 border border-nbgreen/30 rounded-xl text-xs font-bold text-nbgreen flex items-center gap-2">
    <i class="fa-solid fa-circle-check"></i> <?= session()->getFlashdata('success') ?>
  </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
  <div class="mb-3 p-3 bg-nbred/10 border border-nbred/30 rounded-xl text-xs font-bold text-nbred flex items-center gap-2">
    <i class="fa-solid fa-circle-exclamation"></i> <?= session()->getFlashdata('error') ?>
  </div>
<?php endif; ?>

<div class="mt-4 mb-4 flex items-center gap-3">
  <button hx-get="/guru/materi" hx-push-url="/guru/materi" hx-swap="innerHTML show:top" hx-target="#guru-content" class="w-9 h-9 bg-ink/10 rounded-xl flex items-center justify-center">
    <i class="fa-solid fa-arrow-left"></i>
  </button>
  <div>
    <h2 class="font-display text-xl font-bold">Edit Materi</h2>
    <p class="text-sm text-ink/60">Perbarui data materi</p>
  </div>
</div>

<form action="/guru/materi/update/<?= $material['id'] ?>" method="post" class="nb-card p-4 space-y-4">
  <div>
    <label class="text-xs font-bold text-ink/60 block mb-1">Judul Materi</label>
    <input type="text" name="title" value="<?= esc($material['title']) ?>" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
  </div>
  <div>
    <label class="text-xs font-bold text-ink/60 block mb-1">Pilih Buku (opsional)</label>
    <select name="book_id" id="edit_book_id" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
      <option value="">-- Tanpa Buku --</option>
      <?php foreach ($books as $b): ?>
        <option value="<?= $b['id'] ?>" <?= ($material['book_id'] ?? '') == $b['id'] ? 'selected' : '' ?>><?= esc($b['title']) ?> (<?= esc($b['subject']) ?>)</option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="grid grid-cols-2 gap-3">
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Mata Pelajaran</label>
      <input type="text" name="subject" id="edit_subject" value="<?= esc($material['subject']) ?>" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Bab</label>
      <input type="text" name="chapter" value="<?= esc($material['chapter']) ?>" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
  </div>
  <div class="grid grid-cols-2 gap-3">
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Kelas</label>
      <input type="text" name="class" id="edit_class" value="<?= esc($material['class']) ?>" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Semester</label>
      <select name="semester" id="edit_semester" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
        <option value="1" <?= ($material['semester'] ?? '') == '1' ? 'selected' : '' ?>>1</option>
        <option value="2" <?= ($material['semester'] ?? '') == '2' ? 'selected' : '' ?>>2</option>
      </select>
    </div>
  </div>
  <div>
    <label class="text-xs font-bold text-ink/60 block mb-1">Konten Materi</label>
    <textarea name="content" rows="6" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue"><?= esc($material['content']) ?></textarea>
  </div>
  <button type="submit" class="w-full py-3.5 bg-nbblue text-white rounded-xl text-sm font-bold nb-btn">
    Simpan Perubahan
  </button>
</form>

<div class="nb-card p-4 space-y-4 my-4">
  <div class="flex items-center justify-between">
    <h3 class="font-display text-sm font-bold">Submateri</h3>
    <span class="text-[11px] font-semibold text-ink/50"><?= count($submaterials ?? []) ?> item</span>
  </div>

  <?php if (!empty($submaterials)): ?>
    <div class="space-y-2">
      <?php
      $subTypeLabels = ['text' => 'Teks', 'youtube' => 'YouTube', 'pdf' => 'PDF', 'slides' => 'Google Slides', 'mp3' => 'Audio MP3'];
      $subIcons      = ['text' => 'fa-solid fa-align-left', 'youtube' => 'fa-brands fa-youtube', 'pdf' => 'fa-solid fa-file-pdf', 'slides' => 'fa-solid fa-slideshare', 'mp3' => 'fa-solid fa-volume-high'];
      ?>
      <?php foreach ($submaterials as $sub): ?>
        <?php $subType = (string) $sub['type']; ?>
        <div class="flex items-center gap-2 bg-white/50 nb-border rounded-xl px-3 py-2.5">
          <i class="fa-solid <?= esc($subIcons[$subType] ?? 'fa-solid fa-align-left') ?> text-nbblue text-sm w-5 text-center"></i>
          <div class="flex-1 min-w-0">
            <p class="text-sm font-bold truncate"><?= esc($sub['title']) ?></p>
            <p class="text-[10px] font-semibold text-ink/50 uppercase"><?= esc($subTypeLabels[$subType] ?? $subType) ?></p>
          </div>
          <a href="/guru/materi/submaterial/delete/<?= (int) $sub['id'] ?>" title="Hapus submateri" class="w-8 h-8 bg-nbred/10 text-nbred rounded-lg flex items-center justify-center active:bg-nbred active:text-white">
            <i class="fa-solid fa-trash text-xs"></i>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <p class="text-xs text-ink/50 text-center py-2">Belum ada submateri</p>
  <?php endif; ?>

  <form action="/guru/materi/submaterial/<?= (int) $material['id'] ?>" method="post" class="space-y-3 pt-3 border-t border-ink/10">
    <?= csrf_field() ?>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Tipe Submateri</label>
      <select name="type" id="sub_type" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
        <option value="text">Teks</option>
        <option value="youtube">YouTube</option>
        <option value="pdf">PDF</option>
        <option value="slides">Google Slides</option>
        <option value="mp3">Audio MP3</option>
      </select>
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Judul Submateri</label>
      <input type="text" name="title" required placeholder="cth: Pengantar Pecahan" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
    <div id="subContentWrap">
      <label class="text-xs font-bold text-ink/60 block mb-1">Konten Teks</label>
      <textarea name="content" rows="5" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue"></textarea>
    </div>
    <div id="subUrlWrap" class="hidden">
      <label class="text-xs font-bold text-ink/60 block mb-1">URL / Link</label>
      <input type="text" name="url" id="sub_url" placeholder="cth: https://youtube.com/watch?v=…" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
      <p id="subUrlHint" class="text-[10px] text-ink/50 mt-1"></p>
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Urutan (opsional)</label>
      <input type="number" name="sort_order" min="0" placeholder="Kosongkan untuk urutan terakhir" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
    <button type="submit" class="w-full py-3.5 bg-nbblue text-white rounded-xl text-sm font-bold nb-btn">
      Tambah Submateri
    </button>
  </form>
</div>

<script>
(function() {
const booksData = <?= json_encode(array_map(function($b) {
  return [
    'id' => $b['id'],
    'subject' => $b['subject'],
    'class' => $b['class'],
    'semester' => $b['semester'],
  ];
}, $books)) ?>;

const select = document.getElementById('edit_book_id');
if (select) {
  select.addEventListener('change', function() {
    const bookId = this.value;
    if (!bookId) return;

    const book = booksData.find(b => b.id == bookId);
    if (book) {
      document.getElementById('edit_subject').value = book.subject;
      document.getElementById('edit_class').value = book.class;
      document.getElementById('edit_semester').value = book.semester;
    }
  });
}
})();
</script>

<script>
(function() {
  const typeSel = document.getElementById('sub_type');
  const contentWrap = document.getElementById('subContentWrap');
  const urlWrap = document.getElementById('subUrlWrap');
  const urlInput = document.getElementById('sub_url');
  const hint = document.getElementById('subUrlHint');
  if (!typeSel) return;

  const hints = {
    youtube: 'Link YouTube (watch?v=…, youtu.be/…, atau ID video)',
    pdf: 'Link PDF (URL berekstensi .pdf atau path file, mis. uploads/file.pdf)',
    slides: 'Link Google Slides (dokumen presentasi)',
    mp3: 'Link audio MP3 (URL atau path file)',
  };

  function toggleSubType() {
    const isText = typeSel.value === 'text';
    contentWrap.classList.toggle('hidden', !isText);
    urlWrap.classList.toggle('hidden', isText);
    urlInput.required = !isText;
    hint.textContent = isText ? '' : (hints[typeSel.value] || '');
  }

  typeSel.addEventListener('change', toggleSubType);
  toggleSubType();
})();
</script>
