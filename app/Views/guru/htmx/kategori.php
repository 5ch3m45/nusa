<div class="mt-4 mb-4">
  <h2 class="font-display text-xl font-bold">Kategori</h2>
  <p class="text-sm text-ink/60">Pilih kategori yang ingin dikelola</p>
</div>

<div class="space-y-3">
  <a hx-get="/guru/buku" 
    hx-push-url="/guru/buku"
    hx-swap="innerHTML show:top"
    hx-target="#guru-content" class="nb-card p-5 flex items-center gap-4 active:scale-95 transition">
    <div class="w-14 h-14 bg-nbgreen/15 text-nbgreen rounded-2xl flex items-center justify-center shrink-0">
      <i class="fa-solid fa-book text-2xl"></i>
    </div>
    <div class="flex-1">
      <p class="text-base font-bold">Buku</p>
      <p class="text-xs text-ink/50">Kelola buku dalam bentuk link atau PDF</p>
    </div>
    <i class="fa-solid fa-chevron-right text-ink/30"></i>
  </a>

  <a hx-get="/guru/materi" 
    hx-push-url="/guru/materi"
    hx-swap="innerHTML show:top"
    hx-target="#guru-content" class="nb-card p-5 flex items-center gap-4 active:scale-95 transition">
    <div class="w-14 h-14 bg-nborange/15 text-nborange rounded-2xl flex items-center justify-center shrink-0">
      <i class="fa-solid fa-file-lines text-2xl"></i>
    </div>
    <div class="flex-1">
      <p class="text-base font-bold">Materi</p>
      <p class="text-xs text-ink/50">Kelola materi pembelajaran</p>
    </div>
    <i class="fa-solid fa-chevron-right text-ink/30"></i>
  </a>

  <a hx-get="/guru/tugas" 
    hx-push-url="/guru/tugas"
    hx-swap="innerHTML show:top"
    hx-target="#guru-content" class="nb-card p-5 flex items-center gap-4 active:scale-95 transition">
    <div class="w-14 h-14 bg-nbpurple/15 text-nbpurple rounded-2xl flex items-center justify-center shrink-0">
      <i class="fa-solid fa-clipboard-list text-2xl"></i>
    </div>
    <div class="flex-1">
      <p class="text-base font-bold">Tugas</p>
      <p class="text-xs text-ink/50">Kelola tugas untuk murid</p>
    </div>
    <i class="fa-solid fa-chevron-right text-ink/30"></i>
  </a>
</div>