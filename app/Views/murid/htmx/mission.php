<div id="view-missions" class="space-y-4">
  <div id="semester-switch" class="flex gap-2">
    <?php $activeSemester = (int) ($semester ?? 1); ?>
    <button hx-get="/murid/htmx/missions/semester/1" 
      hx-push-url="/murid/missions/semester/1"
      hx-swap="innerHTML show:top"
      hx-target="#mainScroll" onclick="setActiveNav('missions'); setSemesterActive(1)" id="btnSem1" class="flex-1 py-2.5 nb-pill text-xs <?= $activeSemester === 1 ? 'bg-nbyellow text-ink' : 'bg-white/60 text-ink/60' ?>">
      <i class="fa-solid fa-book-bookmark mr-1"></i> Semester 1
    </button>
    <button hx-get="/murid/htmx/missions/semester/2" 
      hx-push-url="/murid/missions/semester/2"
      hx-swap="innerHTML show:top"
      hx-target="#mainScroll" onclick="setActiveNav('missions'); setSemesterActive(2)" id="btnSem2" class="flex-1 py-2.5 nb-pill text-xs <?= $activeSemester === 2 ? 'bg-nbyellow text-ink' : 'bg-white/60 text-ink/60' ?>">
      <i class="fa-solid fa-book-open mr-1"></i> Semester 2
    </button>
  </div>
  <h3 class="font-display text-base font-bold flex items-center gap-2" id="semesterTitle">
    <i class="fa-solid fa-map-location-dot text-nbgreen"></i> Peta Misi Semester <?= $activeSemester ?>
  </h3>
  <div class="space-y-4" id="chaptersGrid">
    <?php
    $subjectStyles = [
      'Matematika'       => ['nbblue',  'fa-calculator'],
      'IPA'              => ['nbgreen',  'fa-flask'],
      'IPAS'             => ['nbgreen',  'fa-flask'],
      'Bahasa Indonesia' => ['nbpurple', 'fa-language'],
      'Sejarah'          => ['nborange', 'fa-landmark'],
      'PPKn'             => ['nbpink',   'fa-landmark'],
      'Seni Budaya'      => ['nborange', 'fa-palette'],
      'PJOK'             => ['nbgreen',  'fa-futbol'],
    ];
    ?>
    <?php if (empty($materials)): ?>
      <div class="nb-card p-8 text-center text-ink/40 text-sm">
        <i class="fa-solid fa-book-open text-3xl mb-2"></i>
        <p>Belum ada materi untuk kelas ini pada semester ini.</p>
      </div>
    <?php else: ?>
      <?php foreach ($materials as $material): ?>
        <?php [$nb, $icon] = $subjectStyles[$material['subject'] ?? ''] ?? ['nbgreen', 'fa-book']; ?>
        <div class="nb-card p-4 space-y-3">
          <div class="flex justify-between items-center">
            <span class="text-[11px] font-extrabold bg-<?= $nb ?> text-white nb-pill px-2.5 py-1"><?= esc($material['chapter'] ?? '') ?></span>
            <span class="text-[11px] font-extrabold text-<?= $nb ?> flex items-center gap-1"><i class="fa-solid <?= $icon ?>"></i> <?= esc($material['subject'] ?? '') ?></span>
          </div>
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-2xl bg-<?= $nb ?>/15 nb-border border-<?= $nb ?> flex items-center justify-center text-lg text-<?= $nb ?>">
              <i class="fa-solid <?= $icon ?>"></i>
            </div>
            <h4 class="font-display font-bold text-sm leading-snug"><?= esc($material['title'] ?? '') ?></h4>
          </div>
          <div class="text-[11px] text-ink/60 font-semibold bg-white/50 nb-border rounded-xl p-2.5 flex items-center gap-1.5">
            <?php $totalA = (int) ($material['total_assignments'] ?? 0); $doneA = (int) ($material['submitted_count'] ?? 0); ?>
            <?php if ($totalA > 0 && $doneA >= $totalA): ?>
              <i class="fa-solid fa-circle-check text-nbgreen"></i> Selesai<?= ($material['uploaded_avg_score'] ?? null) !== null ? ' · Nilai ' . esc($material['uploaded_avg_score']) : '' ?>
            <?php elseif ($doneA > 0): ?>
              <i class="fa-solid fa-book-open text-nbblue"></i> Sedang dikerjakan (<?= $doneA ?>/<?= $totalA ?>)<?= ($material['uploaded_avg_score'] ?? null) !== null ? ' · Nilai ' . esc($material['uploaded_avg_score']) : '' ?>
            <?php elseif (!empty($material['started_at']) || !empty($material['last_accessed_at'])): ?>
              <i class="fa-solid fa-book-open text-nbblue"></i> Sedang dipelajari
            <?php else: ?>
              <i class="fa-regular fa-circle text-ink/40"></i> Belum dimulai
            <?php endif; ?>
          </div>
          <button hx-get="/murid/htmx/missions/<?= (int) $material['id'] ?>/material"
            hx-push-url="/murid/missions/<?= (int) $material['id'] ?>"
            hx-swap="innerHTML show:top"
            hx-target="#mainScroll" onclick="setActiveNav('missions')"
            class="w-full py-2.5 bg-<?= $nb ?> text-white nb-btn text-xs flex items-center justify-center gap-2">
            Buka Petualangan <i class="fa-solid fa-arrow-right"></i>
          </button>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
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
