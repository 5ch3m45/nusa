<div class="mt-4 mb-4">
  <h2 class="font-display text-xl font-bold">Data Nilai</h2>
  <p class="text-sm text-ink/60">Kelola nilai murid per tugas</p>
</div>

<!-- Filter -->
<div class="mb-4">
  <form action="/guru/nilai" method="get">
    <select name="assignment_id" onchange="this.form.submit()" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
      <option value="">Semua Tugas</option>
      <?php foreach ($assignments as $a): ?>
        <option value="<?= $a['id'] ?>" <?= ($assignmentId ?? '') == $a['id'] ? 'selected' : '' ?>><?= esc($a['title']) ?> (<?= esc($a['class']) ?>)</option>
      <?php endforeach; ?>
    </select>
  </form>
</div>

<!-- Grade List -->
<div class="space-y-3">
  <?php if (empty($grades)): ?>
    <div class="nb-card p-8 text-center text-ink/40 text-sm">
      <i class="fa-solid fa-star text-3xl mb-2"></i>
      <p>Belum ada nilai ditemukan.</p>
    </div>
  <?php else: ?>
    <?php foreach ($grades as $g): ?>
      <div class="nb-card p-4">
        <div class="flex items-start gap-3">
          <div class="w-11 h-11 <?= $g['score'] >= 80 ? 'bg-nbgreen/15 text-nbgreen' : ($g['score'] >= 60 ? 'bg-nbyellow/15 text-nborange' : 'bg-nbred/15 text-nbred') ?> rounded-xl flex items-center justify-center shrink-0">
            <span class="text-sm font-bold"><?= esc($g['score']) ?></span>
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-sm font-bold truncate"><?= esc($g['student_name'] ?? '-') ?></p>
            <p class="text-[11px] text-ink/50"><?= esc($g['assignment_title'] ?? '-') ?></p>
            <p class="text-[11px] text-ink/50"><?= esc($g['subject'] ?? '-') ?> • Kelas <?= esc($g['class'] ?? '-') ?></p>
            <?php if (!empty($g['file_path'])): ?>
              <p class="text-[11px] text-nbblue font-semibold mt-1">
                <i class="fa-solid fa-paperclip mr-1"></i>Jawaban: <a href="/<?= esc($g['file_path']) ?>" target="_blank" class="underline"><?= esc($g['submission_name'] ?? 'lihat file') ?></a>
              </p>
            <?php endif; ?>
            <?php if (!empty($g['feedback'])): ?>
              <p class="text-[11px] text-ink/40 mt-1 italic">"<?= esc($g['feedback']) ?>"</p>
            <?php endif; ?>
          </div>
          <div class="flex gap-2 shrink-0">
            <button onclick='editGrade(<?= json_encode($g) ?>)' class="w-9 h-9 bg-nbblue/10 text-nbblue rounded-xl flex items-center justify-center active:bg-nbblue active:text-white transition">
              <i class="fa-solid fa-pen text-xs"></i>
            </button>
            <a href="/guru/nilai/delete/<?= $g['id'] ?>" onclick="return confirm('Hapus nilai ini?')" class="w-9 h-9 bg-nbred/10 text-nbred rounded-xl flex items-center justify-center active:bg-nbred active:text-white transition">
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
  <i class="fa-solid fa-star"></i>
</button>

<!-- Add Modal -->
<div id="addModal" class="hidden fixed inset-0 z-50 bg-white">
  <div class="flex items-center justify-between p-4 border-b border-ink/10" style="padding-top: calc(env(safe-area-inset-top, 0px) + 1rem);">
    <h3 class="font-display text-lg font-bold">Input Nilai</h3>
    <button onclick="document.getElementById('addModal').classList.add('hidden')" class="w-9 h-9 bg-ink/10 rounded-xl flex items-center justify-center">
      <i class="fa-solid fa-xmark"></i>
    </button>
  </div>
  <form action="/guru/nilai" method="post" class="p-4 space-y-4">
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Pilih Tugas</label>
      <select name="assignment_id" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
        <option value="">-- Pilih Tugas --</option>
        <?php foreach ($assignments as $a): ?>
          <option value="<?= $a['id'] ?>"><?= esc($a['title']) ?> (<?= esc($a['class']) ?>)</option>
        <?php endforeach; ?>
      </select>
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Pilih Murid</label>
      <select name="student_id" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
        <option value="">-- Pilih Murid --</option>
        <?php foreach ($students as $s): ?>
          <option value="<?= $s['id'] ?>"><?= esc($s['name']) ?> (<?= esc($s['class']) ?>)</option>
        <?php endforeach; ?>
      </select>
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Nilai (0-100)</label>
      <input type="number" name="score" required min="0" max="100" step="0.01" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Feedback</label>
      <textarea name="feedback" rows="2" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue"></textarea>
    </div>
    <button type="submit" class="w-full py-3.5 bg-nbgreen text-white rounded-xl text-sm font-bold nb-btn">
      Simpan Nilai
    </button>
  </form>
</div>

<!-- Edit Modal -->
<div id="editModal" class="hidden fixed inset-0 z-50 bg-white">
  <div class="flex items-center justify-between p-4 border-b border-ink/10" style="padding-top: calc(env(safe-area-inset-top, 0px) + 1rem);">
    <h3 class="font-display text-lg font-bold">Edit Nilai</h3>
    <button onclick="document.getElementById('editModal').classList.add('hidden')" class="w-9 h-9 bg-ink/10 rounded-xl flex items-center justify-center">
      <i class="fa-solid fa-xmark"></i>
    </button>
  </div>
  <form id="editForm" method="post" class="p-4 space-y-4">
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Nilai (0-100)</label>
      <input type="number" name="score" id="edit_score" required min="0" max="100" step="0.01" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Feedback</label>
      <textarea name="feedback" id="edit_feedback" rows="2" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue"></textarea>
    </div>
    <button type="submit" class="w-full py-3.5 bg-nbblue text-white rounded-xl text-sm font-bold nb-btn">
      Simpan Perubahan
    </button>
  </form>
</div>

<script>
function editGrade(g) {
  document.getElementById('editForm').action = '/guru/nilai/update/' + g.id;
  document.getElementById('edit_score').value = g.score;
  document.getElementById('edit_feedback').value = g.feedback || '';
  document.getElementById('editModal').classList.remove('hidden');
}
</script>