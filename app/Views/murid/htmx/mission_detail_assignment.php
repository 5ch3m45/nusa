<?php if (empty($assignments)): ?>
  <div class="text-center text-ink/40 text-sm py-8">
    <i class="fa-solid fa-clipboard-list text-3xl mb-2"></i>
    <p>Belum ada tugas untuk materi ini.</p>
  </div>
<?php else: ?>
  <div class="space-y-3">
    <?php foreach ($assignments as $assignment): ?>
      <div class="bg-white/50 nb-border rounded-xl p-3 space-y-1.5">
        <div class="flex justify-between items-center gap-2">
          <h5 class="font-bold text-sm leading-snug"><?= esc($assignment['title']) ?></h5>
          <?php if (!empty($assignment['due_date'])): ?>
            <span class="text-[10px] font-bold text-ink/50 shrink-0"><i class="fa-regular fa-calendar mr-1"></i><?= esc(date('d M Y', strtotime((string) $assignment['due_date']))) ?></span>
          <?php endif; ?>
        </div>
        <p class="text-[11px] text-ink/50 font-semibold"><?= esc($assignment['subject'] ?? '') ?> &bull; Kelas <?= esc($assignment['class'] ?? '') ?> &bull; Semester <?= esc($assignment['semester'] ?? '') ?></p>
        <?php if (!empty($assignment['description'])): ?>
          <p class="text-[11px] text-ink/60 leading-relaxed"><?= esc($assignment['description']) ?></p>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
