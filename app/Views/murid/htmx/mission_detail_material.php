<?php $progress = $progress ?? []; ?>
<div class="space-y-3">
  <div class="text-[12px] text-ink/70 leading-relaxed bg-white/50 nb-border rounded-xl p-3">
    <?= esc($material['content'] ?? '') ?>
  </div>
  <div class="text-[11px] font-semibold text-ink/60 flex items-center gap-1.5">
    <?php if (!empty($progress['is_done'])): ?>
      <i class="fa-solid fa-circle-check text-nbgreen"></i> Selesai<?= ($progress['score'] ?? null) !== null ? ' &bull; Nilai ' . esc($progress['score']) : '' ?>
    <?php elseif (!empty($progress['started_at']) || !empty($progress['last_accessed_at'])): ?>
      <i class="fa-solid fa-book-open text-nbblue"></i> Sedang dipelajari
    <?php else: ?>
      <i class="fa-regular fa-circle text-ink/40"></i> Belum dimulai
    <?php endif; ?>
  </div>
  <?php if (empty($progress['is_done'])): ?>
    <form method="post" action="/murid/missions/<?= (int) $material['id'] ?>/complete" class="pt-1">
      <?= csrf_field() ?>
      <button type="submit" class="w-full py-2.5 bg-nbgreen text-white nb-btn text-xs flex items-center justify-center gap-2">
        <i class="fa-solid fa-check mr-1"></i> Tandai Selesai
      </button>
    </form>
  <?php endif; ?>
</div>
