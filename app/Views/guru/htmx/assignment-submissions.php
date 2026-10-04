<div class="mt-4 mb-4 flex items-center gap-3">
  <button hx-get="/guru/tugas" hx-push-url="/guru/tugas" hx-swap="innerHTML show:top" hx-target="#guru-content" class="w-9 h-9 bg-ink/10 rounded-xl flex items-center justify-center">
    <i class="fa-solid fa-arrow-left"></i>
  </button>
  <div>
    <h2 class="font-display text-xl font-bold">Upload Tugas</h2>
    <p class="text-sm text-ink/60"><?= esc($assignment['title']) ?> • Kelas <?= esc($assignment['class']) ?></p>
  </div>
</div>

<div class="space-y-3">
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
            <p class="text-[11px] text-nbblue font-semibold mt-1">
              <i class="fa-solid fa-paperclip mr-1"></i>
              <a href="/<?= esc($s['file_path']) ?>" target="_blank" onclick="event.stopPropagation()" class="underline"><?= esc($s['original_name']) ?></a>
            </p>
            <?php if (!empty($s['note'])): ?>
              <p class="text-[11px] text-ink/60 mt-1 italic">"<?= esc($s['note']) ?>"</p>
            <?php endif; ?>
            <?php if ($s['score'] !== null): ?>
              <p class="text-[11px] text-nbgreen font-semibold mt-1"><i class="fa-solid fa-star mr-1"></i>Nilai: <?= esc($s['score']) ?></p>
            <?php else: ?>
              <p class="text-[11px] text-ink/40 mt-1">Belum dinilai</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>
