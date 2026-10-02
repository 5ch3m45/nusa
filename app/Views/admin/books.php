<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="mt-4 mb-4">
  <h2 class="font-display text-xl font-bold">Buku Book Store</h2>
  <p class="text-sm text-ink/60">Kelola buku untuk Book Store</p>
</div>

<!-- Search & Filter -->
<div class="space-y-3 mb-4">
  <form action="/admin/buku" method="get" class="flex gap-2">
    <input type="text" name="search" value="<?= esc($search ?? '') ?>" placeholder="Cari judul atau mapel..." class="flex-1 bg-white/50 nb-border rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-nbblue">
    <button type="submit" class="px-4 py-2.5 bg-nbblue text-white rounded-xl text-sm font-bold nb-btn shrink-0">
      <i class="fa-solid fa-search"></i>
    </button>
  </form>
  <div class="flex gap-2 overflow-x-auto pb-1">
    <a href="/admin/buku" class="px-3 py-1.5 rounded-full text-xs font-bold whitespace-nowrap <?= empty($class) && empty($subject) ? 'bg-ink text-white' : 'bg-white/50 text-ink/60 nb-border' ?>">Semua</a>
    <?php foreach ($classes as $c): ?>
      <a href="/admin/buku?class=<?= urlencode($c) ?>" class="px-3 py-1.5 rounded-full text-xs font-bold whitespace-nowrap <?= ($class ?? '') === $c ? 'bg-ink text-white' : 'bg-white/50 text-ink/60 nb-border' ?>"><?= esc($c) ?></a>
    <?php endforeach; ?>
    <?php foreach ($subjects as $s): ?>
      <a href="/admin/buku?subject=<?= urlencode($s) ?>" class="px-3 py-1.5 rounded-full text-xs font-bold whitespace-nowrap <?= ($subject ?? '') === $s ? 'bg-ink text-white' : 'bg-white/50 text-ink/60 nb-border' ?>"><?= esc($s) ?></a>
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
      <div class="nb-card p-4">
        <div class="flex items-start gap-3">
          <div class="w-11 h-11 <?= $b['type'] === 'pdf' ? 'bg-nbred/15 text-nbred' : 'bg-nbblue/15 text-nbblue' ?> rounded-xl flex items-center justify-center shrink-0">
            <i class="fa-solid <?= $b['type'] === 'pdf' ? 'fa-file-pdf' : 'fa-link' ?> text-lg"></i>
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-sm font-bold truncate"><?= esc($b['title']) ?></p>
            <p class="text-[11px] text-ink/50"><?= esc($b['subject']) ?> • Kelas <?= esc($b['class']) ?> • Semester <?= esc($b['semester']) ?></p>
            <span class="inline-block mt-1 px-2 py-0.5 rounded-lg text-[10px] font-bold <?= $b['type'] === 'pdf' ? 'bg-nbred/10 text-nbred' : 'bg-nbblue/10 text-nbblue' ?>">
              <?= $b['type'] === 'pdf' ? 'PDF' : 'Link' ?>
            </span>
          </div>
          <div class="flex gap-2 shrink-0">
            <button onclick='editBook(<?= json_encode($b) ?>)' class="w-9 h-9 bg-nbblue/10 text-nbblue rounded-xl flex items-center justify-center active:bg-nbblue active:text-white transition">
              <i class="fa-solid fa-pen text-xs"></i>
            </button>
            <a href="/admin/buku/delete/<?= $b['id'] ?>" onclick="return confirm('Hapus buku ini?')" class="w-9 h-9 bg-nbred/10 text-nbred rounded-xl flex items-center justify-center active:bg-nbred active:text-white transition">
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
  <i class="fa-solid fa-book-medical"></i>
</button>

<!-- Add Modal -->
<div id="addModal" class="hidden fixed inset-0 z-50 bg-white">
  <div class="flex items-center justify-between p-4 border-b border-ink/10" style="padding-top: calc(env(safe-area-inset-top, 0px) + 1rem);">
    <h3 class="font-display text-lg font-bold">Tambah Buku</h3>
    <button onclick="document.getElementById('addModal').classList.add('hidden')" class="w-9 h-9 bg-ink/10 rounded-xl flex items-center justify-center">
      <i class="fa-solid fa-xmark"></i>
    </button>
  </div>
  <form action="/admin/buku" method="post" enctype="multipart/form-data" class="p-4 space-y-4">
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Judul Buku</label>
      <input type="text" name="title" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-2">Tipe</label>
      <div class="flex gap-3">
        <label class="flex-1 cursor-pointer">
          <input type="radio" name="type" value="link" checked onchange="toggleType('add', 'link')" class="peer hidden">
          <div class="text-center py-3 rounded-xl nb-border bg-white/50 peer-checked:bg-nbblue peer-checked:text-white peer-checked:border-nbblue transition text-sm font-bold">
            <i class="fa-solid fa-link mr-1"></i> Link
          </div>
        </label>
        <label class="flex-1 cursor-pointer">
          <input type="radio" name="type" value="pdf" onchange="toggleType('add', 'pdf')" class="peer hidden">
          <div class="text-center py-3 rounded-xl nb-border bg-white/50 peer-checked:bg-nbred peer-checked:text-white peer-checked:border-nbred transition text-sm font-bold">
            <i class="fa-solid fa-file-pdf mr-1"></i> PDF
          </div>
        </label>
      </div>
    </div>
    <div id="add_url_field">
      <label class="text-xs font-bold text-ink/60 block mb-1">URL Link</label>
      <input type="url" name="url" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue" placeholder="https://...">
    </div>
    <div id="add_pdf_field" class="hidden">
      <label class="text-xs font-bold text-ink/60 block mb-1">Upload PDF</label>
      <input type="file" name="pdf_file" accept=".pdf" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Mata Pelajaran</label>
      <input type="text" name="subject" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
    <div class="grid grid-cols-2 gap-3">
      <div>
        <label class="text-xs font-bold text-ink/60 block mb-1">Kelas</label>
        <input type="text" name="class" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
      </div>
      <div>
        <label class="text-xs font-bold text-ink/60 block mb-1">Semester</label>
        <select name="semester" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
          <option value="1">1</option>
          <option value="2">2</option>
        </select>
      </div>
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Deskripsi</label>
      <textarea name="description" rows="3" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue"></textarea>
    </div>
    <button type="submit" class="w-full py-3.5 bg-nbpurple text-white rounded-xl text-sm font-bold nb-btn">
      Simpan Buku
    </button>
  </form>
</div>

<!-- Edit Modal -->
<div id="editModal" class="hidden fixed inset-0 z-50 bg-white">
  <div class="flex items-center justify-between p-4 border-b border-ink/10" style="padding-top: calc(env(safe-area-inset-top, 0px) + 1rem);">
    <h3 class="font-display text-lg font-bold">Edit Buku</h3>
    <button onclick="document.getElementById('editModal').classList.add('hidden')" class="w-9 h-9 bg-ink/10 rounded-xl flex items-center justify-center">
      <i class="fa-solid fa-xmark"></i>
    </button>
  </div>
  <form id="editForm" method="post" enctype="multipart/form-data" class="p-4 space-y-4">
    <input type="hidden" name="existing_url" id="edit_existing_url">
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Judul Buku</label>
      <input type="text" name="title" id="edit_title" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-2">Tipe</label>
      <div class="flex gap-3">
        <label class="flex-1 cursor-pointer">
          <input type="radio" name="type" value="link" id="edit_type_link" onchange="toggleType('edit', 'link')" class="peer hidden">
          <div class="text-center py-3 rounded-xl nb-border bg-white/50 peer-checked:bg-nbblue peer-checked:text-white peer-checked:border-nbblue transition text-sm font-bold">
            <i class="fa-solid fa-link mr-1"></i> Link
          </div>
        </label>
        <label class="flex-1 cursor-pointer">
          <input type="radio" name="type" value="pdf" id="edit_type_pdf" onchange="toggleType('edit', 'pdf')" class="peer hidden">
          <div class="text-center py-3 rounded-xl nb-border bg-white/50 peer-checked:bg-nbred peer-checked:text-white peer-checked:border-nbred transition text-sm font-bold">
            <i class="fa-solid fa-file-pdf mr-1"></i> PDF
          </div>
        </label>
      </div>
    </div>
    <div id="edit_url_field">
      <label class="text-xs font-bold text-ink/60 block mb-1">URL Link</label>
      <input type="url" name="url" id="edit_url" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
    <div id="edit_pdf_field" class="hidden">
      <label class="text-xs font-bold text-ink/60 block mb-1">Upload PDF (kosongkan jika tidak diganti)</label>
      <input type="file" name="pdf_file" accept=".pdf" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Mata Pelajaran</label>
      <input type="text" name="subject" id="edit_subject" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
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
      <label class="text-xs font-bold text-ink/60 block mb-1">Deskripsi</label>
      <textarea name="description" id="edit_description" rows="3" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue"></textarea>
    </div>
    <button type="submit" class="w-full py-3.5 bg-nbblue text-white rounded-xl text-sm font-bold nb-btn">
      Simpan Perubahan
    </button>
  </form>
</div>

<script>
function toggleType(prefix, type) {
  document.getElementById(prefix + '_url_field').classList.toggle('hidden', type !== 'link');
  document.getElementById(prefix + '_pdf_field').classList.toggle('hidden', type !== 'pdf');
}

function editBook(b) {
  document.getElementById('editForm').action = '/admin/buku/update/' + b.id;
  document.getElementById('edit_existing_url').value = b.url_or_path;
  document.getElementById('edit_title').value = b.title;
  document.getElementById('edit_subject').value = b.subject;
  document.getElementById('edit_class').value = b.class;
  document.getElementById('edit_semester').value = b.semester;
  document.getElementById('edit_description').value = b.description || '';

  if (b.type === 'link') {
    document.getElementById('edit_type_link').checked = true;
    document.getElementById('edit_url').value = b.url_or_path;
    toggleType('edit', 'link');
  } else {
    document.getElementById('edit_type_pdf').checked = true;
    toggleType('edit', 'pdf');
  }

  document.getElementById('editModal').classList.remove('hidden');
}
</script>

<?= $this->endSection() ?>
