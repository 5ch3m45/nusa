<div class="mt-4 mb-4">
  <h2 class="font-display text-xl font-bold">Data Materi</h2>
  <p class="text-sm text-ink/60">Kelola materi pembelajaran</p>
</div>

<!-- Filter -->
<div class="flex gap-2 overflow-x-auto pb-1 mb-4">
  <a href="/guru/materi" class="px-3 py-1.5 rounded-full text-xs font-bold whitespace-nowrap <?= empty($class) && empty($subject) ? 'bg-ink text-white' : 'bg-white/50 text-ink/60 nb-border' ?>">Semua</a>
  <?php foreach ($classes as $c): ?>
    <a href="/guru/materi?class=<?= urlencode($c) ?>" class="px-3 py-1.5 rounded-full text-xs font-bold whitespace-nowrap <?= ($class ?? '') === $c ? 'bg-ink text-white' : 'bg-white/50 text-ink/60 nb-border' ?>"><?= esc($c) ?></a>
  <?php endforeach; ?>
  <?php foreach ($subjects as $s): ?>
    <a href="/guru/materi?subject=<?= urlencode($s) ?>" class="px-3 py-1.5 rounded-full text-xs font-bold whitespace-nowrap <?= ($subject ?? '') === $s ? 'bg-ink text-white' : 'bg-white/50 text-ink/60 nb-border' ?>"><?= esc($s) ?></a>
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
            <button onclick='editMaterial(<?= json_encode($m) ?>)' class="w-9 h-9 bg-nbblue/10 text-nbblue rounded-xl flex items-center justify-center active:bg-nbblue active:text-white transition">
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

<!-- Edit Modal -->
<div id="editModal" class="hidden fixed inset-0 z-50 bg-white">
  <div class="flex items-center justify-between p-4 border-b border-ink/10" style="padding-top: calc(env(safe-area-inset-top, 0px) + 1rem);">
    <h3 class="font-display text-lg font-bold">Edit Materi</h3>
    <button onclick="document.getElementById('editModal').classList.add('hidden')" class="w-9 h-9 bg-ink/10 rounded-xl flex items-center justify-center">
      <i class="fa-solid fa-xmark"></i>
    </button>
  </div>
  <form id="editForm" method="post" class="p-4 space-y-4">
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Judul Materi</label>
      <input type="text" name="title" id="edit_title" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Pilih Buku (opsional)</label>
      <select name="book_id" id="edit_book_id" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
        <option value="">-- Tanpa Buku --</option>
        <?php foreach ($books as $b): ?>
          <option value="<?= $b['id'] ?>"><?= esc($b['title']) ?> (<?= esc($b['subject']) ?>)</option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="grid grid-cols-2 gap-3">
      <div>
        <label class="text-xs font-bold text-ink/60 block mb-1">Mata Pelajaran</label>
        <input type="text" name="subject" id="edit_subject" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
      </div>
      <div>
        <label class="text-xs font-bold text-ink/60 block mb-1">Bab</label>
        <input type="text" name="chapter" id="edit_chapter" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
      </div>
    </div>
    <div class="grid grid-cols-2 gap-3">
      <div>
        <label class="text-xs font-bold text-ink/60 block mb-1">Kelas</label>
        <input type="text" name="class" id="edit_class" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
      </div>
      <div>
        <label class="text-xs font-bold text-ink/60 block mb-1">Semester</label>
        <select name="semester" id="edit_semester" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
          <option value="1">1</option>
          <option value="2">2</option>
        </select>
      </div>
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Konten Materi</label>
      <textarea name="content" id="edit_content" rows="6" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue"></textarea>
    </div>
    <button type="submit" class="w-full py-3.5 bg-nbblue text-white rounded-xl text-sm font-bold nb-btn">
      Simpan Perubahan
    </button>
  </form>
</div>

<script>
// Book data for auto-fill
const booksData = <?= json_encode(array_map(function($b) {
  return [
    'id' => $b['id'],
    'subject' => $b['subject'],
    'class' => $b['class'],
    'semester' => $b['semester'],
  ];
}, $books)) ?>;

function autoFillFromBook(bookSelectId, subjectId, classId, semesterId) {
  const select = document.getElementById(bookSelectId);
  if (!select) return;

  select.addEventListener('change', function() {
    const bookId = this.value;
    if (!bookId) return;

    const book = booksData.find(b => b.id == bookId);
    if (book) {
      document.getElementById(subjectId).value = book.subject;
      document.getElementById(classId).value = book.class;
      document.getElementById(semesterId).value = book.semester;
    }
  });
}

// Auto-fill for edit form
autoFillFromBook('edit_book_id', 'edit_subject', 'edit_class', 'edit_semester');

function editMaterial(m) {
  document.getElementById('editForm').action = '/guru/materi/update/' + m.id;
  document.getElementById('edit_title').value = m.title;
  document.getElementById('edit_book_id').value = m.book_id || '';
  document.getElementById('edit_subject').value = m.subject;
  document.getElementById('edit_chapter').value = m.chapter;
  document.getElementById('edit_class').value = m.class;
  document.getElementById('edit_semester').value = m.semester;
  document.getElementById('edit_content').value = m.content;
  document.getElementById('editModal').classList.remove('hidden');
}
</script>