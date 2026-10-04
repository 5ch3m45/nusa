<div class="mt-4 mb-4 flex items-center gap-3">
  <button hx-get="/guru/tugas" hx-push-url="/guru/tugas" hx-swap="innerHTML show:top" hx-target="#guru-content" class="w-9 h-9 bg-ink/10 rounded-xl flex items-center justify-center">
    <i class="fa-solid fa-arrow-left"></i>
  </button>
  <div>
    <h2 class="font-display text-xl font-bold">Tambah Tugas</h2>
    <p class="text-sm text-ink/60">Buat tugas baru untuk murid</p>
  </div>
</div>

<form action="/guru/tugas" method="post" class="nb-card p-4 space-y-4">
  <div>
    <label class="text-xs font-bold text-ink/60 block mb-1">Judul Tugas</label>
    <input type="text" name="title" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
  </div>
  <div>
    <label class="text-xs font-bold text-ink/60 block mb-1">Pilih Buku (opsional)</label>
    <select name="book_id" id="add_book_id" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
      <option value="">-- Tanpa Buku --</option>
      <?php foreach ($books as $b): ?>
        <option value="<?= $b['id'] ?>"><?= esc($b['title']) ?> (<?= esc($b['subject']) ?>)</option>
      <?php endforeach; ?>
    </select>
  </div>
  <div>
    <label class="text-xs font-bold text-ink/60 block mb-1">Pilih Materi dari Buku (opsional)</label>
    <select name="material_id" id="add_material_id" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
      <option value="">-- Tanpa Materi --</option>
      <?php foreach ($materials as $m): ?>
        <option value="<?= $m['id'] ?>" data-book-id="<?= $m['book_id'] ?? '' ?>" class="material-option"><?= esc($m['title']) ?> (<?= esc($m['subject']) ?>)</option>
      <?php endforeach; ?>
    </select>
  </div>
  <div>
    <label class="text-xs font-bold text-ink/60 block mb-1">Deskripsi</label>
    <textarea name="description" rows="3" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue"></textarea>
  </div>
  <div class="grid grid-cols-2 gap-3">
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Mata Pelajaran</label>
      <input type="text" name="subject" id="add_subject" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Kelas</label>
      <input type="text" name="class" id="add_class" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
  </div>
  <div class="grid grid-cols-2 gap-3">
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Semester</label>
      <select name="semester" id="add_semester" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
        <option value="1">1</option>
        <option value="2">2</option>
      </select>
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Deadline</label>
      <input type="date" name="due_date" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
  </div>
  <button type="submit" class="w-full py-3.5 bg-nbgreen text-white rounded-xl text-sm font-bold nb-btn">
    Simpan Tugas
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

const select = document.getElementById('add_book_id');
if (select) {
  select.addEventListener('change', function() {
    const bookId = this.value;

    const materialSelect = document.getElementById('add_material_id');
    if (materialSelect) {
      const options = materialSelect.querySelectorAll('.material-option');
      options.forEach(opt => {
        const optBookId = opt.getAttribute('data-book-id');
        if (!bookId || !optBookId || optBookId === '') {
          opt.style.display = '';
        } else if (optBookId === bookId) {
          opt.style.display = '';
        } else {
          opt.style.display = 'none';
        }
      });
      const selectedOpt = materialSelect.options[materialSelect.selectedIndex];
      if (selectedOpt && selectedOpt.style.display === 'none') {
        materialSelect.value = '';
      }
    }

    if (!bookId) return;

    const book = booksData.find(b => b.id == bookId);
    if (book) {
      document.getElementById('add_subject').value = book.subject;
      document.getElementById('add_class').value = book.class;
      document.getElementById('add_semester').value = book.semester;
    }
  });
}
})();
</script>
