<div class="mt-4 mb-6">
  <h2 class="font-display text-xl font-bold">Dashboard</h2>
  <p class="text-sm text-ink/60">Selamat datang, <?= session()->get('user_name') ?>!</p>
</div>

<!-- Stats -->
<div class="grid grid-cols-2 gap-3 mb-6">
  <div class="nb-card p-4">
    <div class="w-10 h-10 bg-nbblue/15 rounded-xl flex items-center justify-center text-nbblue text-lg mb-2">
      <i class="fa-solid fa-users"></i>
    </div>
    <p class="text-2xl font-bold"><?= $totalStudents ?></p>
    <p class="text-[11px] text-ink/60 font-semibold">Total Murid</p>
  </div>
  <div class="nb-card p-4">
    <div class="w-10 h-10 bg-nbgreen/15 rounded-xl flex items-center justify-center text-nbgreen text-lg mb-2">
      <i class="fa-solid fa-book"></i>
    </div>
    <p class="text-2xl font-bold"><?= $totalBooks ?></p>
    <p class="text-[11px] text-ink/60 font-semibold">Total Buku</p>
  </div>
  <div class="nb-card p-4">
    <div class="w-10 h-10 bg-nborange/15 rounded-xl flex items-center justify-center text-nborange text-lg mb-2">
      <i class="fa-solid fa-file-lines"></i>
    </div>
    <p class="text-2xl font-bold"><?= $totalMaterials ?></p>
    <p class="text-[11px] text-ink/60 font-semibold">Total Materi</p>
  </div>
  <div class="nb-card p-4">
    <div class="w-10 h-10 bg-nbpurple/15 rounded-xl flex items-center justify-center text-nbpurple text-lg mb-2">
      <i class="fa-solid fa-clipboard-list"></i>
    </div>
    <p class="text-2xl font-bold"><?= $totalAssignments ?></p>
    <p class="text-[11px] text-ink/60 font-semibold">Total Tugas</p>
  </div>
</div>

<!-- Quick Actions -->
<div class="mb-6">
  <h3 class="font-display text-base font-bold mb-3">Aksi Cepat</h3>
  <div class="grid grid-cols-2 gap-3">
    <button hx-get="/guru/murid" 
        hx-push-url="/guru/murid"
        hx-swap="innerHTML show:top"
        hx-target="#guru-content" class="nb-card p-4 flex items-center gap-3 active:scale-95 transition">
      <div class="w-10 h-10 bg-nbblue rounded-xl flex items-center justify-center text-white shrink-0">
        <i class="fa-solid fa-user-plus"></i>
      </div>
      <span class="text-sm font-bold">Tambah Murid</span>
    </button>
    <button hx-get="/guru/buku" 
        hx-push-url="/guru/buku"
        hx-swap="innerHTML show:top"
        hx-target="#guru-content" class="nb-card p-4 flex items-center gap-3 active:scale-95 transition">
      <div class="w-10 h-10 bg-nbgreen rounded-xl flex items-center justify-center text-white shrink-0">
        <i class="fa-solid fa-book-medical"></i>
      </div>
      <span class="text-sm font-bold">Tambah Buku</span>
    </button>
    <button hx-get="/guru/materi" 
        hx-push-url="/guru/materi"
        hx-swap="innerHTML show:top"
        hx-target="#guru-content" class="nb-card p-4 flex items-center gap-3 active:scale-95 transition">
      <div class="w-10 h-10 bg-nborange rounded-xl flex items-center justify-center text-white shrink-0">
        <i class="fa-solid fa-file-circle-plus"></i>
      </div>
      <span class="text-sm font-bold">Tambah Materi</span>
    </button>
    <button hx-get="/guru/tugas" 
        hx-push-url="/guru/tugas"
        hx-swap="innerHTML show:top"
        hx-target="#guru-content" class="nb-card p-4 flex items-center gap-3 active:scale-95 transition">
      <div class="w-10 h-10 bg-nbpurple rounded-xl flex items-center justify-center text-white shrink-0">
        <i class="fa-solid fa-list-ol"></i>
      </div>
      <span class="text-sm font-bold">Tambah Tugas</span>
    </button>
  </div>
</div>

<!-- Recent Students -->
<div>
  <div class="flex items-center justify-between mb-3">
    <h3 class="font-display text-base font-bold">Murid Terbaru</h3>
    <button hx-get="/guru/murid" 
        hx-push-url="/guru/murid"
        hx-swap="innerHTML show:top"
        hx-target="#guru-content" class="text-xs text-nbblue font-bold">Lihat Semua</button>
  </div>
  <div class="space-y-3">
    <?php if (empty($recentStudents)): ?>
      <div class="nb-card p-8 text-center text-ink/40 text-sm">
        <i class="fa-solid fa-users text-3xl mb-2"></i>
        <p>Belum ada murid.</p>
        <button hx-get="/guru/murid" 
            hx-push-url="/guru/murid"
            hx-swap="innerHTML show:top"
            hx-target="#guru-content" class="text-nbblue font-bold">Tambah murid pertama</button>
      </div>
    <?php else: ?>
      <?php foreach ($recentStudents as $student): ?>
        <div class="nb-card p-4 flex items-center gap-3">
          <div class="w-10 h-10 bg-nbblue/15 rounded-xl flex items-center justify-center text-nbblue font-bold text-sm shrink-0">
            <?= strtoupper(substr($student['name'], 0, 1)) ?>
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-sm font-bold truncate"><?= esc($student['name']) ?></p>
            <p class="text-[11px] text-ink/50">Kelas <?= esc($student['class']) ?></p>
          </div>
          <a href="tel:<?= esc($student['phone']) ?>" class="w-9 h-9 bg-nbgreen/10 text-nbgreen rounded-xl flex items-center justify-center shrink-0">
            <i class="fa-solid fa-phone text-xs"></i>
          </a>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>