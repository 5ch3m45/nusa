<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="mt-4 mb-6">
  <h2 class="font-display text-xl font-bold">Dashboard Admin</h2>
  <p class="text-sm text-ink/60">Kelola Book Store LENTERA</p>
</div>

<!-- Stats -->
<div class="grid grid-cols-3 gap-3 mb-6">
  <div class="nb-card p-4 text-center">
    <div class="w-10 h-10 bg-nbgreen/15 rounded-xl flex items-center justify-center text-nbgreen text-lg mx-auto mb-2">
      <i class="fa-solid fa-book"></i>
    </div>
    <p class="text-2xl font-bold"><?= $totalBooks ?></p>
    <p class="text-[11px] text-ink/60 font-semibold">Buku</p>
  </div>
  <div class="nb-card p-4 text-center">
    <div class="w-10 h-10 bg-nborange/15 rounded-xl flex items-center justify-center text-nborange text-lg mx-auto mb-2">
      <i class="fa-solid fa-file-lines"></i>
    </div>
    <p class="text-2xl font-bold"><?= $totalMaterials ?></p>
    <p class="text-[11px] text-ink/60 font-semibold">Materi</p>
  </div>
  <div class="nb-card p-4 text-center">
    <div class="w-10 h-10 bg-nbpurple/15 rounded-xl flex items-center justify-center text-nbpurple text-lg mx-auto mb-2">
      <i class="fa-solid fa-clipboard-list"></i>
    </div>
    <p class="text-2xl font-bold"><?= $totalAssignments ?></p>
    <p class="text-[11px] text-ink/60 font-semibold">Tugas</p>
  </div>
</div>

<!-- Quick Actions -->
<div>
  <h3 class="font-display text-base font-bold mb-3">Menu</h3>
  <div class="space-y-3">
    <a href="/admin/buku" class="nb-card p-4 flex items-center gap-3 active:scale-95 transition">
      <div class="w-10 h-10 bg-nbgreen rounded-xl flex items-center justify-center text-white shrink-0">
        <i class="fa-solid fa-book"></i>
      </div>
      <div class="flex-1">
        <p class="text-sm font-bold">Buku</p>
        <p class="text-[11px] text-ink/50">Kelola buku di Book Store</p>
      </div>
      <i class="fa-solid fa-chevron-right text-ink/30 text-xs"></i>
    </a>
    <a href="/admin/materi" class="nb-card p-4 flex items-center gap-3 active:scale-95 transition">
      <div class="w-10 h-10 bg-nborange rounded-xl flex items-center justify-center text-white shrink-0">
        <i class="fa-solid fa-file-lines"></i>
      </div>
      <div class="flex-1">
        <p class="text-sm font-bold">Materi</p>
        <p class="text-[11px] text-ink/50">Kelola materi di Book Store</p>
      </div>
      <i class="fa-solid fa-chevron-right text-ink/30 text-xs"></i>
    </a>
    <a href="/admin/tugas" class="nb-card p-4 flex items-center gap-3 active:scale-95 transition">
      <div class="w-10 h-10 bg-nbpurple rounded-xl flex items-center justify-center text-white shrink-0">
        <i class="fa-solid fa-clipboard-list"></i>
      </div>
      <div class="flex-1">
        <p class="text-sm font-bold">Tugas</p>
        <p class="text-[11px] text-ink/50">Kelola tugas di Book Store</p>
      </div>
      <i class="fa-solid fa-chevron-right text-ink/30 text-xs"></i>
    </a>
  </div>
</div>

<?= $this->endSection() ?>
