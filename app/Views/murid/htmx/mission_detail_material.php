<?php
$progress = $progress ?? [];
$submaterials = $submaterials ?? [];
?>
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

  <?php if (!empty($submaterials)): ?>
    <h4 class="font-display text-sm font-bold pt-2">Submateri</h4>
    <div class="space-y-3">
      <?php foreach ($submaterials as $sub): ?>
        <?php
        $embed = \App\Services\SubmaterialService::embedUrl($sub);
        $icon  = match ((string) $sub['type']) {
            'youtube' => 'fa-brands fa-youtube',
            'pdf'     => 'fa-solid fa-file-pdf',
            'slides'  => 'fa-solid fa-slideshare',
            'mp3'     => 'fa-solid fa-volume-high',
            default   => 'fa-solid fa-align-left',
        };
        ?>
        <div class="nb-card p-3 space-y-2">
          <div class="flex items-center gap-2">
            <i class="fa-solid <?= esc($icon) ?> text-nbblue text-sm"></i>
            <h5 class="font-bold text-sm leading-snug flex-1 min-w-0"><?= esc($sub['title']) ?></h5>
          </div>
          <?php switch ((string) $sub['type']):
            case 'text': ?>
              <div class="text-[12px] text-ink/70 leading-relaxed bg-white/50 nb-border rounded-xl p-2.5">
                <?= nl2br(esc((string) ($sub['content'] ?? ''))) ?>
              </div>
              <?php break;
            case 'youtube': ?>
              <?php if ($embed): ?>
                <div class="w-full aspect-video bg-ink/10 rounded-xl overflow-hidden">
                  <iframe class="w-full h-full" src="<?= esc($embed) ?>" title="<?= esc($sub['title']) ?>" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
              <?php endif; ?>
              <?php break;
            case 'slides':
            case 'pdf': ?>
              <?php if ($embed): ?>
                <div class="w-full h-96 bg-ink/10 rounded-xl overflow-hidden">
                  <iframe class="w-full h-full" src="<?= esc($embed) ?>" title="<?= esc($sub['title']) ?>"></iframe>
                </div>
              <?php endif; ?>
              <?php break;
            case 'mp3': ?>
              <?php if ($embed): ?>
                <audio controls class="w-full" src="<?= esc($embed) ?>"></audio>
              <?php endif; ?>
              <?php break;
          endswitch; ?>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>
