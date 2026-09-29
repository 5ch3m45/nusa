<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
  <?= $this->include('partials/glass_background') ?>
  
  <?= $this->include('partials/header') ?>
  
  <main id="mainScroll" class="flex-1 min-h-0 w-full px-4 pt-4 pb-28 overflow-y-auto">
    <?= $this->renderSection('content') ?>
  </main>

  <?= $this->include('partials/bottom_nav') ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
  function setActiveNav(tabName) {
    currentTab = tabName;
    const tabs = {
      home: 'nbblue',
      missions: 'nbgreen',
      achievements: 'nborange',
      profile: 'nbpurple'
    };
    Object.keys(tabs).forEach(t => {
      const btn = document.getElementById(`tabBtn-${t}`);
      if (!btn) return;
      const iconSpan = btn.querySelector('span');
      if (t === tabName) {
        btn.className = "py-2.5 flex flex-col items-center gap-0.5 text-[10px] font-extrabold text-ink";
        if (iconSpan) {
          iconSpan.className = `w-8 h-8 rounded-xl flex items-center justify-center bg-${tabs[t]} text-white`;
        }
      } else {
        btn.className = "py-2.5 flex flex-col items-center gap-0.5 text-[10px] font-bold text-ink/40";
        if (iconSpan) {
          iconSpan.className = "w-8 h-8 rounded-xl flex items-center justify-center";
        }
      }
    });
  }
</script>
<?= $this->endSection() ?>