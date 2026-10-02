<nav id="mainNav" class="glass absolute bottom-3 inset-x-3 z-40 rounded-3xl grid grid-cols-4" style="margin-bottom:env(safe-area-inset-bottom,0px);">
  <button hx-get="/htmx/home" 
    hx-push-url="/"
    hx-swap="innerHTML show:top"
    hx-target="#mainScroll" onclick="setActiveNav('home')" id="tabBtn-home" class="py-2.5 flex flex-col items-center gap-0.5 text-[10px] font-bold <?= ($page ?? '') === 'home' ? 'text-ink' : 'text-ink/40' ?>">
    <span class="w-8 h-8 rounded-xl flex items-center justify-center <?= ($page ?? '') === 'home' ? 'bg-nbblue text-white' : '' ?>"><i class="fa-solid fa-house"></i></span>Beranda
  </button>
  <button
    hx-get="/htmx/missions" 
    hx-push-url="/missions"
    hx-swap="innerHTML show:top"
    hx-target="#mainScroll" onclick="setActiveNav('missions')" id="tabBtn-missions" class="py-2.5 flex flex-col items-center gap-0.5 text-[10px] font-bold <?= ($page ?? '') === 'missions' ? 'text-ink' : 'text-ink/40' ?>">
    <span class="w-8 h-8 rounded-xl flex items-center justify-center <?= ($page ?? '') === 'missions' ? 'bg-nbgreen text-white' : '' ?>"><i class="fa-solid fa-map-location-dot"></i></span>Misi
  </button>
  <button hx-get="/htmx/achievements" 
    hx-push-url="/achievements"
    hx-swap="innerHTML show:top"
    hx-target="#mainScroll" onclick="setActiveNav('achievements')" id="tabBtn-achievements" class="py-2.5 flex flex-col items-center gap-0.5 text-[10px] font-bold <?= ($page ?? '') === 'achievements' ? 'text-ink' : 'text-ink/40' ?>">
    <span class="w-8 h-8 rounded-xl flex items-center justify-center <?= ($page ?? '') === 'achievements' ? 'bg-nborange text-white' : '' ?>"><i class="fa-solid fa-trophy"></i></span>Prestasi
  </button>
  <button hx-get="/htmx/profile" 
    hx-push-url="/profile"
    hx-swap="innerHTML show:top"
    hx-target="#mainScroll" onclick="setActiveNav('profile')" id="tabBtn-profile" class="py-2.5 flex flex-col items-center gap-0.5 text-[10px] font-bold <?= ($page ?? '') === 'profile' ? 'text-ink' : 'text-ink/40' ?>">
    <span class="w-8 h-8 rounded-xl flex items-center justify-center <?= ($page ?? '') === 'profile' ? 'bg-nbpurple text-white' : '' ?>"><i class="fa-solid fa-user"></i></span>Profil
  </button>
</nav>
