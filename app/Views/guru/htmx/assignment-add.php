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
    <label class="text-xs font-bold text-ink/60 block mb-1">Jenis Tugas</label>
    <select name="type" id="assignment_type" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
      <option value="upload">Upload File (siswa menulis/upload dokumen)</option>
      <option value="quiz">Kuis Pilihan Ganda</option>
    </select>
  </div>
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
  <div id="quizBuilder" class="hidden space-y-3 border-t border-ink/10 pt-4">
    <h3 class="font-bold text-sm">Soal Kuis</h3>
    <div id="questionsContainer" class="space-y-3">
      <div class="question-item nb-border rounded-xl p-3 space-y-2">
        <input type="text" name="questions[0][question]" placeholder="Pertanyaan" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm">
        <hr>
        <div class="space-y-2">
          <input type="text" name="questions[0][option_a]" placeholder="A" class="w-full bg-white/50 nb-border rounded-xl px-3 py-2 text-sm">
          <input type="text" name="questions[0][option_b]" placeholder="B" class="w-full bg-white/50 nb-border rounded-xl px-3 py-2 text-sm">
          <input type="text" name="questions[0][option_c]" placeholder="C" class="w-full bg-white/50 nb-border rounded-xl px-3 py-2 text-sm">
          <input type="text" name="questions[0][option_d]" placeholder="D" class="w-full bg-white/50 nb-border rounded-xl px-3 py-2 text-sm">
        </div>
        <select name="questions[0][correct]" class="w-full bg-white/50 nb-border rounded-xl px-3 py-2 text-sm">
          <option value="a">Jawaban benar: A</option>
          <option value="b">Jawaban benar: B</option>
          <option value="c">Jawaban benar: C</option>
          <option value="d">Jawaban benar: D</option>
        </select>
      </div>
    </div>
    <button type="button" id="addQuestionBtn" class="w-full py-2.5 bg-nbblue/10 text-nbblue rounded-xl text-sm font-bold">+ Tambah Soal</button>
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

// Toggle quiz builder
const typeSelect = document.getElementById('assignment_type');
const quizBuilder = document.getElementById('quizBuilder');
if (typeSelect && quizBuilder) {
  typeSelect.addEventListener('change', function() {
    quizBuilder.classList.toggle('hidden', this.value !== 'quiz');
  });
}

// Add question
let questionIndex = 1;
const addBtn = document.getElementById('addQuestionBtn');
if (addBtn) {
  addBtn.addEventListener('click', function() {
    const container = document.getElementById('questionsContainer');
    const template = container.querySelector('.question-item');
    const clone = template.cloneNode(true);
    clone.querySelectorAll('input, select').forEach(el => {
      el.name = el.name.replace('[0]', '[' + questionIndex + ']');
      if (el.tagName === 'INPUT') el.value = '';
      if (el.tagName === 'SELECT') el.value = 'a';
    });
    clone.querySelectorAll('.grid').forEach(g => { g.classList.remove('grid', 'grid-cols-2', 'gap-2'); g.classList.add('space-y-2'); });
    clone.querySelectorAll('input').forEach(inp => inp.classList.add('w-full'));
    container.appendChild(clone);
    questionIndex++;
  });
}
})();
</script>
