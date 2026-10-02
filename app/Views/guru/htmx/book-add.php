<div class="mt-4 mb-4 flex items-center gap-3">
  <button hx-get="/guru/buku" hx-push-url="/guru/buku" hx-swap="innerHTML show:top" hx-target="#guru-content" class="w-9 h-9 bg-ink/10 rounded-xl flex items-center justify-center">
    <i class="fa-solid fa-arrow-left"></i>
  </button>
  <div>
    <h2 class="font-display text-xl font-bold">Tambah Buku</h2>
    <p class="text-sm text-ink/60">Tambah buku dalam bentuk link atau PDF</p>
  </div>
</div>

<form action="/guru/buku" method="post" enctype="multipart/form-data" class="nb-card p-4 space-y-4">
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
  <button type="submit" class="w-full py-3.5 bg-nbgreen text-white rounded-xl text-sm font-bold nb-btn">
    Simpan Buku
  </button>
</form>

<script>
function toggleType(prefix, type) {
  document.getElementById(prefix + '_url_field').classList.toggle('hidden', type !== 'link');
  document.getElementById(prefix + '_pdf_field').classList.toggle('hidden', type !== 'pdf');
}
</script>
