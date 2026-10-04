<div class="mt-4 mb-4 flex items-center gap-3">
  <button hx-get="/guru/tugas/<?= $assignment['id'] ?>/submissions" hx-push-url="/guru/tugas/<?= $assignment['id'] ?>/submissions" hx-swap="innerHTML show:top" hx-target="#guru-content" class="w-9 h-9 bg-ink/10 rounded-xl flex items-center justify-center">
    <i class="fa-solid fa-arrow-left"></i>
  </button>
  <div>
    <h2 class="font-display text-xl font-bold">Detail Jawaban</h2>
    <p class="text-sm text-ink/60"><?= esc($assignment['title']) ?> • <?= esc($submission['student_name']) ?></p>
  </div>
</div>

<div class="nb-card p-4 space-y-2 mb-4">
  <p class="text-sm font-bold"><?= esc($submission['student_name']) ?> <span class="text-ink/40 font-normal">• Kelas <?= esc($submission['class']) ?></span></p>
  <p class="text-[11px] text-ink/50"><i class="fa-regular fa-clock mr-1"></i>Dikumpulkan: <?= date('d M Y H:i', strtotime($submission['created_at'])) ?></p>
  <p class="text-[11px] text-ink/50"><i class="fa-solid fa-file mr-1"></i><?= esc($submission['original_name']) ?></p>
  <?php if (!empty($submission['note'])): ?>
    <p class="text-[11px] text-ink/60 italic">"<?= esc($submission['note']) ?>"</p>
  <?php endif; ?>
</div>

<?php
  $ext = strtolower(pathinfo($submission['file_path'], PATHINFO_EXTENSION));
  $imgExts = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
?>
<div class="nb-card p-4 mb-4">
  <h3 class="font-display text-sm font-bold mb-3">File Jawaban</h3>
  <?php if ($ext === 'pdf'): ?>
    <embed src="/<?= esc($submission['file_path']) ?>" type="application/pdf" class="w-full rounded-xl nb-border" style="height: 70vh;">
  <?php elseif (in_array($ext, $imgExts)): ?>
    <img src="/<?= esc($submission['file_path']) ?>" alt="Jawaban" class="w-full rounded-xl nb-border">
  <?php else: ?>
    <p class="text-xs text-ink/50 mb-2">Preview tidak tersedia untuk tipe file ini.</p>
  <?php endif; ?>
  <a href="/<?= esc($submission['file_path']) ?>" target="_blank" class="block w-full mt-3 py-2.5 bg-nbblue/10 text-nbblue rounded-xl text-xs font-bold text-center">
    <i class="fa-solid fa-download mr-1"></i> Unduh / Buka File
  </a>
</div>

<div class="nb-card p-4">
  <h3 class="font-display text-sm font-bold mb-3">Nilai dari Guru</h3>
  <form action="/guru/tugas/<?= $assignment['id'] ?>/submissions/<?= $submission['id'] ?>/grade" method="post" class="space-y-4">
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Nilai (0-100)</label>
      <input type="number" name="score" value="<?= esc($submission['score'] ?? '') ?>" required min="0" max="100" step="0.01" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Feedback</label>
      <textarea name="feedback" rows="3" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue"><?= esc($submission['feedback'] ?? '') ?></textarea>
    </div>
    <button type="submit" class="w-full py-3.5 bg-nbgreen text-white rounded-xl text-sm font-bold nb-btn">
      Simpan Nilai
    </button>
  </form>
</div>
