<div class="mt-4 mb-4 flex items-center gap-3">
  <button hx-get="/guru/tugas" hx-push-url="/guru/tugas" hx-swap="innerHTML show:top" hx-target="#guru-content" class="w-9 h-9 bg-ink/10 rounded-xl flex items-center justify-center">
    <i class="fa-solid fa-arrow-left"></i>
  </button>
  <div>
    <h2 class="font-display text-xl font-bold">Edit Tugas</h2>
    <p class="text-sm text-ink/60">Perbarui data tugas</p>
  </div>
</div>

<form action="/guru/tugas/update/<?= $assignment['id'] ?>" method="post" class="nb-card p-4 space-y-4">
  <div>
    <label class="text-xs font-bold text-ink/60 block mb-1">Judul Tugas</label>
    <input type="text" name="title" value="<?= esc($assignment['title']) ?>" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
  </div>
  <div>
    <label class="text-xs font-bold text-ink/60 block mb-1">Pilih Buku (opsional)</label>
    <select name="book_id" id="edit_book_id" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
      <option value="">-- Tanpa Buku --</option>
      <?php foreach ($books as $b): ?>
        <option value="<?= $b['id'] ?>" <?= ($assignment['book_id'] ?? '') == $b['id'] ? 'selected' : '' ?>><?= esc($b['title']) ?> (<?= esc($b['subject']) ?>)</option>
      <?php endforeach; ?>
    </select>
  </div>
  <div>
    <label class="text-xs font-bold text-ink/60 block mb-1">Pilih Materi dari Buku (opsional)</label>
    <select name="material_id" id="edit_material_id" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
      <option value="">-- Tanpa Materi --</option>
      <?php foreach ($materials as $m): ?>
        <option value="<?= $m['id'] ?>" data-book-id="<?= $m['book_id'] ?? '' ?>" class="material-option" <?= ($assignment['material_id'] ?? '') == $m['id'] ? 'selected' : '' ?>><?= esc($m['title']) ?> (<?= esc($m['subject']) ?>)</option>
      <?php endforeach; ?>
    </select>
  </div>
  <div>
    <label class="text-xs font-bold text-ink/60 block mb-1">Deskripsi</label>
    <textarea name="description" rows="3" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue"><?= esc($assignment['description']) ?></textarea>
  </div>
  <div class="grid grid-cols-2 gap-3">
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Mata Pelajaran</label>
      <input type="text" name="subject" id="edit_subject" value="<?= esc($assignment['subject']) ?>" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Kelas</label>
      <input type="text" name="class" id="edit_class" value="<?= esc($assignment['class']) ?>" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
  </div>
  <div class="grid grid-cols-2 gap-3">
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Semester</label>
      <select name="semester" id="edit_semester" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
        <option value="1" <?= ($assignment['semester'] ?? '') == '1' ? 'selected' : '' ?>>1</option>
        <option value="2" <?= ($assignment['semester'] ?? '') == '2' ? 'selected' : '' ?>>2</option>
      </select>
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Deadline</label>
      <input type="date" name="due_date" value="<?= esc($assignment['due_date']) ?>" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
  </div>
<?php if (($assignment['type'] ?? 'upload') === 'quiz'): ?>
<div id="quizBuilder" class="border-t border-ink/10 pt-4 mt-4 space-y-3">
  <h3 class="font-bold text-sm">Soal Kuis</h3>
  <div id="questionsContainer" class="space-y-3">
    <?php $questions = $questions ?? []; ?>
    <?php if (empty($questions)): ?>
      <p class="text-xs text-ink/50">Belum ada soal.</p>
    <?php else: ?>
      <?php foreach ($questions as $i => $q): ?>
        <div class="question-item nb-border rounded-xl p-3 space-y-2">
          <input type="text" name="questions[<?= $i ?>][question]" value="<?= esc($q['question']) ?>" placeholder="Pertanyaan" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm">
          <hr>
          <div class="space-y-2">
          <input type="text" name="questions[<?= $i ?>][option_a]" value="<?= esc($q['option_a']) ?>" placeholder="A" class="w-full bg-white/50 nb-border rounded-xl px-3 py-2 text-sm">
          <input type="text" name="questions[<?= $i ?>][option_b]" value="<?= esc($q['option_b']) ?>" placeholder="B" class="w-full bg-white/50 nb-border rounded-xl px-3 py-2 text-sm">
          <input type="text" name="questions[<?= $i ?>][option_c]" value="<?= esc($q['option_c']) ?>" placeholder="C" class="w-full bg-white/50 nb-border rounded-xl px-3 py-2 text-sm">
            <input type="text" name="questions[<?= $i ?>][option_d]" value="<?= esc($q['option_d']) ?>" placeholder="D" class="w-full bg-white/50 nb-border rounded-xl px-3 py-2 text-sm">
        </div>
          <select name="questions[<?= $i ?>][correct]" class="w-full bg-white/50 nb-border rounded-xl px-3 py-2 text-sm">
            <?php foreach (['a','b','c','d'] as $opt): ?>
              <option value="<?= $opt ?>" <?= ($q['correct'] ?? '') === $opt ? 'selected' : '' ?>>Jawaban benar: <?= strtoupper($opt) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
  <button type="button" id="addQuestionBtn" class="w-full py-2.5 bg-nbblue/10 text-nbblue rounded-xl text-sm font-bold">+ Tambah Soal</button>
</div>
<?php endif; ?>

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

// Add question (edit form)
let questionIndex = <?= count($questions ?? []) ?>;
const eAddBtn = document.getElementById('addQuestionBtn');
if (eAddBtn) {
  eAddBtn.addEventListener('click', function() {
    const container = document.getElementById('questionsContainer');
    const template = container.querySelector('.question-item');
    if (!template) {
      const div = document.createElement('div');
      div.className = 'question-item nb-border rounded-xl p-3 space-y-2';
      div.innerHTML = '<input type="text" name="questions[' + questionIndex + '][question]" placeholder="Pertanyaan" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm">' +
        '<hr>' +
        '<div class="space-y-2">' +
        '<input type="text" name="questions[' + questionIndex + '][option_a]" placeholder="A" class="w-full bg-white/50 nb-border rounded-xl px-3 py-2 text-sm">' +
        '<input type="text" name="questions[' + questionIndex + '][option_b]" placeholder="B" class="w-full bg-white/50 nb-border rounded-xl px-3 py-2 text-sm">' +
        '<input type="text" name="questions[' + questionIndex + '][option_c]" placeholder="C" class="w-full bg-white/50 nb-border rounded-xl px-3 py-2 text-sm">' +
        '<input type="text" name="questions[' + questionIndex + '][option_d]" placeholder="D" class="w-full bg-white/50 nb-border rounded-xl px-3 py-2 text-sm">' +
        '</div>' +
        '<select name="questions[' + questionIndex + '][correct]" class="w-full bg-white/50 nb-border rounded-xl px-3 py-2 text-sm">' +
        '<option value="a">Jawaban benar: A</option><option value="b">Jawaban benar: B</option>' +
        '<option value="c">Jawaban benar: C</option><option value="d">Jawaban benar: D</option></select>';
      container.appendChild(div);
    } else {
      const clone = template.cloneNode(true);
      clone.querySelectorAll('input, select').forEach(el => {
        el.name = el.name.replace(/\[\d+\]/, '[' + questionIndex + ']');
        if (el.tagName === 'INPUT') el.value = '';
        if (el.tagName === 'SELECT') el.value = 'a';
      });
      container.appendChild(clone);
    }
    questionIndex++;
  });
}

const select = document.getElementById('edit_book_id');
if (select) {
  select.addEventListener('change', function() {
    const bookId = this.value;

    const materialSelect = document.getElementById('edit_material_id');
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
      document.getElementById('edit_subject').value = book.subject;
      document.getElementById('edit_class').value = book.class;
      document.getElementById('edit_semester').value = book.semester;
    }
  });
}
})();
</script>
