<div class="mt-4 mb-4 flex items-center gap-3">
  <button hx-get="/guru/tugas" hx-push-url="/guru/tugas" hx-swap="innerHTML show:top" hx-target="#guru-content" class="w-9 h-9 bg-ink/10 rounded-xl flex items-center justify-center">
    <i class="fa-solid fa-arrow-left"></i>
  </button>
  <div>
    <h2 class="font-display text-xl font-bold">Upload Tugas</h2>
    <p class="text-sm text-ink/60"><?= esc($assignment['title']) ?> • Kelas <?= esc($assignment['class']) ?></p>
  </div>
</div>

<!-- Detail Tugas (readonly) -->
<div class="nb-card p-4 mb-4 space-y-1.5">
  <h3 class="font-bold text-sm"><?= esc($assignment['title']) ?></h3>
  <p class="text-[11px] text-ink/50"><?= esc($assignment['subject']) ?> &bull; Kelas <?= esc($assignment['class']) ?> &bull; Semester <?= esc($assignment['semester']) ?></p>
  <p class="text-[11px] text-ink/50">
    <i class="fa-solid fa-tag mr-1"></i>Tipe: <?= ($assignment['type'] ?? 'upload') === 'quiz' ? 'Kuis Pilihan Ganda' : 'Upload File' ?>
    &bull; <i class="fa-regular fa-calendar mr-1"></i>Deadline: <?= date('d M Y', strtotime($assignment['due_date'])) ?>
  </p>
  <?php if (!empty($assignment['book_title'])): ?>
    <p class="text-[11px] text-nbblue font-semibold"><i class="fa-solid fa-book mr-1"></i><?= esc($assignment['book_title']) ?></p>
  <?php endif; ?>
  <?php if (!empty($assignment['material_title'])): ?>
    <p class="text-[11px] text-nbgreen font-semibold"><i class="fa-solid fa-file-lines mr-1"></i><?= esc($assignment['material_title']) ?></p>
  <?php endif; ?>
  <?php if (!empty($assignment['description'])): ?>
    <p class="text-[11px] text-ink/60 leading-relaxed"><?= esc($assignment['description']) ?></p>
  <?php endif; ?>
</div>

<div id="submissions" class="space-y-3">
  <?php if (($assignment['type'] ?? 'upload') === 'quiz'): ?>
    <a href="/guru/tugas/<?= $assignment['id'] ?>/submissions/unlock-all" onclick="return confirm('Unlock SEMUA jawaban murid untuk tugas ini?')" class="block w-full py-2.5 bg-nborange/10 text-nborange rounded-xl text-xs font-bold text-center nb-btn">
      <i class="fa-solid fa-lock-open mr-1"></i> Unlock Semua Jawaban
    </a>
  <?php endif; ?>
  <?php if (empty($submissions)): ?>
    <div class="nb-card p-8 text-center text-ink/40 text-sm">
      <i class="fa-solid fa-inbox text-3xl mb-2"></i>
      <p>Belum ada murid yang mengumpulkan tugas ini.</p>
    </div>
  <?php else: ?>
    <?php foreach ($submissions as $s): ?>
      <div hx-get="/guru/tugas/<?= $assignment['id'] ?>/submissions/<?= $s['id'] ?>" hx-push-url="/guru/tugas/<?= $assignment['id'] ?>/submissions/<?= $s['id'] ?>" hx-swap="innerHTML show:top" hx-target="#guru-content" class="nb-card p-4 cursor-pointer">
        <div class="flex items-start gap-3">
          <div class="w-11 h-11 bg-nbblue/15 text-nbblue rounded-xl flex items-center justify-center shrink-0">
            <i class="fa-solid fa-user-graduate text-lg"></i>
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-sm font-bold truncate"><?= esc($s['student_name']) ?></p>
            <p class="text-[11px] text-ink/50">Kelas <?= esc($s['class']) ?> • <?= date('d M Y H:i', strtotime($s['created_at'])) ?></p>
            <?php if (!empty($s['file_path'])): ?>
              <p class="text-[11px] text-nbblue font-semibold mt-1">
                <i class="fa-solid fa-paperclip mr-1"></i>
                <a href="/<?= esc($s['file_path']) ?>" target="_blank" onclick="event.stopPropagation()" class="underline"><?= esc($s['original_name'] ?? 'file') ?></a>
              </p>
            <?php elseif (!empty($s['answer'])): ?>
              <p class="text-[11px] text-nbpurple font-semibold mt-1"><i class="fa-solid fa-list-check mr-1"></i>Tugas Kuis</p>
            <?php endif; ?>
            <?php if (($assignment['type'] ?? 'upload') === 'quiz' && !empty($s['answers_locked'])): ?>
              <p class="text-[11px] text-nborange font-semibold mt-1"><i class="fa-solid fa-lock mr-1"></i>Jawaban Terkunci</p>
            <?php endif; ?>
            <?php if (!empty($s['note'])): ?>
              <p class="text-[11px] text-ink/60 mt-1 italic">"<?= esc($s['note']) ?>"</p>
            <?php endif; ?>
            <?php if ($s['score'] !== null): ?>
              <p class="text-[11px] text-nbgreen font-semibold mt-1"><i class="fa-solid fa-star mr-1"></i>Nilai: <?= esc($s['score']) ?></p>
            <?php else: ?>
              <p class="text-[11px] text-ink/40 mt-1">Belum dinilai</p>
            <?php endif; ?>
          </div>
          <?php if (($assignment['type'] ?? 'upload') === 'quiz' && !empty($s['answers_locked'])): ?>
            <div class="shrink-0 flex flex-col items-center gap-1">
              <a href="/guru/tugas/<?= $assignment['id'] ?>/submissions/<?= $s['id'] ?>/unlock" onclick="event.stopPropagation(); return confirm('Unlock jawaban murid ini?')" class="w-9 h-9 bg-nborange/10 text-nborange rounded-xl flex items-center justify-center active:bg-nborange active:text-white transition" title="Unlock jawaban">
                <i class="fa-solid fa-lock-open text-xs"></i>
              </a>
              <span class="text-[9px] font-bold text-nborange">Unlock</span>
            </div>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>
