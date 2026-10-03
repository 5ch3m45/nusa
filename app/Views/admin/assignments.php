<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="mt-4 mb-4">
  <h2 class="font-display text-xl font-bold">Tugas Book Store</h2>
  <p class="text-sm text-ink/60">Kelola tugas untuk Book Store</p>
</div>

<!-- Filter by Book -->
<div class="mb-4">
  <form action="/admin/tugas" method="get">
    <select name="book_store_id" onchange="this.form.submit()" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
      <option value="">Semua Buku</option>
      <?php foreach ($books as $b): ?>
        <option value="<?= $b['id'] ?>" <?= ($bookStoreId ?? '') == $b['id'] ? 'selected' : '' ?>><?= esc($b['title']) ?></option>
      <?php endforeach; ?>
    </select>
  </form>
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
          </div>
          <div class="flex gap-2 shrink-0">
            <button onclick='editAssignment(<?= json_encode($a) ?>)' class="w-9 h-9 bg-nbblue/10 text-nbblue rounded-xl flex items-center justify-center active:bg-nbblue active:text-white transition">
              <i class="fa-solid fa-pen text-xs"></i>
            </button>
            <a href="/admin/tugas/delete/<?= $a['id'] ?>" onclick="return confirm('Hapus tugas ini?')" class="w-9 h-9 bg-nbred/10 text-nbred rounded-xl flex items-center justify-center active:bg-nbred active:text-white transition">
              <i class="fa-solid fa-trash text-xs"></i>
            </a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<!-- FAB -->
<button onclick="document.getElementById('addModal').classList.remove('hidden')" class="fixed right-4 w-14 h-14 bg-nbpurple text-white rounded-2xl shadow-nblg flex items-center justify-center text-xl z-30 active:scale-90 transition" style="bottom: calc(env(safe-area-inset-bottom, 0px) + 6rem);">
  <i class="fa-solid fa-list-ol"></i>
</button>

<!-- Add Modal -->
<div id="addModal" class="hidden fixed inset-0 z-50 bg-white">
  <div class="flex items-center justify-between p-4 border-b border-ink/10" style="padding-top: calc(env(safe-area-inset-top, 0px) + 1rem);">
    <h3 class="font-display text-lg font-bold">Tambah Tugas</h3>
    <button onclick="document.getElementById('addModal').classList.add('hidden')" class="w-9 h-9 bg-ink/10 rounded-xl flex items-center justify-center">
      <i class="fa-solid fa-xmark"></i>
    </button>
  </div>
  <form action="/admin/tugas" method="post" class="p-4 space-y-4">
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Pilih Buku</label>
      <select name="book_store_id" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
        <option value="">-- Pilih Buku --</option>
        <?php foreach ($books as $b): ?>
          <option value="<?= $b['id'] ?>"><?= esc($b['title']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Judul Tugas</label>
      <input type="text" name="title" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Deskripsi</label>
      <textarea name="description" rows="3" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue"></textarea>
    </div>
    <div class="grid grid-cols-2 gap-3">
      <div>
        <label class="text-xs font-bold text-ink/60 block mb-1">Mata Pelajaran</label>
        <input type="text" name="subject" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
      </div>
      <div>
        <label class="text-xs font-bold text-ink/60 block mb-1">Kelas</label>
        <input type="text" name="class" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
      </div>
    </div>
    <div class="grid grid-cols-2 gap-3">
      <div>
        <label class="text-xs font-bold text-ink/60 block mb-1">Semester</label>
        <select name="semester" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
          <option value="1">1</option>
          <option value="2">2</option>
        </select>
      </div>
      <div>
        <label class="text-xs font-bold text-ink/60 block mb-1">Deadline</label>
        <input type="date" name="due_date" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
      </div>
    </div>
    <button type="submit" class="w-full py-3.5 bg-nbpurple text-white rounded-xl text-sm font-bold nb-btn">
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
      <label class="text-xs font-bold text-ink/60 block mb-1">Pilih Buku</label>
      <select name="book_store_id" id="edit_book_store_id" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
        <option value="">-- Pilih Buku --</option>
        <?php foreach ($books as $b): ?>
          <option value="<?= $b['id'] ?>"><?= esc($b['title']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Judul Tugas</label>
      <input type="text" name="title" id="edit_title" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
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
function editAssignment(a) {
  document.getElementById('editForm').action = '/admin/tugas/update/' + a.id;
  document.getElementById('edit_book_store_id').value = a.book_store_id;
  document.getElementById('edit_title').value = a.title;
  document.getElementById('edit_description').value = a.description;
  document.getElementById('edit_subject').value = a.subject;
  document.getElementById('edit_class').value = a.class;
  document.getElementById('edit_semester').value = a.semester;
  document.getElementById('edit_due_date').value = a.due_date;
  document.getElementById('editModal').classList.remove('hidden');
}
</script>

<?= $this->endSection() ?>
