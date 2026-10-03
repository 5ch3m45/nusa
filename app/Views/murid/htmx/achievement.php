<div id="view-achievements" class=" space-y-4">
  <h3 class="font-display text-base font-bold">🏆 Prestasi Saya</h3>
  <div class="nb-card p-4 flex items-center gap-3">
    <div class="w-12 h-12 bg-nbyellow/30 rounded-2xl flex items-center justify-center text-xl text-nborange"><i class="fa-solid fa-star"></i></div>
    <div>
      <p class="text-[11px] font-semibold text-ink/50">Total Bintang</p>
      <p class="font-display text-xl font-bold" id="achStars">12</p>
    </div>
  </div>
  <div class="grid grid-cols-2 gap-3">
    <div class="nb-card !rounded-2xl p-4">
      <span class="text-[11px] font-extrabold text-nbgreen uppercase"><i class="fa-solid fa-flask mr-1"></i>IPAS</span>
      <p class="font-display text-2xl font-bold mt-1" id="achIpas">90</p>
      <p class="text-[11px] font-semibold text-ink/50" id="achIpasPred">Sangat Baik</p>
    </div>
    <div class="nb-card !rounded-2xl p-4">
      <span class="text-[11px] font-extrabold text-nbblue uppercase"><i class="fa-solid fa-language mr-1"></i>B. Indo</span>
      <p class="font-display text-2xl font-bold mt-1" id="achBindo">95</p>
      <p class="text-[11px] font-semibold text-ink/50" id="achBindoPred">Sangat Baik</p>
    </div>
  </div>
  <button onclick="openChapter(currentChapter.id); switchTab('certificate')" class="w-full py-3 bg-nbyellow text-ink nb-btn text-sm">
    <i class="fa-solid fa-certificate mr-1"></i> Lihat Piagam
  </button>
</div>