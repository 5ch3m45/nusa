<?php
$tabs = [
    'book'       => ['Buku',   'fa-book',           "/murid/htmx/missions/{$material['id']}/book",      "/murid/missions/{$material['id']}/book"],
    'material'   => ['Materi', 'fa-file-lines',     "/murid/htmx/missions/{$material['id']}/material",  "/murid/missions/{$material['id']}/material"],
    'assignment' => ['Tugas',  'fa-clipboard-list', "/murid/htmx/missions/{$material['id']}/assignment", "/murid/missions/{$material['id']}/assignment"],
];
$activeTab = $activeTab ?? 'material';
?>
<div id="view-mission-detail" class="space-y-4">
  <a hx-get="/murid/htmx/missions/semester/<?= (int) ($material['semester'] ?? 1) ?>"
    hx-push-url="/murid/missions/semester/<?= (int) ($material['semester'] ?? 1) ?>"
    hx-swap="innerHTML show:top"
    hx-target="#mainScroll" onclick="setActiveNav('missions')"
    class="text-xs font-bold text-ink/60 inline-flex items-center gap-1.5">
    <i class="fa-solid fa-arrow-left"></i> Kembali ke Misi
  </a>
  <div class="nb-card p-4 space-y-4">
    <div class="flex items-center gap-3">
      <span class="text-[11px] font-extrabold bg-nbgreen text-white nb-pill px-2.5 py-1 shrink-0"><?= esc($material['chapter'] ?? '') ?></span>
      <h3 class="font-display text-base font-bold leading-snug"><?= esc($material['title'] ?? '') ?></h3>
    </div>
    <div class="flex gap-2">
      <?php foreach ($tabs as $key => [$label, $icon, $hxUrl, $pushUrl]): ?>
        <button hx-get="<?= $hxUrl ?>"
          hx-push-url="<?= $pushUrl ?>"
          hx-swap="innerHTML show:top"
          hx-target="#mainScroll" onclick="setActiveNav('missions')"
          class="flex-1 py-2.5 nb-pill text-xs <?= $activeTab === $key ? 'bg-nbblue text-white' : 'bg-white/60 text-ink/60' ?>">
          <i class="fa-solid <?= esc($icon) ?> mr-1"></i> <?= esc($label) ?>
        </button>
      <?php endforeach; ?>
    </div>
    <div id="missionDetailContent">
      <?= $this->include('murid/htmx/mission_detail_' . $activeTab) ?>
    </div>
  </div>
</div>
