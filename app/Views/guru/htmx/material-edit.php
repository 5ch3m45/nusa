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
