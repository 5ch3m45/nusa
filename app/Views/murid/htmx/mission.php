<div id="view-missions" class="space-y-4">
  <div class="flex gap-2">
    <button hx-get="/murid/htmx/missions/semester/1" 
      hx-push-url="/murid/missions/semester/1"
      hx-swap="innerHTML show:top"
      hx-target="#mainScroll" onclick="setActiveNav('missions'); setSemesterActive(1)" id="btnSem1" class="flex-1 py-2.5 nb-pill text-xs bg-nbyellow text-ink">
      <i class="fa-solid fa-book-bookmark mr-1"></i> Semester 1
    </button>
    <button hx-get="/murid/htmx/missions/semester/2" 
      hx-push-url="/murid/missions/semester/2"
      hx-swap="innerHTML show:top"
      hx-target="#mainScroll" onclick="setActiveNav('missions'); setSemesterActive(2)" id="btnSem2" class="flex-1 py-2.5 nb-pill text-xs bg-white/60 text-ink/60">
      <i class="fa-solid fa-book-open mr-1"></i> Semester 2
    </button>
  </div>
  <h3 class="font-display text-base font-bold flex items-center gap-2" id="semesterTitle">
    <i class="fa-solid fa-map-location-dot text-nbgreen"></i> Peta Misi Semester 1
  </h3>
  <div class="space-y-4" id="chaptersGrid">
    <?php
    $colorMap = [
      'emerald' => 'nbgreen',
      'sky' => 'nbblue',
      'amber' => 'nborange',
      'purple' => 'nbpurple',
      'rose' => 'nbpink',
    ];
    foreach (($missions ?? []) as $mission):
      $nb = $colorMap[$mission['color'] ?? ''] ?? 'nbgreen';
    ?>
      <div class="nb-card p-4 space-y-3 cursor-pointer">
        <div class="flex justify-between items-center">
          <span class="text-[11px] font-extrabold bg-<?= $nb ?> text-white nb-pill px-2.5 py-1">Bab <?= esc($mission['chapter']) ?></span>
          <span class="text-[11px] text-orange-500 font-extrabold flex items-center gap-1"><i class="fa-solid fa-star"></i> <?= esc($mission['difficulty']) ?></span>
        </div>
        <div class="flex items-center gap-3">
          <div class="w-12 h-12 rounded-2xl bg-<?= $nb . '/15' ?> nb-border border-<?= $nb ?> flex items-center justify-center text-lg text-<?= $nb ?>">
            <i class="fa-solid <?= esc($mission['icon'] ?? 'fa-circle') ?>"></i>
          </div>
          <h4 class="font-display font-bold text-sm leading-snug"><?= esc($mission['title']) ?></h4>
        </div>
        <div class="text-[11px] text-ink/60 font-semibold space-y-1 bg-white/50 nb-border rounded-xl p-2.5">
          <p><strong class="text-nbgreen">IPAS:</strong> <?= esc($mission['ipasTopic'] ?? '') ?></p>
          <p><strong class="text-nbblue">B.Indo:</strong> <?= esc($mission['bindoTopic'] ?? '') ?></p>
        </div>
        <button class="w-full py-2.5 bg-<?= $nb ?> text-white nb-btn text-xs flex items-center justify-center gap-2">
          Buka Petualangan <i class="fa-solid fa-arrow-right"></i>
        </button>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<script>
  function setSemesterActive(semester) {
    const btnSem1 = document.getElementById('btnSem1');
    const btnSem2 = document.getElementById('btnSem2');
    const semesterTitle = document.getElementById('semesterTitle');

    if (semester === 1) {
      btnSem1.classList.add('bg-nbyellow', 'text-ink');
      btnSem1.classList.remove('bg-white/60', 'text-ink/60');
      btnSem2.classList.remove('bg-nbyellow', 'text-ink');
      btnSem2.classList.add('bg-white/60', 'text-ink/60');
      semesterTitle.innerHTML = '<i class="fa-solid fa-map-location-dot text-nbgreen"></i> Peta Misi Semester 1';
    } else if (semester === 2) {
      btnSem2.classList.add('bg-nbyellow', 'text-ink');
      btnSem2.classList.remove('bg-white/60', 'text-ink/60');
      btnSem1.classList.remove('bg-nbyellow', 'text-ink');
      btnSem1.classList.add('bg-white/60', 'text-ink/60');
      semesterTitle.innerHTML = '<i class="fa-solid fa-map-location-dot text-nbgreen"></i> Peta Misi Semester 2';
    }
  }
</script>