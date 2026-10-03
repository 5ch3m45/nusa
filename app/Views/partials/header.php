<header class="glass-header shrink-0 z-40" style="padding-top:env(safe-area-inset-top,0px);">
  <div class="px-4 py-3 flex items-center justify-between gap-2">
    <div class="flex items-center gap-2.5 cursor-pointer" onclick="switchMain('home')">
      <div class="w-10 h-10 bg-nbyellow rounded-2xl flex items-center justify-center text-ink text-lg shrink-0">
        <i class="fa-solid fa-compass text-red"></i>
      </div>
      <div class="leading-tight">
        <h1 class="font-display text-base font-bold tracking-wide">LENTERA</h1>
        <p class="text-[11px] font-bold text-ink/60">Bahasa & IPAS &bull; Kelas <?= esc($profile['class'] ?? 1) ?></p>
      </div>
    </div>
    <div class="flex items-center gap-1.5 bg-nbyellow/30 nb-pill px-3 py-1.5 text-sm shrink-0">
      <i class="fa-solid fa-star text-nborange"></i>
      <span id="totalStarsCount"><?= esc($profile['stats']['stars'] ?? 0) ?></span>
    </div>
  </div>
</header>