<div class="mt-4 mb-4">
  <h2 class="font-display text-xl font-bold">Data Tugas</h2>
  <p class="text-sm text-ink/60">Kelola tugas untuk murid</p>
</div>

<!-- Filter -->
<div class="flex gap-2 overflow-x-auto pb-1 mb-4">
  <a href="/guru/tugas" class="px-3 py-1.5 rounded-full text-xs font-bold whitespace-nowrap <?= empty($class) && empty($subject) ? 'bg-ink text-white' : 'bg-white/50 text-ink/60 nb-border' ?>">Semua</a>
  <?php foreach ($classes as $c): ?>
    <a href="/guru/tugas?class=<?= urlencode($c) ?>" class="px-3 py-1.5 rounded-full text-xs font-bold whitespace-nowrap <?= ($class ?? '') === $c ? 'bg-ink text-white' : 'bg-white/50 text-ink/60 nb-border' ?>"><?= esc($c) ?></a>
  <?php endforeach; ?>
  <?php foreach ($subjects as $s): ?>
    <a href="/guru/tugas?subject=<?= urlencode($s) ?>" class="px-3 py-1.5 rounded-full text-xs font-bold whitespace-nowrap <?= ($subject ?? '') === $s ? 'bg-ink text-white' : 'bg-white/50 text-ink/60 nb-border' ?>"><?= esc($s) ?></a>
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
            <button onclick='editAssignment(<?= json_encode($a) ?>)' class="w-9 h-9 bg-nbblue/10 text-nbblue rounded-xl flex items-center justify-center active:bg-nbblue active:text-white transition">
              <i class="fa-solid fa-pen text-xs"></i>
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
<button onclick="document.getElementById('addModal').classList.remove('hidden')" class="fixed right-4 w-14 h-14 bg-nbgreen text-white rounded-2xl shadow-nblg flex items-center justify-center text-xl z-30 active:scale-90 transition" style="bottom: calc(env(safe-area-inset-bottom, 0px) + 6rem);">
  <i class="fa-solid fa-clipboard-plus"></i>
</button>

<!-- Add Modal -->
<div id="addModal" class="hidden fixed inset-0 z-50 bg-white">
  <div class="flex items-center justify-between p-4 border-b border-ink/10" style="padding-top: calc(env(safe-area-inset-top, 0px) + 1rem);">
    <h3 class="font-display text-lg font-bold">Tambah Tugas</h3>
    <button onclick="document.getElementById('addModal').classList.add('hidden')" class="w-9 h-9 bg-ink/10 rounded-xl flex items-center justify-center">
      <i class="fa-solid fa-xmark"></i>
    </button>
  </div>
  <form action="/guru/tugas" method="post" class="p-4 space-y-4">
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
</div>

<!-- Edit Modal -->
<div id="editModal" class="hidden fixed inset-0 z-50 bg-white">
  <div class="flex items-center justify-between p-4 border-b border-ink/10" style="padding-top: calc(env(safe-area-inset-top, 0px) + 1rem);">
    <h3 class="font-display text-lg font-bold">Edit Tugas</h3>
    <button onclick="document.getElementById('editModal').classList.add('hidden')" class="w-9 h-9 bg-ink/10 rounded-xl flex items-center justify-center">
      <i class="fa-solid fa-xmark"></i>
    </button>
  </div>
  <form id="editForm" method="post" class="p-4 space-y-4">
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Judul Tugas</label>
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
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Pilih Materi dari Buku (opsional)</label>
      <select name="material_id" id="edit_material_id" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
        <option value="">-- Tanpa Materi --</option>
        <?php foreach ($materials as $m): ?>
          <option value="<?= $m['id'] ?>" data-book-id="<?= $m['book_id'] ?? '' ?>" class="material-option"><?= esc($m['title']) ?> (<?= esc($m['subject']) ?>)</option>
        <?php endforeach; ?>
      </select>
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Deskripsi</label>
      <textarea name="description" id="edit_description" rows="3" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue"></textarea>
    </div>
    <div class="grid grid-cols-2 gap-3">
      <div>
        <label class="text-xs font-bold text-ink/60 block mb-1">Mata Pelajaran</label>
        <input type="text" name="subject" id="edit_subject" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
      </div>
      <div>
        <label class="text-xs font-bold text-ink/60 block mb-1">Kelas</label>
        <input type="text" name="class" id="edit_class" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
      </div>
    </div>
    <div class="grid grid-cols-2 gap-3">
      <div>
        <label class="text-xs font-bold text-ink/60 block mb-1">Semester</label>
        <select name="semester" id="edit_semester" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
          <option value="1">1</option>
          <option value="2">2</option>
        </select>
      </div>
      <div>
        <label class="text-xs font-bold text-ink/60 block mb-1">Deadline</label>
        <input type="date" name="due_date" id="edit_due_date" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
      </div>
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

// Materials data grouped by book
const materialsData = <?= json_encode(array_map(function($m) {
  return [
    'id' => $m['id'],
    'book_id' => $m['book_id'] ?? null,
    'title' => $m['title'],
    'subject' => $m['subject'],
  ];
}, $materials)) ?>;

function autoFillFromBook(bookSelectId, subjectId, classId, semesterId, materialSelectId) {
  const select = document.getElementById(bookSelectId);
  if (!select) return;

  select.addEventListener('change', function() {
    const bookId = this.value;

    // Filter materials by book
    if (materialSelectId) {
      const materialSelect = document.getElementById(materialSelectId);
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
        // Reset material selection if current selection doesn't match
        const selectedOpt = materialSelect.options[materialSelect.selectedIndex];
        if (selectedOpt && selectedOpt.style.display === 'none') {
          materialSelect.value = '';
        }
      }
    }

    if (!bookId) return;

    const book = booksData.find(b => b.id == bookId);
    if (book) {
      document.getElementById(subjectId).value = book.subject;
      document.getElementById(classId).value = book.class;
      document.getElementById(semesterId).value = book.semester;
    }
  });
}

// Auto-fill for add form
autoFillFromBook('add_book_id', 'add_subject', 'add_class', 'add_semester', 'add_material_id');

// Auto-fill for edit form
autoFillFromBook('edit_book_id', 'edit_subject', 'edit_class', 'edit_semester', 'edit_material_id');

function editAssignment(a) {
  document.getElementById('editForm').action = '/guru/tugas/update/' + a.id;
  document.getElementById('edit_title').value = a.title;
  document.getElementById('edit_book_id').value = a.book_id || '';
  document.getElementById('edit_material_id').value = a.material_id || '';
  document.getElementById('edit_description').value = a.description;
  document.getElementById('edit_subject').value = a.subject;
  document.getElementById('edit_class').value = a.class;
  document.getElementById('edit_semester').value = a.semester;
  document.getElementById('edit_due_date').value = a.due_date;
  document.getElementById('editModal').classList.remove('hidden');
}
</script>